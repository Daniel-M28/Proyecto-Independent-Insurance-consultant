<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PersonalQuote;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class PersonalQuoteController extends Controller
{
    // Listar todas las cotizaciones personales
    public function index()
{
    $user = auth()->user();

    if ($user->hasRole('administrador')) {
        
        $quotes = PersonalQuote::with('users')->latest()->paginate(10);
    } elseif ($user->hasRole('asesor')) {
        // Asesor ve solo los registros asignados a él
        $quotes = $user->personalQuotes()->with('users')->latest()->paginate(10);
    } else {
        
        abort(403, 'No autorizado');
    }

    
    $asesores = $user->hasRole('administrador') ? User::role('asesor')->get() : collect();

    return view('admin.personal-quotes.index', compact('quotes', 'asesores'));
}


    // Mostrar detalle de una cotización
    public function show($id)
    {
        $quote = PersonalQuote::findOrFail($id);
        $licenses = $quote->license_files ?? [];
        return view('admin.personal-quotes.show', compact('quote', 'licenses'));
    }

    // Guardar nueva cotización desde el formulario
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:30',
            'lastname'          => 'required|string|max:30',
            'dob'               => 'required|date',
            'email'             => 'required|email|max:255',
            'phone'             => 'required|string|max:20',
            'address'           => 'required|string|max:100',
            'iss_date'          => 'required|date',
            'occupation'        => 'required|string|max:50',
            'miles'             => 'required|integer|min:1|max:1000000',
            'vin'               => 'required|string',
            'coverage'          => 'required|string|max:50',
            'vehicle_type'      => 'required|string|max:30',
            'usage'             => 'required|string|max:30',
            'make'              => 'required|string|max:30',
            'model'             => 'required|string|max:30',
            'body_class'        => 'required|string|max:30',
            'license-personal'   => 'required|array|max:6', // máximo 6 archivos
            'license-personal.*' => 'file|mimes:jpg,jpeg,png,pdf|max:5120', // cada uno hasta 5MB
            'observations'      => 'nullable|string|max:500',
        ]);

        // Guardar archivos en storage
        $paths = [];
        if ($request->hasFile('license-personal')) {
            foreach ($request->file('license-personal') as $file) {
                $paths[] = $file->store('licenses', 'public');
            }
        }

        // Guardar como JSON en la columna license_files
        $validated['license_files'] = $paths;

        // Crear registro en la base de datos
        PersonalQuote::create($validated);

        return back()->with('success', 'Your personal quote has been sent successfully.');
    }

    // Eliminar cotización
    public function destroy($id)
{
    $quote = PersonalQuote::findOrFail($id);

    try {
        // Eliminar archivos de license_files si existen
        if (!empty($quote->license_files)) {
            foreach ($quote->license_files as $file) {
                // Normalizar ruta relativa al disco 'public'
                $filePath = preg_replace('#^(public/|storage/)#', '', $file);

                if (\Storage::disk('public')->exists($filePath)) {
                    \Storage::disk('public')->delete($filePath);
                } else {
                    \Log::warning("Archivo de license_files no encontrado al intentar eliminar: ".$filePath);
                }
            }
        }

        // Eliminar registro de la BD
        $quote->delete();

        return redirect()->route('admin.personal-quotes.index')
                         ->with('success', 'Quote successfully deleted');

    } catch (\Exception $e) {
        \Log::error('Error al eliminar PersonalQuote: '.$e->getMessage());
        return back()->with('error', 'Error deleting quote.');
    }
}


    // Asignar asesor (opcional)
    public function assign(Request $request, $id)
    {
        $quote = PersonalQuote::findOrFail($id);
        $asesorId = $request->asesor_ids[0] ?? null;
        $quote->users()->sync($asesorId ? [$asesorId] : []);
        return redirect()->back()->with('success','Advisor assigned correctly');
    }
}

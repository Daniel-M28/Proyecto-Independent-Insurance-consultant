<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PersonalQuote;

class PersonalQuoteController extends Controller
{
    // Mostrar lista de cotizaciones personales
    public function index()
    {
        $quotes = PersonalQuote::latest()->paginate(10); 
        return view('admin.personal-quotes.index', compact('quotes'));
    }

    public function show($id)
    {
        $quote = PersonalQuote::findOrFail($id);

        // ✅ Ya no usamos explode, porque license_files ya es un array (JSON cast)
        $licenses = $quote->license_files ?? [];

        return view('admin.personal-quotes.show', compact('quote', 'licenses'));
    }

    // Guardar nueva cotización
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

        // Guardar archivos
        $paths = [];
        if ($request->hasFile('license-personal')) {
            foreach ($request->file('license-personal') as $file) {
                $paths[] = $file->store('licenses', 'public');
            }
        }

        // Guardar como JSON (se castea automáticamente a array en el modelo)
        $validated['license_files'] = $paths;

        // Guardar en BD
        PersonalQuote::create($validated);

        return back()->with('success', 'Your personal quote has been submitted successfully!');
    }

    public function destroy($id)
    {
    $request = PersonalQuote::findOrFail($id);
    $request->delete();

    return redirect()->route('admin.personal-quotes.index')
                     ->with('success', 'request successfully deleted');
    }



}



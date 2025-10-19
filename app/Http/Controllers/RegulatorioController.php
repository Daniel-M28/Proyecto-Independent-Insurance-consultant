<?php

namespace App\Http\Controllers;

use App\Models\Regulatorio;
use Illuminate\Http\Request;

class RegulatorioController extends Controller
{ 
    
    public function index()
{
    // Traer todas las solicitudes más recientes primero
    $regulatorios = \App\Models\Regulatorio::latest()->paginate(10);

    return view('admin.regulatorios.index', compact('regulatorios'));
}



    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:30',
            'last_name'    => 'required|string|max:30',
            'email'        => 'required|email|max:255',
            'phone_number' => [
                'required',
                'string',
                'max:20',
                'regex:/^(\(\d{3}\)\s?|\d{3}[-\s]?)\d{3}[-\s]?\d{4}$/'
            ],
            'observations'=> 'nullable|string|max:500',
        ]);

        Regulatorio::create($validated);

        return redirect()->back()->with('success', 'Request sent successfully');
    }


    public function destroy($id)
{
    // Verificar que el usuario tenga rol de administrador
    if (!auth()->user()->hasRole('administrador')) {
        abort(403, 'No tienes permiso para eliminar registros.');
    }

    // Buscar la solicitud
    $regulatorio = Regulatorio::findOrFail($id);

    // Eliminar
    $regulatorio->delete();

    // Redirigir con mensaje de éxito
    return redirect()->route('admin.regulatorios')
                 ->with('success', 'Request successfully deleted.');
}

}

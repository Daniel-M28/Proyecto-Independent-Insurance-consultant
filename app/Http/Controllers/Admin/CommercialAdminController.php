<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommercialRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommercialAdminController extends Controller
{
    public function index()
{
    $user = auth()->user();

    if ($user->hasRole('administrador')) {
        // Admin ve todos los registros
        $requests = CommercialRequest::with('users')->latest()->paginate(10);
    } elseif ($user->hasRole('asesor')) {
        // Asesor ve solo los registros asignados a él
        $requests = $user->commercialRequests()->with('users')->latest()->paginate(10);
    } else {
        
        abort(403, 'No autorizado');
    }

    //  ver la lista de asesores admin
    $asesores = $user->hasRole('administrador') ? User::role('asesor')->get() : collect();

    return view('admin.commercial.index', compact('requests', 'asesores'));
}


    public function show($id)
    {
        $request = CommercialRequest::findOrFail($id);
        return view('admin.commercial.show', compact('request'));
    }

    public function destroy($id)
    {
        $request = CommercialRequest::findOrFail($id);

        if (!empty($request->licenses)) {
            foreach ($request->licenses as $path) {
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
        }

        $request->delete();

        return redirect()->route('admin.commercial.index')
                         ->with('success', 'Commercial request and associated licenses deleted successfully.');
    }

     //Asignar asesores
    public function assign(Request $request, $id)
{
    $commercial = CommercialRequest::findOrFail($id);

    // Obtener los IDs de asesores seleccionados
    $asesorIds = array_filter($request->input('asesor_ids', []));

    
    $commercial->users()->sync($asesorIds);

    return redirect()->back()->with('success', 'Advisor assigned correctly');
}

}

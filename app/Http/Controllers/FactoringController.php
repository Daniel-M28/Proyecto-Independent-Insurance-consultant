<?php

namespace App\Http\Controllers;

use App\Models\Factoring;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FactoringController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        //Administrador ve todas las solicitudes
        if ($user->hasRole('administrador')) {
            $requests = Factoring::with('users')->latest()->paginate(10);
            $asesores = User::role('asesor')->get(); // Método propio de Spatie
        }
        //Asesor solo ve las que le asignaron
        elseif ($user->hasRole('asesor')) {
            $requests = $user->factorings()->with('users')->latest()->paginate(10);
            $asesores = [];
        }
       
        else {
            abort(403, 'Unauthorized user');
        }

        return view('admin.factoring.index', compact('requests', 'asesores'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|regex:/^[A-Za-z\s]+$/|max:30',
            'last_name'    => 'required|string|regex:/^[A-Za-z\s]+$/|max:30',
            'email'        => 'required|email|max:255',
            'phone_number' => [
                'required',
                'string',
                'max:20',
                'regex:/^(\(\d{3}\)\s?|\d{3}[-\s]?)\d{3}[-\s]?\d{4}$/'
            ],
            'observations' => 'nullable|string|max:500',
        ]);

        Factoring::create($validated);

        return redirect()->back()->with('success', 'Request sent successfully');
    }

    public function destroy(Factoring $factoring)
    {
        $factoring->delete();

        return redirect()->route('factorings.index')
                         ->with('success', 'Request successfully deleted');
    }

    public function assign(Request $request, $id)
{
    $factoring = Factoring::findOrFail($id);

    // Obtener el ID del asesor (puede venir vacío si se selecciona "No asignado")
    $asesorId = $request->input('asesor_ids')[0] ?? null;

    if (empty($asesorId)) {
        // Si se selecciona "No asignado", eliminar la asignación existente
        $factoring->users()->detach();
    } else {
        // Si se selecciona un asesor, asignarlo (solo uno)
        $factoring->users()->sync([$asesorId]);
    }

    return back()->with('success', 'Assignment updated successfully.');
}


}

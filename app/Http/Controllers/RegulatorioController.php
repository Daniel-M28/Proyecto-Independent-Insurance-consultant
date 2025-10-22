<?php

namespace App\Http\Controllers;

use App\Models\Regulatorio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegulatorioController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Si es administrador, ve todas las solicitudes
        if ($user->hasRole('administrador')) {
            $regulatorios = Regulatorio::with('users')->latest()->paginate(10);
            $asesores = User::role('asesor')->get();
        }
        // Si es asesor, solo ve las que le asignaron
        elseif ($user->hasRole('asesor')) {
            $regulatorios = $user->regulatorios()->with('users')->latest()->paginate(10);
            $asesores = [];
        }
        
        else {
            abort(403, 'Unauthorized user');
        }

        return view('admin.regulatorios.index', compact('regulatorios', 'asesores'));
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
            'observations' => 'nullable|string|max:500',
        ]);

        Regulatorio::create($validated);

        return redirect()->back()->with('success', 'Request sent successfully');
    }

    public function destroy($id)
    {
        if (!auth()->user()->hasRole('administrador')) {
            abort(403, 'You do not have permission to delete records.');
        }

        $regulatorio = Regulatorio::findOrFail($id);
        $regulatorio->delete();

        return redirect()->route('admin.regulatorios')
                         ->with('success', 'Request successfully deleted.');
    }

    // ✅ Método para asignar asesor
public function assign(Request $request, $id)
{
    $regulatorio = Regulatorio::findOrFail($id);

    $asesorId = $request->input('asesor_ids')[0] ?? null;

    if (empty($asesorId)) {
        // Si se selecciona "No asignado", eliminar cualquier asignación
        $regulatorio->users()->detach();
    } else {
        // Si se selecciona un asesor, asignarlo
        $regulatorio->users()->sync([$asesorId]);
    }

    return back()->with('success', 'Assignment updated successfully.');
}
}

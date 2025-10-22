<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PolicyController extends Controller
{
     use AuthorizesRequests;
    /**
     * Mostrar la vista principal de pólizas
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $user = null;
        $policy = null;
        $results = [];

        // Buscar usuarios por nombre o email
        if ($search) {
            $results = User::where('name','like',"%{$search}%")
                ->orWhere('email','like',"%{$search}%")
                ->get();
        }

        // Seleccionar usuario específico (admin) o el propio (usuario)
        if ($request->has('user_id')) {
            $user = User::find($request->user_id);
            $policy = Policy::where('user_id', $user->id)->first();
        } elseif(auth()->user()->hasRole('usuario')) {
            $user = auth()->user();
            $policy = Policy::where('user_id', $user->id)->first();
        }

        return view('policies.index', compact('results','user','policy','search'));
    }

    /**
     * Subir y asignar PDF a un usuario
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:20480',
            'user_id' => 'required|exists:users,id'
        ]);

        $user = User::find($request->user_id);

        // Si ya existe un PDF para este usuario, eliminarlo
        $existing = Policy::where('user_id', $user->id)->first();
        if ($existing) {
            if (Storage::disk('public')->exists($existing->file_path)) {
                Storage::disk('public')->delete($existing->file_path);
            }
            $existing->delete();
        }

        $file = $request->file('file');
        $fileName = time().'_'.$file->getClientOriginalName();

        // Guardar en el disco 'public' en polizas
        $file->storeAs('polizas', $fileName, 'public');

        // Crear registro en la DB
        Policy::create([
            'user_id' => $user->id,
            'file_name' => $file->getClientOriginalName(),
            'file_path' => 'polizas/'.$fileName,
            'uploaded_by' => auth()->id(),
        ]);

        return back()->with('success','Policy uploaded correctly.');
    }

    /**
     * Eliminar PDF y registro (solo admin)
     */
    public function destroy(Policy $policy)
{
    $this->authorize('edit-name'); // solo admin

    try {
        if (!empty($policy->file_path)) {
            // Normalizar la ruta relativa al disco 'public'
            $filePath = preg_replace('#^(public/|storage/)#', '', $policy->file_path);

            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            } else {
                \Log::warning("Archivo de policy no encontrado al intentar eliminar: ".$filePath);
            }
        }

        // Eliminar registro de la base de datos
        $policy->delete();

        return back()->with('success', 'Policy successfully deleted.');

    } catch (\Exception $e) {
        \Log::error('Error al eliminar policy: '.$e->getMessage());
        return back()->with('error', 'Error deleting policy.');
    }
}

}

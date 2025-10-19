<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommercialRequest;
use Illuminate\Support\Facades\Storage;

class CommercialAdminController extends Controller
{
    public function index()
    {
        $requests = CommercialRequest::latest()->paginate(10); // paginación
        return view('admin.commercial.index', compact('requests'));
    }

    public function show($id)
    {
        $request = CommercialRequest::findOrFail($id);
        return view('admin.commercial.show', compact('request'));
    }

   public function destroy($id)
{
    $request = CommercialRequest::findOrFail($id);

    // Eliminar los archivos guardados
    if (!empty($request->licenses)) {
        foreach ($request->licenses as $path) {
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
    }

    // Eliminar el registro
    $request->delete();

    return redirect()->route('admin.commercial.index')
                     ->with('success', 'Commercial request and associated licenses deleted successfully.');
}




}

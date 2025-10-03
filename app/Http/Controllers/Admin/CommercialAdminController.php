<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommercialRequest;

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
    $request->delete();

    return redirect()->route('admin.commercial.index')
                     ->with('error', 'Commercial request deleted successfully.');
    }


}

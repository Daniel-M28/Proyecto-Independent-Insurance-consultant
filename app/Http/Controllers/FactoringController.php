<?php

namespace App\Http\Controllers;

use App\Models\Factoring;
use Illuminate\Http\Request;

class FactoringController extends Controller
{
    public function index()
    {
        $requests = Factoring::latest()->paginate(10);
        return view('admin.factoring.index', compact('requests'));
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

        return redirect()->back()->with('success', 'Request sent successfully ✅');
    }

    


    public function destroy(Factoring $factoring)
    {
        $factoring->delete();
    
        return redirect()->route('factorings.index')
                         ->with('success', 'La solicitud fue eliminada correctamente.');
    }


}


<?php

namespace App\Http\Controllers;

use App\Models\CommercialRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommercialRequestController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'usdot' => 'required|digits_between:1,8',
            'name' => 'required|string|max:30',
            'lastname' => 'required|string|max:30',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'business_address' => 'required|string|max:100',
            'vin' => 'required|string|regex:/^[A-HJ-NPR-Z0-9]{17}(,\s*[A-HJ-NPR-Z0-9]{17})*$/',
            'yard' => 'nullable|string|max:100',
            'miles' => 'nullable|numeric|min:1|max:1000000',
            'type_of_load' => 'nullable|string|in:dryvan,reefer,flatbed,carhauler,towing',
            'coverages' => 'nullable|array',
            'coverages.*' => 'string',
            'licenses'   => 'required|array|max:6',
            'licenses.*' => 'file|mimes:jpg,jpeg,png,pdf|max:5120',
            'comments' => 'nullable|string|max:500',
        ]);

        $paths = [];
if ($request->hasFile('licenses')) {
    foreach ($request->file('licenses') as $file) {
        $paths[] = $file->store('licenses', 'public');
    }
}

$validated['licenses'] = $paths; // se guarda como JSON
CommercialRequest::create($validated);





        return redirect()->back()->with('success', 'Quote request submitted successfully ✅');
    }
}

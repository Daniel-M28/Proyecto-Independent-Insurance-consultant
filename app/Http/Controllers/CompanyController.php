<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    // Mostrar el listado de todas las solicitudes
    public function index()
    {
        $companies = Company::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.new-company.index', compact('companies'));
    }

    // Mostrar formulario para crear nueva solicitud
    public function create()
    {
        return view('admin.new-company.create');
    }

    // Guardar nueva solicitud
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name_1' => 'required|max:60',
            'company_name_2' => 'required|max:60',
            'company_name_3' => 'required|max:60',
            'owner_first_name' => 'required|max:50|regex:/^[A-Za-zÀ-ÿ\s]+$/',
            'owner_last_name' => 'required|max:50|regex:/^[A-Za-zÀ-ÿ\s]+$/',
            'ssn' => 'required|regex:/^\d{3}-\d{2}-\d{4}$/',
            'dob' => 'required|date',
            'phone' => 'required|regex:/^\(?\d{3}\)?[-\s]?\d{3}[-\s]?\d{4}$/',
            'email' => 'required|email|max:255',
            'business_address' => 'required|max:100',
            'cargo_type' => 'required',
            'operation_type' => 'required',
            'vehicle_type' => 'required',
            'observations' => 'nullable|max:500',
            'licenses.*' => 'file|mimes:jpeg,jpg,png,pdf|max:5120', // 5MB
        ]);

        // Manejar archivos y guardarlos en un array
        $licensePaths = [];
        if ($request->hasFile('licenses')) {
            if (count($request->file('licenses')) > 4) {
                return back()->withErrors(['licenses' => 'You can upload a maximum of 4 files']);
            }

            foreach ($request->file('licenses') as $file) {
                $licensePaths[] = $file->store('licenses', 'public');
            }
        }

        // Guardar la empresa, incluyendo los archivos en formato JSON
        $validated['licenses'] = $licensePaths;
        Company::create($validated);

         return redirect()->back()->with('success', 'Quote request submitted successfully ');
    }

    // Mostrar detalles de una solicitud
    public function show($id)
    {
        $company = Company::findOrFail($id);
        return view('admin.new-company.show', compact('company'));
    }

    // Eliminar una solicitud
    public function destroy($id)
    {
        $company = Company::findOrFail($id);

        // Eliminar archivos del storage
        if (!empty($company->licenses)) {
            foreach ($company->licenses as $file) {
                \Storage::disk('public')->delete($file);
            }
        }

        $company->delete();

        return redirect()->route('admin.new-company.index')
                         ->with('error', 'Company request deleted successfully!');
    }
}

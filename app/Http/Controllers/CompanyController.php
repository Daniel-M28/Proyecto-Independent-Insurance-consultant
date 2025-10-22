<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;

class CompanyController extends Controller
{
    // Mostrar listado según el rol
    public function index()
    {
        if (auth()->user()->hasRole('administrador')) {
            $companies = Company::with('users')->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $companies = Company::whereHas('users', function ($query) {
                $query->where('user_id', auth()->id());
            })->with('users')->orderBy('created_at', 'desc')->paginate(10);
        }

        // Solo los asesores disponibles
        $asesores = User::role('asesor')->get();

        return view('admin.new-company.index', compact('companies', 'asesores'));
    }

    //  Asignar asesor (o dejar “no asignado”)
    public function assign(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        // Si no se selecciona asesor, se elimina la relación
        if (!$request->asesor_id) {
            $company->users()->detach();
        } else {
            $company->users()->sync([$request->asesor_id]);
        }

        return redirect()->route('admin.new-company.index')->with('success', 'Asesor actualizado correctamente');
    }

    // Resto del código original ↓↓↓

    public function create()
    {
        return view('admin.new-company.create');
    }

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
            'licenses.*' => 'file|mimes:jpeg,jpg,png,pdf|max:5120',
        ]);

        $licensePaths = [];
        if ($request->hasFile('licenses')) {
            if (count($request->file('licenses')) > 4) {
                return back()->withErrors(['licenses' => 'You can upload a maximum of 4 files']);
            }

            foreach ($request->file('licenses') as $file) {
                $licensePaths[] = $file->store('licenses', 'public');
            }
        }

        $validated['licenses'] = $licensePaths;
        Company::create($validated);

        return redirect()->back()->with('success', 'Quote request submitted successfully ');
    }

    public function show($id)
    {
        $company = Company::findOrFail($id);
        return view('admin.new-company.show', compact('company'));
    }

    public function destroy($id)
{
    $company = Company::findOrFail($id);

    if (!empty($company->licenses)) {
        foreach ($company->licenses as $file) {
            // Normalizar ruta relativa al disco 'public'
            $filePath = preg_replace('#^(public/|storage/)#', '', $file);

            if (\Storage::disk('public')->exists($filePath)) {
                \Storage::disk('public')->delete($filePath);
            } else {
                \Log::warning("Archivo no encontrado al intentar eliminar: ".$filePath);
            }
        }
    }

    // Eliminar el registro en la base de datos
    $company->delete();

    return redirect()->route('admin.new-company.index')
                     ->with('success', 'Company request deleted successfully!');
}

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)

    { $search = $request->input('search');

    $users = \App\Models\User::when($search, function ($query, $search) {
        return $query->where('name', 'like', "%{$search}%")
                     ->orWhere('lastname', 'like', "%{$search}%");
    })
    ->orderBy('created_at', 'desc')
    ->paginate(10)
    ->withQueryString();

    return view('admin.users.index', [
        'users' => $users,
        'search' => $search
    ]);
    }

    /**
     * Show the form for creating a new resource.
     */
   public function create()
{
    $roles = Role::all(); // todos los roles disponibles
    return view('admin.users.create', compact('roles'));
}


    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
    {
        // Validación
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'roles' => ['nullable', 'array'],
            'roles.*' => ['exists:roles,id'],
        ]);

        // Crear usuario (hashear contraseña )
        $user = User::create([
            'name' => $data['name'],
            'lastname' => $data['lastname'] ?? null,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Asignar roles si el admin seleccionó alguno
        if (!empty($data['roles'])) {
            // Si los checkbox envían ids de role, sincronizamos
            $user->roles()->sync($data['roles']);
        }
        // si no seleccionó roles, tu booted() asignará 'usuario' automáticamente

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
    $roles= Role::all();

        return view('admin.users.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
{
    // Validar los datos
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'lastname' => ['nullable', 'string', 'max:255'],
        'roles' => ['nullable', 'array'],
        'roles.*' => ['exists:roles,id'],
    ]);

    // Actualizar nombre y apellido
    $user->update([
        'name' => $request->name,
        'lastname' => $request->lastname,
    ]);

    // Sincronizar roles
    $user->roles()->sync($request->input('roles', []));

    return redirect()->route('admin.users.index')
        ->with('success', 'The user was updated successfully.');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
{
    $user->delete();

    return redirect()->route('admin.users.index')
        ->with('success', 'User successfully deleted.');
}

}

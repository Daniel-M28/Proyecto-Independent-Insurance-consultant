<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)

    { $search = $request->input('search');

    $users = \App\Models\User::when($search, function ($query, $search) {
        return $query->where('name', 'like', "%{$search}%")
                     ->orWhere('email', 'like', "%{$search}%");
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    // Validar que los roles enviados existan (seguridad)
    $request->validate([
        'roles' => 'nullable|array',
        'roles.*' => 'exists:roles,id',
    ]);

    // Asignar o sincronizar los roles al usuario
    $user->roles()->sync($request->input('roles', []));

    return redirect()->route('admin.users.index')
        ->with('success', 'Los roles del usuario se han actualizado correctamente.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
{
    $user->delete();

    return redirect()->route('admin.users.index')
        ->with('success', 'Usuario eliminado correctamente.');
}

}

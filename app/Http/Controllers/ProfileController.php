<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = $request->user();

    // Obtener los datos validados del request
    $data = $request->validated();

    // Si NO tiene permiso, eliminamos name y lastname del array
    if (! $user->can('edit-name')) {
        unset($data['name'], $data['lastname']);
    }

    // Llenar el modelo con los datos permitidos
    $user->fill($data);

    // Si cambia el email, se resetea la verificación
    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    // Guardar cambios
    $user->save();

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
}

 public function destroy(Request $request)
{
    $user = $request->user();

    // Validar que el usuario haya ingresado su contraseña correctamente
    if (! Hash::check($request->password, $user->password)) {
        return back()
            ->withErrors(['password' => 'La contraseña ingresada es incorrecta.'], 'userDeletion');
    }

    // Cerrar sesión
    Auth::logout();

    // Borrar usuario
    $user->delete();

    // Invalidar sesión actual
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Redirigir con mensaje de confirmación
    return redirect('/')->with('status', 'Your user has been successfully deleted.');
}



}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Mail\VerifyTempUserMail;

class RegisteredUserController extends Controller
{
    /**
     * Mostrar la vista de registro
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Manejar el registro sin guardar aún en la base de datos
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8', 'max:64', Rules\Password::defaults()],
        ]);

        // Datos encriptados temporalmente
        $data = [
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ];

        // Encriptar los datos
        $encrypted = Crypt::encrypt($data);

        // Crear un enlace firmado válido por 60 minutos
        $url = URL::temporarySignedRoute(
            'verify.temp.user',
            Carbon::now()->addMinutes(60),
            ['data' => $encrypted]
        );

        // Enviar el correo de confirmación
        Mail::to($request->email)->send(new VerifyTempUserMail($request->name, $url));

        // No guardamos el usuario todavía
        return redirect()->route('login')->with('success', 'We sent you an email to confirm your account.');
    }

    /**
     * Verificar el token y crear el usuario definitivo
     */
    public function verifyTempUser(Request $request)
    {
        if (! $request->hasValidSignature()) {
            return redirect()->route('register')->with('error', 'Invalid or expired verification link.');
        }

        try {
            $data = Crypt::decrypt($request->query('data'));
        } catch (\Exception $e) {
            return redirect()->route('register')->with('error', 'Invalid verification data.');
        }

        // Crear el usuario real
        $user = User::create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => $data['password'],
            'email_verified_at' => now(),
        ]);

        // Iniciar sesión automáticamente (puedes quitar esta línea si prefieres login manual)
        // Auth::login($user);

        return redirect()->route('login')->with('success', 'Your account has been verified successfully! You can log in');
    }
}

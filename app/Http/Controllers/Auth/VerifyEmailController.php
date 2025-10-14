<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    public function __invoke(EmailVerificationRequest $request)
    {
        // Si ya estaba verificado, redirigir al login
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('login')->with('status', 'Your email is already verified. Please log in.');
        }

        // Marcar el correo como verificado
        if ($request->user()->markEmailAsVerified()) {
            event(new \Illuminate\Auth\Events\Verified($request->user()));
        }

        //  Redirigir al login tras verificar correctamente
        return redirect()->route('login')->with('status', 'Email verified successfully! You can now log in.');
    }
}

<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailNotification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmail extends VerifyEmailNotification
{
    /**
     * Genera el correo que se enviará para la verificación del email.
     */
   public function toMail($notifiable)
{
    $verificationUrl = $this->verificationUrl($notifiable);

    return (new MailMessage)
        ->from(config('mail.from.address'), 'Independent Insurance Consultant')
        ->subject('Confirm your account')
        ->view('emails.verify-temp-user', ['url' => $verificationUrl, 'name' => $notifiable->name]);
}


    /**
     * Genera la URL firmada para verificar el correo electrónico.
     */
    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(config('auth.verification.expire', 60)),
            ['id' => $notifiable->getKey(), 'hash' => sha1($notifiable->getEmailForVerification())]
        );
    }
}

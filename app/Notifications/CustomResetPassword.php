<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPassword extends ResetPasswordNotification
{
    /**
     * correo de restablecimiento.
     */
    public function toMail($notifiable)
{
    $url = url(route('password.reset', [
        'token' => $this->token,
        'email' => $notifiable->getEmailForPasswordReset(),
    ], false));

    return (new MailMessage)
        ->from(config('mail.from.address'), 'Independent Insurance Consultant')
        ->subject('Reset your password')
        ->line('Click the button below to reset your password.')
        ->action('Reset Password', $url)
        ->line('If you did not request a password reset, no further action is required.');
}

}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyTempUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $url;

    public function __construct($name, $url)
    {
        $this->name = $name;
        $this->url = $url;
    }

    public function build()
    {
        return $this->from(config('mail.from.address'), 'Independent Insurance Consultant')
                    ->subject('Confirm your account')
                    ->markdown('emails.verify-temp-user');
    }
}

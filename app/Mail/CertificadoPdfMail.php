<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class CertificadoPdfMail extends Mailable
{
    use Queueable, SerializesModels;

    public $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    public function build()
    {
        return $this->subject('COI required')
                    ->view('emails.certificado')
                    ->attach(Storage::path('temp_pdfs/' . $this->filename), [
                        'as' => 'certificado.pdf',
                        'mime' => 'application/pdf',
                    ]);
    }
}

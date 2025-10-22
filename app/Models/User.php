<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\CustomVerifyEmail;
use App\Notifications\CustomResetPassword;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * Asignar automáticamente el rol "usuario" si no tiene ninguno.
     */
    protected static function booted()
    {
        static::created(function ($user) {
            if (! $user->hasAnyRole(['administrador', 'asesor', 'usuario'])) {
                $user->assignRole('usuario');
            }
        });
    }

    /**
     * Atributos asignables en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
    ];

    /**
     * Atributos ocultos en arrays o respuestas JSON.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Atributos con casting automático.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Envía la notificación de verificación de correo electrónico personalizada.
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail());
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPassword($token));
    }


// Relaciones con otros modelos

//relación muchos a muchos con Factoring
public function factorings()
{
    return $this->belongsToMany(Factoring::class, 'factoring_user');
}

//relación muchos a muchos con Regulatorio
public function regulatorios()
{
    return $this->belongsToMany(Regulatorio::class, 'regulatorio_user');
}

public function companies()
{
    return $this->belongsToMany(Company::class, 'company_user');
}

public function commercialRequests()
{
    return $this->belongsToMany(CommercialRequest::class, 'commercial_request_user');

}

public function personalQuotes()
{
    return $this->belongsToMany(PersonalQuote::class, 'personal_quote_user');
}


}

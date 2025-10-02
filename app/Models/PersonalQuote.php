<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalQuote extends Model
{
    protected $fillable = [
        'name',
        'lastname',
        'dob',
        'email',
        'phone',
        'address',
        'iss_date',
        'occupation',
        'miles',
        'vin',
        'coverage',
        'vehicle_type',
        'usage',
        'make',
        'model',
        'body_class',
        'license_files',
        'observations',
    ];

    protected $casts = [
        'license_files' => 'array', //   convierte JSON <-> array automáticamente
    ];
}

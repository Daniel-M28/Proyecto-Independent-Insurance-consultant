<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'new_companies';

    protected $fillable = [
        'company_name_1',
        'company_name_2',
        'company_name_3',
        'owner_first_name',
        'owner_last_name',
        'ssn',
        'dob',
        'phone',
        'email',
        'business_address',
        'cargo_type',
        'operation_type',
        'vehicle_type',
        'observations',
        'licenses',
    ];

    protected $casts = [
        'licenses' => 'array',
    ];

    //  Relación con usuarios (asesores)
    public function users()
{
    return $this->belongsToMany(User::class, 'company_user');
}

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommercialRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'usdot',
        'name',
        'lastname',
        'phone',
        'email',
        'business_address',
        'vin',
        'yard',
        'miles',
        'type_of_load',
        'coverages',
        'licenses',
        'comments'
    ];

    protected $casts = [
        'coverages' => 'array',
        'licenses'  => 'array',
    ];


public function users()
{
    return $this->belongsToMany(User::class, 'commercial_request_user');
}



}

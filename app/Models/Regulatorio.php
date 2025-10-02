<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regulatorio extends Model
{
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'phone_number',
        'observations',
    ];
}

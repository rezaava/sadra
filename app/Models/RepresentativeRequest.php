<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepresentativeRequest extends Model
{
    protected $fillable = [
        'name',
        'city',
        'phone',
        'email',
        'type',
        'message',
        'consent',
    ];

    protected $casts = [
        'consent' => 'boolean',
    ];
}
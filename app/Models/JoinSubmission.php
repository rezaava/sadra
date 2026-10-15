<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JoinSubmission extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'field',
        'experience',
        'portfolio',
        'resume',
        'message',
    ];
}
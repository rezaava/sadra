<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteSubmission extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'email',
        'phone',
        'category',
        'packaging',
        'quantity',
        'sheet',
        'timeline',
        'tracking_code',
        'dimensions',
        'file',
        'message',
    ];
}

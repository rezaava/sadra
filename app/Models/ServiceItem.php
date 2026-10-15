<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceItem extends Model
{
    protected $fillable = [
        'service_id',
        'number',
        'icon',
        'title',
        'text',
    ];

    public function service()
    {
        return $this->belongsTo(
            Service::class,
            'service_id',
            'id'
        );
    }

    public function tags()
    {
        return $this->hasMany(
            ServiceItemTag::class,
            'service_item_id',
            'id'
        );
    }
}
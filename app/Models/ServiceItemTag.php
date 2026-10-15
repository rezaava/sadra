<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceItemTag extends Model
{
    protected $fillable = [
        'service_item_id',
        'name',
    ];

    public function serviceItem()
    {
        return $this->belongsTo(ServiceItem::class, 'service_item_id', 'id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'service_category_id',
        'name',
        'icon',
        'description',
        'projects_count',
        'brands_count',
        'experience_years',
        'industries_count',
    ];

    public function category()
    {
        return $this->belongsTo(
            ServiceCategory::class,
            'service_category_id',
            'id'
        );
    }

    public function items()
    {
        return $this->hasMany(
            ServiceItem::class,
            'service_id',
            'id'
        )->orderBy('number');
    }
}
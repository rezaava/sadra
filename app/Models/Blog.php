<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'short_text',
        'icon',
        'text',
        'reading_time',
        'main_tag',
        'image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function tags()
    {
        return $this->hasMany(BlogTag::class, 'blog_id', 'id');
    }
}
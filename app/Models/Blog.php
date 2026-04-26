<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title', 
        'slug', 
        'featured_image', 
        'excerpt', 
        'content', 
        'published_at'
    ];

    /**
     * This tells Laravel to treat published_at as a date/time object
     */
    protected $casts = [
        'published_at' => 'datetime',
    ];
}
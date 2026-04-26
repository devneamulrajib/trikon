<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'published_at',
        'description',
        'sort_order',
    ];

    protected $casts = [
        'published_at' => 'date',
    ];
}
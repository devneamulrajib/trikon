<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'slug', 
        'hero_image', 
        'description', 
        'video_url', 
        'main_content' // Add this line if it's missing
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brokerage extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'images' => 'array', // This tells Laravel to treat the images as a list
        'amenities' => 'array',
    ];
}
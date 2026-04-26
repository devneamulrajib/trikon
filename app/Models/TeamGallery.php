<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'caption',
        'sort_order',
    ];
}
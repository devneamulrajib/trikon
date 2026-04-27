<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'location', 'category', 'progress', 'image',
        'address', 'featured_image', 'cover_photo', 'amenities_image', 'floorplan_image',
        'land_area', 'floors', 'size', 'beds_baths', 
        'launch_date', 'collection', 'brochure_pdf', 'gallery', 'map_link', 'construction_updates', 'features'
    ];

    protected $casts = [
        'gallery' => 'array',
        'construction_updates' => 'array',
    ];
}
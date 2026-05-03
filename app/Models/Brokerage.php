<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Brokerage extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'images' => 'array', 
        'amenities' => 'array',
    ];

    /**
     * Get the URL of the first image.
     */
    public function getFirstImageUrlAttribute()
    {
        if (!$this->images || !is_array($this->images) || count($this->images) === 0) {
            return null;
        }

        // Filament stores paths like 'brokerage-listings/image.jpg'
        // Storage::url() converts that to '/storage/brokerage-listings/image.jpg'
        return Storage::disk('public')->url($this->images[0]);
    }
}
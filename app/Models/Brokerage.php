<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Brokerage extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'images' => 'array', 
        'amenities' => 'array',
    ];

    /**
     * Automatic Property ID Generation
     */
    protected static function booted()
    {
        static::creating(function ($brokerage) {
            // Generates a unique ID like TRK-7A2B9C
            $brokerage->property_id = 'TRK-' . strtoupper(Str::random(6));
        });
    }

    /**
     * Get the URL of the first image.
     */
    public function getFirstImageUrlAttribute()
    {
        if (!$this->images || !is_array($this->images) || count($this->images) === 0) {
            return null;
        }

        $path = $this->images[0];
        
        // Clean up the path just in case
        $cleanPath = str_replace('storage/', '', $path);
        
        // Hardcode the URL path
        return 'https://trikonltd.com/storage/' . $cleanPath;
    }
}
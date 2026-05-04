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
            $brokerage->property_id = 'TRK-' . strtoupper(Str::random(6));
        });
    }

    /**
     * Get the URL of the first image.
     * Fixed for cPanel public_html deployment.
     */
    public function getFirstImageUrlAttribute()
    {
        if (!$this->images || !is_array($this->images) || count($this->images) === 0) {
            return null;
        }

        $path = $this->images[0];
        
        // 1. If it's a full URL, return it
        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        // 2. Clean the path (remove 'storage/' prefix if it exists in DB)
        $cleanPath = ltrim(Str::replaceFirst('storage/', '', $path), '/');
        
        // 3. Return asset directly (points to public_html root)
        return asset($cleanPath);
    }
}
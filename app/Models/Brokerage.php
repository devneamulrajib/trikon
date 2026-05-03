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

    public function getFirstImageUrlAttribute()
    {
        if (!$this->images || !is_array($this->images) || count($this->images) === 0) {
            return null;
        }

        $path = $this->images[0];
        
        // This makes it work on BOTH your PC and the Server
        $cleanPath = str_replace('storage/', '', $path);
        
        return asset('storage/' . $cleanPath);
    }
}
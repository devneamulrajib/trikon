<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * These allow the Filament form to save data into your database.
     */
    protected $fillable = [
        'name',
        'designation',
        'description',
        'image',
        'sort_order',
    ];
}
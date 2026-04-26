<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SisterConcern extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * These allow the Filament form to save data into your database.
     */
    protected $fillable = [
        'name',
        'logo',
        'description',
        'sort_order',
    ];
}
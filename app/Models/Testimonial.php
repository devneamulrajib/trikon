<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model {
    protected $fillable = ['name', 'role', 'content', 'video_url', 'image', 'sort_order', 'is_active'];
}
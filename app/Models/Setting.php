<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'logo',
        'welcome_title',
        'welcome_text',
        'hotline',
        'sales_phone',
        'email',
        'address',
        'terms_content',
        'privacy_content',
        'whatsapp_number',
        'messenger_id'
    ];
}
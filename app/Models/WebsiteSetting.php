<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'tagline',
        'description',
        'email',
        'phone',
        'address',
        'logo',
        'favicon',
        'facebook_url',
        'instagram_url',
        'linkedin_url',
        'twitter_url',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];
}
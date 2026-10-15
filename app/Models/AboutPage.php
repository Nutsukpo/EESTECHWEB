<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AboutPage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'description_two',
        'image',
        'mission_title',
        'mission',
        'vision_title',
        'vision',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
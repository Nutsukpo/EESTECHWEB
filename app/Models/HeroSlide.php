<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HeroSlide extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [

        'badge',

        'title',

        'highlight',

        'description',

        'image',

        'primary_button_text',

        'primary_button_url',

        'secondary_button_text',

        'secondary_button_url',

        'display_order',

        'duration',

        'is_active',

    ];


    protected $casts = [

        'is_active' => 'boolean',

        'display_order' => 'integer',

        'duration' => 'integer',

    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'primary_phone',
        'secondary_phone',
        'email',
        'secondary_email',
        'address',
        'city',
        'region',
        'country',
        'google_maps_embed',
        'google_maps_url',
        'weekday_hours',
        'saturday_hours',
        'sunday_hours',
        'linkedin_url',
        'facebook_url',
        'instagram_url',
        'x_url',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
        ];
    }

    /**
     * Return the currently published company contact record.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}

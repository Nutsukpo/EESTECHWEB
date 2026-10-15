<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'client_name',
        'short_description',
        'description',
        'challenge',
        'solution',
        'results',
        'technologies',
        'cover_image',
        'project_url',
        'is_featured',
        'is_published',
        'display_order',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'technologies' => 'array',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'display_order' => 'integer',
            'published_at' => 'datetime',
        ];
    }

    /**
     * Scope to published projects for the public website.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope to featured projects.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}

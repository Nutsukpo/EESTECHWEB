<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsitePageView extends Model
{
    protected $fillable = [
        'visitor_id',
        'session_id',
        'path',
        'page_title',
        'referrer',
        'traffic_source',
        'device_type',
        'viewed_at',
    ];

    protected function casts(): array
    {
        return [
            'viewed_at' => 'datetime',
        ];
    }
}

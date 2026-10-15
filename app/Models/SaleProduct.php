<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'sku',
        'category',
        'short_description',
        'description',
        'image_path',
        'price',
        'is_price_visible',
        'is_available',
        'stock_quantity',
        'is_published',
        'display_order',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_price_visible' => 'boolean',
            'is_available' => 'boolean',
            'stock_quantity' => 'integer',
            'is_published' => 'boolean',
            'display_order' => 'integer',
        ];
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true)
            ->where('stock_quantity', '>', 0);
    }
}

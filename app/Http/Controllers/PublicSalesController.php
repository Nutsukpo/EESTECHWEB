<?php

namespace App\Http\Controllers;

use App\Models\SaleProduct;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicSalesController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:150'],
            'category' => ['nullable', 'string', 'max:150'],
        ]);

        $query = SaleProduct::published();

        if (!empty($filters['search'])) {
            $search = $filters['search'];

            $query->where(function ($builder) use ($search) {
                $builder->where('name', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if (!empty($filters['category'])) {
            $query->where('category', $filters['category']);
        }

        $products = $query
            ->orderBy('display_order')
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $categories = SaleProduct::published()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('public.sales.index', compact(
            'products',
            'categories',
            'filters'
        ));
    }

    public function show(string $slug): View
    {
        $product = SaleProduct::published()
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedProducts = SaleProduct::published()
            ->where('id', '!=', $product->id)
            ->when(
                $product->category,
                fn ($query) => $query->where('category', $product->category)
            )
            ->orderBy('display_order')
            ->latest()
            ->take(4)
            ->get();

        return view('public.sales.show', compact(
            'product',
            'relatedProducts'
        ));
    }
}

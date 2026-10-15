<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SaleProduct;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SaleProductController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:150'],
            'availability' => ['nullable', 'in:available,unavailable'],
            'publication' => ['nullable', 'in:published,draft'],
        ]);

        $query = SaleProduct::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];

            $query->where(function ($builder) use ($search) {
                $builder->where('name', 'like', "%{$search}%")
                    ->orWhere('sku', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if (($filters['availability'] ?? '') === 'available') {
            $query->where('is_available', true)
                ->where('stock_quantity', '>', 0);
        } elseif (($filters['availability'] ?? '') === 'unavailable') {
            $query->where(function ($builder) {
                $builder->where('is_available', false)
                    ->orWhere('stock_quantity', '<=', 0);
            });
        }

        if (($filters['publication'] ?? '') === 'published') {
            $query->where('is_published', true);
        } elseif (($filters['publication'] ?? '') === 'draft') {
            $query->where('is_published', false);
        }

        $products = $query->orderBy('display_order')
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $counts = [
            'total' => SaleProduct::count(),
            'published' => SaleProduct::where('is_published', true)->count(),
            'available' => SaleProduct::where('is_available', true)
                ->where('stock_quantity', '>', 0)
                ->count(),
            'unavailable' => SaleProduct::where(function ($builder) {
                $builder->where('is_available', false)
                    ->orWhere('stock_quantity', '<=', 0);
            })->count(),
        ];

        return view('admin.sales.index', compact(
            'products',
            'counts',
            'filters'
        ));
    }

    public function create(): View
    {
        return view('admin.sales.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);

        $data['slug'] = $this->uniqueSlug($data['name']);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')
                ->store('sales/products', 'public');
        }

        unset($data['image']);

        SaleProduct::create($data);

        return redirect()
            ->route('admin.sales.index')
            ->with('success', 'Product created successfully.');
    }

    public function show(SaleProduct $sale): View
    {
        return view('admin.sales.show', ['product' => $sale]);
    }

    public function edit(SaleProduct $sale): View
    {
        return view('admin.sales.edit', ['product' => $sale]);
    }

    public function update(Request $request, SaleProduct $sale): RedirectResponse
    {
        $data = $this->validatedData($request, $sale);

        if ($data['name'] !== $sale->name) {
            $data['slug'] = $this->uniqueSlug($data['name'], $sale->id);
        }

        if ($request->hasFile('image')) {
            $newImage = $request->file('image')
                ->store('sales/products', 'public');

            if ($sale->image_path) {
                Storage::disk('public')->delete($sale->image_path);
            }

            $data['image_path'] = $newImage;
        }

        unset($data['image']);

        $sale->update($data);

        return redirect()
            ->route('admin.sales.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(SaleProduct $sale): RedirectResponse
    {
        // Preserve the image until the product is permanently removed.
        // Soft deletion allows recovery if needed.
        $sale->delete();

        return redirect()
            ->route('admin.sales.index')
            ->with('success', 'Product moved to deleted items.');
    }

    private function validatedData(
        Request $request,
        ?SaleProduct $sale = null
    ): array {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sku' => [
                'nullable',
                'string',
                'max:100',
                Rule::unique('sale_products', 'sku')
                    ->ignore($sale?->id),
            ],
            'category' => ['nullable', 'string', 'max:150'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string', 'max:10000'],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
            'price' => ['nullable', 'numeric', 'min:0', 'max:9999999999.99'],
            'is_price_visible' => ['required', 'boolean'],
            'is_available' => ['required', 'boolean'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'is_published' => ['required', 'boolean'],
            'display_order' => ['required', 'integer', 'min:0'],
        ]);
    }

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name) ?: 'product';
        $slug = $base;
        $counter = 1;

        while (
            SaleProduct::withTrashed()
                ->where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base . '-' . $counter++;
        }

        return $slug;
    }
}

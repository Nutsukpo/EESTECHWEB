
@extends('layouts.app')

@section('title', 'Sales Management')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="mb-1">Sales Management</h2>
            <p class="text-muted mb-0">
                Manage products, prices, stock and public listings.
            </p>
        </div>

        <a href="{{ route('admin.sales.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add Product
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-3 mb-4">
        @foreach ([
            ['label' => 'Total Products', 'value' => $counts['total'], 'icon' => 'fa-boxes-stacked'],
            ['label' => 'Published', 'value' => $counts['published'], 'icon' => 'fa-globe'],
            ['label' => 'Available', 'value' => $counts['available'], 'icon' => 'fa-check-circle'],
            ['label' => 'Unavailable', 'value' => $counts['unavailable'], 'icon' => 'fa-ban'],
        ] as $card)
            <div class="col-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-light p-3">
                            <i class="fas {{ $card['icon'] }} text-primary"></i>
                        </div>
                        <div>
                            <div class="text-muted small">{{ $card['label'] }}</div>
                            <h4 class="mb-0">{{ $card['value'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.sales.index') }}"
                  class="row g-3 mb-4">
                <div class="col-lg-5">
                    <input
                        type="search"
                        name="search"
                        class="form-control"
                        placeholder="Search product, SKU or category..."
                        value="{{ $filters['search'] ?? '' }}"
                    >
                </div>

                <div class="col-md-4 col-lg-3">
                    <select name="availability" class="form-select">
                        <option value="">All stock statuses</option>
                        <option value="available"
                            @selected(($filters['availability'] ?? '') === 'available')>
                            Available
                        </option>
                        <option value="unavailable"
                            @selected(($filters['availability'] ?? '') === 'unavailable')>
                            Unavailable
                        </option>
                    </select>
                </div>

                <div class="col-md-4 col-lg-2">
                    <select name="publication" class="form-select">
                        <option value="">All listings</option>
                        <option value="published"
                            @selected(($filters['publication'] ?? '') === 'published')>
                            Published
                        </option>
                        <option value="draft"
                            @selected(($filters['publication'] ?? '') === 'draft')>
                            Draft
                        </option>
                    </select>
                </div>

                <div class="col-md-4 col-lg-2 d-flex gap-2">
                    <button class="btn btn-outline-primary flex-grow-1">
                        Filter
                    </button>
                    <a href="{{ route('admin.sales.index') }}"
                       class="btn btn-outline-secondary">
                        Reset
                    </a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Publication</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        @if ($product->image_path)
                                            <img
                                                src="{{ asset('storage/' . $product->image_path) }}"
                                                alt="{{ $product->name }}"
                                                width="58"
                                                height="58"
                                                class="rounded border"
                                                style="object-fit:contain;"
                                            >
                                        @else
                                            <div class="bg-light rounded border d-flex align-items-center justify-content-center"
                                                 style="width:58px;height:58px;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        @endif

                                        <div>
                                            <strong>{{ $product->name }}</strong>
                                            <div class="small text-muted">
                                                {{ $product->sku ?: 'No SKU' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td>{{ $product->category ?: '—' }}</td>

                                <td>
                                    @if ($product->is_price_visible && $product->price !== null)
                                        GH₵ {{ number_format((float) $product->price, 2) }}
                                    @else
                                        <span class="badge text-bg-secondary">Hidden</span>
                                    @endif
                                </td>

                                <td>
                                    @if ($product->is_available && $product->stock_quantity > 0)
                                        <span class="badge text-bg-success">
                                            Available ({{ $product->stock_quantity }})
                                        </span>
                                    @else
                                        <span class="badge text-bg-danger">Out of stock</span>
                                    @endif
                                </td>

                                <td>
                                    @if ($product->is_published)
                                        <span class="badge text-bg-success">Published</span>
                                    @else
                                        <span class="badge text-bg-secondary">Draft</span>
                                    @endif
                                </td>

                                <td class="text-end text-nowrap">
                                    <a href="{{ route('admin.sales.show', $product) }}"
                                       class="btn btn-sm btn-outline-info"
                                       title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{ route('admin.sales.edit', $product) }}"
                                       class="btn btn-sm btn-outline-primary"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('admin.sales.destroy', $product) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Move this product to deleted items?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <i class="fas fa-box-open fa-2x text-muted mb-3"></i>
                                    <p class="mb-0">No products found.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection

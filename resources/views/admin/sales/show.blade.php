
@extends('layouts.app')

@section('title', 'Product Details')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="mb-1">Product Details</h2>
            <p class="text-muted mb-0">{{ $product->name }}</p>
        </div>

        <a href="{{ route('admin.sales.edit', $product) }}"
           class="btn btn-primary">
            <i class="fas fa-edit me-2"></i>Edit Product
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-4">
                    @if ($product->image_path)
                        <img
                            src="{{ asset('storage/' . $product->image_path) }}"
                            alt="{{ $product->name }}"
                            class="img-fluid rounded border"
                        >
                    @else
                        <div class="bg-light rounded border p-5 text-center">
                            <i class="fas fa-image fa-3x text-muted"></i>
                            <p class="mt-3 mb-0">No product image uploaded.</p>
                        </div>
                    @endif
                </div>

                <div class="col-md-8">
                    <h3>{{ $product->name }}</h3>
                    <p class="text-muted">{{ $product->short_description }}</p>

                    <p><strong>SKU:</strong> {{ $product->sku ?: '—' }}</p>
                    <p><strong>Category:</strong> {{ $product->category ?: '—' }}</p>

                    <p>
                        <strong>Price:</strong>
                        @if ($product->is_price_visible && $product->price !== null)
                            GH₵ {{ number_format((float) $product->price, 2) }}
                        @else
                            Hidden from public
                        @endif
                    </p>

                    <p><strong>Quantity:</strong> {{ $product->stock_quantity }}</p>

                    <p>
                        <strong>Availability:</strong>
                        {{ $product->is_available && $product->stock_quantity > 0
                            ? 'Available'
                            : 'Out of stock' }}
                    </p>

                    <p>
                        <strong>Publication:</strong>
                        {{ $product->is_published ? 'Published' : 'Draft' }}
                    </p>

                    <hr>

                    <h5>Description</h5>
                    <div class="text-break">{{ $product->description ?: 'No full description provided.' }}</div>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('admin.sales.index') }}"
       class="btn btn-outline-secondary mt-3">
        Back to Sales
    </a>
</div>
@endsection

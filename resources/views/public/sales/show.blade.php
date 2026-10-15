
@extends('layouts.public')

@section('title', $product->name . ' | EES Technologies Ghana')

@section('content')
@php
    $inStock = $product->is_available && $product->stock_quantity > 0;

    $enquiryMessage = 'Hello EES Technologies, I am interested in '
        . $product->name
        . '. Please provide more information.';

    $whatsappUrl = 'https://wa.me/?text=' . rawurlencode($enquiryMessage);
@endphp

<section class="py-5 bg-light">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('sales.index') }}">Sales</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $product->name }}
                </li>
            </ol>
        </nav>

        <div class="row g-5">
            <div class="col-lg-6">
                <div class="product-detail-image">
                    @if ($product->image_path)
                        <img
                            src="{{ asset('storage/' . $product->image_path) }}"
                            alt="{{ $product->name }}"
                        >
                    @else
                        <div class="text-center text-muted">
                            <i class="fas fa-image fa-4x mb-3"></i>
                            <p>No product image available.</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-6">
                @if ($product->category)
                    <span class="badge text-bg-primary mb-3">
                        {{ $product->category }}
                    </span>
                @endif

                <h1 class="fw-bold mb-3">{{ $product->name }}</h1>

                <div class="mb-4">
                    @if ($product->is_price_visible && $product->price !== null)
                        <span class="product-detail-price">
                            GH₵ {{ number_format((float) $product->price, 2) }}
                        </span>
                    @else
                        <span class="product-detail-enquiry">
                            Contact us for pricing
                        </span>
                    @endif
                </div>

                <div class="mb-4">
                    @if ($inStock)
                        <span class="badge text-bg-success px-3 py-2">
                            <i class="fas fa-check-circle me-1"></i> Available
                        </span>
                    @else
                        <span class="badge text-bg-danger px-3 py-2">
                            <i class="fas fa-times-circle me-1"></i> Out of stock
                        </span>
                    @endif
                </div>

                @if ($product->short_description)
                    <p class="lead text-secondary">
                        {{ $product->short_description }}
                    </p>
                @endif

                <div class="product-detail-description mb-4">
                    {{ $product->description ?: 'Contact our team for additional product specifications and information.' }}
                </div>

                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ $whatsappUrl }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="btn btn-success btn-lg">
                        <i class="fab fa-whatsapp me-2"></i>Enquire on WhatsApp
                    </a>

                    <a href="{{ route('contact.index') }}"
                       class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-envelope me-2"></i>Contact Us
                    </a>
                </div>

                @if ($product->sku)
                    <p class="small text-muted mt-4">
                        Product code: {{ $product->sku }}
                    </p>
                @endif
            </div>
        </div>
    </div>
</section>

@if ($relatedProducts->isNotEmpty())
    <section class="py-5">
        <div class="container">
            <h2 class="fw-bold mb-4">Related Products</h2>

            <div class="row g-4">
                @foreach ($relatedProducts as $related)
                    <div class="col-6 col-lg-3">
                        <a href="{{ route('sales.show', $related->slug) }}"
                           class="related-product">
                            @if ($related->image_path)
                                <img
                                    src="{{ asset('storage/' . $related->image_path) }}"
                                    alt="{{ $related->name }}"
                                    loading="lazy"
                                >
                            @else
                                <div class="related-no-image">
                                    <i class="fas fa-image fa-2x"></i>
                                </div>
                            @endif

                            <div class="p-3">
                                <h3>{{ $related->name }}</h3>

                                @if ($related->is_price_visible && $related->price !== null)
                                    <strong>
                                        GH₵ {{ number_format((float) $related->price, 2) }}
                                    </strong>
                                @else
                                    <strong>Contact for price</strong>
                                @endif
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

@push('styles')
<style>
.product-detail-image {
    min-height: 350px;
    max-height: 520px;
    background: #fff;
    border: 1px solid #e6ebf1;
    border-radius: 18px;
    padding: 28px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.product-detail-image img {
    max-width: 100%;
    max-height: 460px;
    object-fit: contain;
}
.product-detail-price {
    font-size: 2rem;
    font-weight: 800;
    color: #08794f;
}
.product-detail-enquiry {
    font-size: 1.4rem;
    font-weight: 700;
    color: #245a8d;
}
.product-detail-description {
    color: #4c5868;
    line-height: 1.9;
    white-space: pre-line;
}
.related-product {
    display: block;
    height: 100%;
    border: 1px solid #e6ebf1;
    border-radius: 12px;
    overflow: hidden;
    text-decoration: none;
    color: #172d47;
}
.related-product img {
    width: 100%;
    height: 180px;
    object-fit: contain;
    padding: 12px;
    background: #f7f9fc;
}
.related-no-image {
    height: 180px;
    display: grid;
    place-items: center;
    color: #a2adba;
    background: #f7f9fc;
}
.related-product h3 {
    font-size: 1rem;
    font-weight: 700;
}
.related-product strong {
    color: #08794f;
}
</style>
@endpush
@endsection

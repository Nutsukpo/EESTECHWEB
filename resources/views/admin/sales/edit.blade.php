
@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="container-fluid py-4">
    <div class="mb-4">
        <h2 class="mb-1">Edit Product</h2>
        <p class="text-muted mb-0">{{ $product->name }}</p>
    </div>

    <form action="{{ route('admin.sales.update', $product) }}" method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('admin.sales._form', [
            'product' => $product,
            'buttonText' => 'Update Product',
        ])
    </form>
</div>
@endsection

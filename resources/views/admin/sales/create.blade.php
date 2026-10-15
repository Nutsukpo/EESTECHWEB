
@extends('layouts.app')

@section('title', 'Add Product')

@section('content')
<div class="container-fluid py-4">
    <div class="mb-4">
        <h2 class="mb-1">Add Product</h2>
        <p class="text-muted mb-0">Add a new item to the EES-Tech catalogue.</p>
    </div>

    <form action="{{ route('admin.sales.store') }}" method="POST"
          enctype="multipart/form-data">
        @csrf
        @include('admin.sales._form', ['buttonText' => 'Create Product'])
    </form>
</div>
@endsection

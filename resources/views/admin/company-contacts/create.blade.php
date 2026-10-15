
@extends('layouts.app')

@section('title', 'Add Company Contact Details')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="h3 mb-1">Add Contact Details</h1>
            <p class="text-muted mb-0">Register the company's public contact information.</p>
        </div>

        <a href="{{ route('company-contacts.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Please correct the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('company-contacts.store') }}" method="POST">
        @csrf

        @include('admin.company-contacts._form', [
            'contact' => null,
            'submitLabel' => 'Save Contact Details'
        ])
    </form>
</div>
@endsection

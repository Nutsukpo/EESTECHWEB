@extends('layouts.app')

@section('title', 'Create Department')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="h3 mb-1">
                Create Department
            </h1>

            <p class="text-muted mb-0">
                Add a new department to EES-Tech.
            </p>
        </div>

        <a
            href="{{ route('departments.index') }}"
            class="btn btn-outline-secondary"
        >
            <i class="fas fa-arrow-left me-1"></i>
            Back to Departments
        </a>

    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">
            <h5 class="mb-0">
                <i class="fas fa-building me-2 text-primary"></i>
                Department Information
            </h5>
        </div>

        <div class="card-body">

            <form
                action="{{ route('departments.store') }}"
                method="POST"
            >

                @include('departments._form')

            </form>

        </div>

    </div>

</div>

@endsection
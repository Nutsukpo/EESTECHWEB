@extends('layouts.app')

@section('title', 'Edit Department')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="h3 mb-1">
                Edit Department
            </h1>

            <p class="text-muted mb-0">
                Update department information.
            </p>
        </div>

        <div class="d-flex gap-2">

            <a
                href="{{ route('departments.show', $department) }}"
                class="btn btn-outline-primary"
            >
                <i class="fas fa-eye me-1"></i>
                View
            </a>

            <a
                href="{{ route('departments.index') }}"
                class="btn btn-outline-secondary"
            >
                <i class="fas fa-arrow-left me-1"></i>
                Back
            </a>

        </div>

    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">

            <h5 class="mb-0">
                <i class="fas fa-building me-2 text-primary"></i>
                Edit Department
            </h5>

        </div>

        <div class="card-body">

            <form
                action="{{ route('departments.update', $department) }}"
                method="POST"
            >

                @include('departments._form')

            </form>

        </div>

    </div>

</div>

@endsection
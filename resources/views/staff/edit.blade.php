@extends('layouts.app')

@section('title', 'Edit Staff')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold mb-1">
                Edit Staff
            </h3>

            <p class="text-muted mb-0">
                Update {{ $staff->full_name }}'s information.
            </p>

        </div>

        <a
            href="{{ route('staff.show', $staff) }}"
            class="btn btn-light"
        >
            <i class="fa-solid fa-arrow-left me-2"></i>
            Back
        </a>

    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <form
                method="POST"
                action="{{ route('staff.update', $staff) }}"
                enctype="multipart/form-data"
            >

                @method('PUT')

                @include('staff._form')


                <div class="d-flex justify-content-end gap-2 mt-4">

                    <a
                        href="{{ route('staff.show', $staff) }}"
                        class="btn btn-light"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="btn btn-dark"
                    >
                        <i class="fa-solid fa-save me-2"></i>
                        Update Staff
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
@extends('layouts.app')

@section('title', 'Add Hero Slide')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold mb-1">
                Add Hero Slide
            </h3>

            <p class="text-muted mb-0">
                Add a new image and content to the homepage slideshow.
            </p>

        </div>

        <a
            href="{{ route('admin.hero-slides.index') }}"
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
                action="{{ route('admin.hero-slides.store') }}"
                enctype="multipart/form-data"
            >

                @include('admin.website.hero._form')


                <div class="d-flex justify-content-end gap-2 mt-4">

                    <a
                        href="{{ route('admin.hero-slides.index') }}"
                        class="btn btn-light"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="btn btn-dark"
                    >
                        <i class="fa-solid fa-save me-2"></i>
                        Save Hero Slide
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
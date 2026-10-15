@extends('layouts.app')

@section('title', 'Hero Slides')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold mb-1">
                Hero Slides
            </h3>

            <p class="text-muted mb-0">
                Manage the images and content displayed in the homepage hero slideshow.
            </p>

        </div>

       

            <a
                href="{{ route('admin.hero-slides.create') }}"
                class="btn btn-dark"
            >
                <i class="fa-solid fa-plus me-2"></i>
                Add Hero Slide
            </a>

       

    </div>


    @if(session('success'))

        <div class="alert alert-success">
            <i class="fa-solid fa-circle-check me-2"></i>
            {{ session('success') }}
        </div>

    @endif


    <div class="row g-4">

        @forelse($slides as $slide)

            <div class="col-xl-4 col-md-6">

                <div class="card border-0 shadow-sm h-100">

                    <div class="position-relative">

                        <img
                            src="{{ asset('storage/' . $slide->image) }}"
                            class="card-img-top"
                            style="height:220px; object-fit:cover;"
                            alt="{{ $slide->title }}"
                        >


                        <div
                            class="position-absolute top-0 end-0 m-3"
                        >

                            @if($slide->is_active)

                                <span class="badge bg-success">
                                    Active
                                </span>

                            @else

                                <span class="badge bg-secondary">
                                    Inactive
                                </span>

                            @endif

                        </div>

                    </div>


                    <div class="card-body">

                        <div class="small text-muted mb-1">
                            Slide {{ $slide->display_order + 1 }}
                        </div>


                        @if($slide->badge)

                            <div class="text-primary small fw-bold mb-2">
                                {{ $slide->badge }}
                            </div>

                        @endif


                        <h5 class="fw-bold">
                            {{ $slide->title }}
                        </h5>


                        @if($slide->highlight)

                            <div class="text-primary fw-bold">
                                {{ $slide->highlight }}
                            </div>

                        @endif


                        <p class="text-muted small">
                            {{ Str::limit($slide->description, 100) }}
                        </p>


                        <div class="small text-muted">

                            <i class="fa-solid fa-clock me-1"></i>

                            {{ $slide->duration / 1000 }} seconds

                        </div>

                    </div>


                    <div class="card-footer bg-white border-0">

                        <div class="d-flex gap-2">

                            
                                <a
                                    href="{{ route('admin.hero-slides.edit', $slide) }}"
                                    class="btn btn-sm btn-outline-dark flex-fill"
                                >
                                    <i class="fa-solid fa-pen me-1"></i>
                                    Edit
                                </a>


                                <form
                                    method="POST"
                                    action="{{ route('admin.hero-slides.toggle-status', $slide) }}"
                                >

                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-outline-secondary"
                                    >
                                        {{ $slide->is_active ? 'Disable' : 'Enable' }}
                                    </button>

                                </form>

                          


                         

                                <form
                                    method="POST"
                                    action="{{ route('admin.hero-slides.destroy', $slide) }}"
                                    onsubmit="return confirm('Delete this hero slide?');"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-outline-danger"
                                    >
                                        <i class="fa-solid fa-trash"></i>
                                    </button>

                                </form>

                        

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="card border-0 shadow-sm">

                    <div class="card-body text-center py-5">

                        <i class="fa-solid fa-images fa-3x text-muted mb-3"></i>

                        <h5 class="fw-bold">
                            No Hero Slides
                        </h5>

                        <p class="text-muted">
                            Add your first homepage hero slide.
                        </p>

                    </div>

                </div>

            </div>

        @endforelse

    </div>

</div>

@endsection
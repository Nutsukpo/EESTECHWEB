@extends('layouts.app')

@section('title', 'About Us')

@section('content')

<div class="container-fluid py-4">

    {{-- =========================================================
         PAGE HEADER
    ========================================================== --}}

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>
            <h1 class="h3 fw-bold mb-1">
                About Us
            </h1>

            <p class="text-muted mb-0">
                Manage the About Us content displayed on the EES-Tech website.
            </p>
        </div>

        <div class="d-flex gap-2">

            <a href="{{ route('home') }}"
               target="_blank"
               class="btn btn-outline-primary">

                <i class="bi bi-eye me-1"></i>

                View Website

            </a>

        </div>

    </div>


    {{-- =========================================================
         SUCCESS MESSAGE
    ========================================================== --}}

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show"
             role="alert">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- =========================================================
         VALIDATION ERRORS
    ========================================================== --}}

    @if($errors->any())

        <div class="alert alert-danger">

            <div class="fw-bold mb-2">
                Please correct the following:
            </div>

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <form action="{{ route('admin.about.update') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        @method('PUT')


        <div class="row g-4">

            {{-- =================================================
                 LEFT COLUMN
            ================================================== --}}

            <div class="col-xl-8">

                {{-- =============================================
                     ABOUT CONTENT
                ============================================== --}}

                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white border-0 p-4">

                        <div class="d-flex align-items-center">

                            <div class="rounded-3 bg-primary bg-opacity-10
                                        text-primary d-flex align-items-center
                                        justify-content-center me-3"
                                 style="width:45px;height:45px;">

                                <i class="bi bi-info-circle fs-5"></i>

                            </div>

                            <div>

                                <h5 class="fw-bold mb-1">
                                    About Information
                                </h5>

                                <p class="text-muted small mb-0">
                                    Main content displayed in the About Us section.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="card-body p-4">

                        {{-- Title --}}

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                About Title
                            </label>

                            <input type="text"
                                   name="title"
                                   class="form-control form-control-lg"
                                   value="{{ old('title', $about->title) }}"
                                   placeholder="Pioneering the next wave of digital innovation."
                                   required>

                            <div class="form-text">
                                The main headline displayed on the About page.
                            </div>

                        </div>


                        {{-- Subtitle --}}

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Subtitle
                            </label>

                            <input type="text"
                                   name="subtitle"
                                   class="form-control"
                                   value="{{ old('subtitle', $about->subtitle) }}"
                                   placeholder="ABOUT EES TECHNOLOGIES GHANA">

                        </div>


                        {{-- Description --}}

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Description
                            </label>

                            <textarea name="description"
                                      rows="6"
                                      class="form-control"
                                      placeholder="Enter the main About Us description..."
                                      required>{{ old('description', $about->description) }}</textarea>

                            <div class="form-text">
                                Main company introduction.
                            </div>

                        </div>


                        {{-- Description Two --}}

                        <div>

                            <label class="form-label fw-semibold">
                                Additional Description
                            </label>

                            <textarea name="description_two"
                                      rows="5"
                                      class="form-control"
                                      placeholder="Enter additional company information...">{{ old('description_two', $about->description_two) }}</textarea>

                            <div class="form-text">
                                Additional information displayed below the main description.
                            </div>

                        </div>

                    </div>

                </div>


                {{-- =============================================
                     MISSION
                ============================================== --}}

                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white border-0 p-4">

                        <div class="d-flex align-items-center">

                            <div class="rounded-3 bg-primary bg-opacity-10
                                        text-primary d-flex align-items-center
                                        justify-content-center me-3"
                                 style="width:45px;height:45px;">

                                <i class="bi bi-bullseye fs-5"></i>

                            </div>

                            <div>

                                <h5 class="fw-bold mb-1">
                                    Our Mission
                                </h5>

                                <p class="text-muted small mb-0">
                                    Define the mission displayed on the About page.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="card-body p-4">

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Mission Title
                            </label>

                            <input type="text"
                                   name="mission_title"
                                   class="form-control"
                                   value="{{ old('mission_title', $about->mission_title) }}"
                                   required>

                        </div>


                        <div>

                            <label class="form-label fw-semibold">
                                Mission Statement
                            </label>

                            <textarea name="mission"
                                      rows="7"
                                      class="form-control"
                                      placeholder="Enter your company's mission..."
                                      required>{{ old('mission', $about->mission) }}</textarea>

                        </div>

                    </div>

                </div>


                {{-- =============================================
                     VISION
                ============================================== --}}

                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white border-0 p-4">

                        <div class="d-flex align-items-center">

                            <div class="rounded-3 bg-primary bg-opacity-10
                                        text-primary d-flex align-items-center
                                        justify-content-center me-3"
                                 style="width:45px;height:45px;">

                                <i class="bi bi-eye fs-5"></i>

                            </div>

                            <div>

                                <h5 class="fw-bold mb-1">
                                    Our Vision
                                </h5>

                                <p class="text-muted small mb-0">
                                    Define the vision displayed on the About page.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="card-body p-4">

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Vision Title
                            </label>

                            <input type="text"
                                   name="vision_title"
                                   class="form-control"
                                   value="{{ old('vision_title', $about->vision_title) }}"
                                   required>

                        </div>


                        <div>

                            <label class="form-label fw-semibold">
                                Vision Statement
                            </label>

                            <textarea name="vision"
                                      rows="7"
                                      class="form-control"
                                      placeholder="Enter your company's vision..."
                                      required>{{ old('vision', $about->vision) }}</textarea>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 RIGHT COLUMN
            ================================================== --}}

            <div class="col-xl-4">


                {{-- =============================================
                     ABOUT IMAGE
                ============================================== --}}

                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white border-0 p-4">

                        <h5 class="fw-bold mb-1">
                            About Image
                        </h5>

                        <p class="text-muted small mb-0">
                            Main image displayed beside the About content.
                        </p>

                    </div>


                    <div class="card-body p-4">

                        @if($about->image)

                            <div class="mb-3">

                                <img src="{{ asset('storage/' . $about->image) }}"
                                     alt="About image"
                                     class="img-fluid rounded-3 w-100"
                                     style="max-height:300px;object-fit:cover;">

                            </div>

                        @else

                            <div class="rounded-3 bg-light d-flex
                                        flex-column align-items-center
                                        justify-content-center p-5 mb-3"
                                 style="min-height:220px;">

                                <i class="bi bi-image text-muted fs-1 mb-2"></i>

                                <span class="text-muted">
                                    No About image uploaded
                                </span>

                            </div>

                        @endif


                        <label class="form-label fw-semibold">
                            Upload Image
                        </label>

                        <input type="file"
                               name="image"
                               class="form-control"
                               accept=".jpg,.jpeg,.png,.webp">

                        <div class="form-text">
                            JPG, JPEG, PNG or WEBP. Maximum 5MB.
                        </div>

                    </div>

                </div>


                {{-- =============================================
                     STATUS
                ============================================== --}}

                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between
                                    align-items-center">

                            <div>

                                <h6 class="fw-bold mb-1">
                                    Page Status
                                </h6>

                                <p class="text-muted small mb-0">
                                    Control whether the About page is active.
                                </p>

                            </div>


                            <div class="form-check form-switch">

                                <input class="form-check-input"
                                       type="checkbox"
                                       name="is_active"
                                       value="1"
                                       id="is_active"
                                       {{ old('is_active', $about->is_active) ? 'checked' : '' }}>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =============================================
                     SAVE
                ============================================== --}}

                <div class="card border-0 shadow-sm">

                    <div class="card-body p-4">

                        <button type="submit"
                                class="btn btn-primary w-100 py-2">

                            <i class="bi bi-check-circle me-2"></i>

                            Save About Us

                        </button>

                    </div>

                </div>


            </div>

        </div>

    </form>

</div>

@endsection
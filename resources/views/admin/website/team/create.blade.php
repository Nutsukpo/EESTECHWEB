@extends('layouts.app')

@section('title', 'Add Team Member')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="fw-bold mb-1">Add Team Member</h4>

            <p class="text-muted mb-0">
                Add a member to the EES-Tech team.
            </p>
        </div>

        <a
            href="{{ route('admin.team.index') }}"
            class="btn btn-outline-secondary"
        >
            <i class="fas fa-arrow-left me-1"></i>
            Back
        </a>

    </div>


    <form
        action="{{ route('admin.team.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf

        <div class="row g-4">

            <!-- LEFT -->
            <div class="col-lg-8">

                <div class="card border-0 shadow-sm">

                    <div class="card-body">

                        <h5 class="fw-bold mb-4">
                            Personal Information
                        </h5>

                        <div class="row g-3">

                            <div class="col-md-6">

                                <label class="form-label">
                                    Full Name
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}"
                                    required
                                >

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Position
                                </label>

                                <input
                                    type="text"
                                    name="position"
                                    class="form-control @error('position') is-invalid @enderror"
                                    value="{{ old('position') }}"
                                    placeholder="e.g. Chief Executive Officer"
                                    required
                                >

                                @error('position')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Department
                                </label>

                                <input
                                    type="text"
                                    name="department"
                                    class="form-control"
                                    value="{{ old('department') }}"
                                    placeholder="e.g. Technology & Development"
                                >

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    value="{{ old('email') }}"
                                >

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Phone
                                </label>

                                <input
                                    type="text"
                                    name="phone"
                                    class="form-control"
                                    value="{{ old('phone') }}"
                                >

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Display Order
                                </label>

                                <input
                                    type="number"
                                    name="display_order"
                                    class="form-control"
                                    value="{{ old('display_order', 0) }}"
                                    min="0"
                                    required
                                >

                                <small class="text-muted">
                                    Lower numbers appear first.
                                </small>

                            </div>


                            <div class="col-12">

                                <label class="form-label">
                                    Description
                                </label>

                                <textarea
                                    name="description"
                                    rows="5"
                                    class="form-control"
                                    placeholder="Brief description about this team member..."
                                >{{ old('description') }}</textarea>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- SOCIAL MEDIA -->

                <div class="card border-0 shadow-sm mt-4">

                    <div class="card-body">

                        <h5 class="fw-bold mb-4">
                            Social Media
                        </h5>

                        <div class="row g-3">

                            <div class="col-md-4">

                                <label class="form-label">
                                    LinkedIn
                                </label>

                                <input
                                    type="url"
                                    name="linkedin_url"
                                    class="form-control"
                                    value="{{ old('linkedin_url') }}"
                                    placeholder="https://linkedin.com/..."
                                >

                            </div>


                            <div class="col-md-4">

                                <label class="form-label">
                                    Facebook
                                </label>

                                <input
                                    type="url"
                                    name="facebook_url"
                                    class="form-control"
                                    value="{{ old('facebook_url') }}"
                                    placeholder="https://facebook.com/..."
                                >

                            </div>


                            <div class="col-md-4">

                                <label class="form-label">
                                    Instagram
                                </label>

                                <input
                                    type="url"
                                    name="instagram_url"
                                    class="form-control"
                                    value="{{ old('instagram_url') }}"
                                    placeholder="https://instagram.com/..."
                                >

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- RIGHT -->

            <div class="col-lg-4">

                <div class="card border-0 shadow-sm">

                    <div class="card-body">

                        <h5 class="fw-bold mb-4">
                            Profile Photo
                        </h5>

                        <div class="text-center mb-3">

                            <img
                                id="photoPreview"
                                src=""
                                alt="Preview"
                                class="rounded-circle d-none"
                                style="
                                    width:180px;
                                    height:180px;
                                    object-fit:cover;
                                "
                            >

                            <div
                                id="photoPlaceholder"
                                class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto"
                                style="
                                    width:180px;
                                    height:180px;
                                "
                            >
                                <i class="fas fa-user fa-4x text-muted"></i>
                            </div>

                        </div>


                        <input
                            type="file"
                            name="photo"
                            id="photo"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        <small class="text-muted d-block mt-2">
                            JPG, PNG or WEBP. Maximum 5MB.
                        </small>

                    </div>

                </div>


                <div class="card border-0 shadow-sm mt-4">

                    <div class="card-body">

                        <div class="form-check form-switch">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="is_active"
                                value="1"
                                id="is_active"
                                {{ old('is_active', true) ? 'checked' : '' }}
                            >

                            <label
                                class="form-check-label fw-semibold"
                                for="is_active"
                            >
                                Publish on website
                            </label>

                        </div>

                    </div>

                </div>


                <button
                    type="submit"
                    class="btn btn-primary w-100 mt-4"
                >
                    <i class="fas fa-save me-1"></i>
                    Save Team Member
                </button>

            </div>

        </div>

    </form>

</div>


<script>

document.getElementById('photo').addEventListener('change', function(event) {

    const file = event.target.files[0];

    if (!file) {
        return;
    }

    const reader = new FileReader();

    reader.onload = function(e) {

        document.getElementById('photoPreview').src = e.target.result;

        document
            .getElementById('photoPreview')
            .classList
            .remove('d-none');

        document
            .getElementById('photoPlaceholder')
            .classList
            .add('d-none');
    };

    reader.readAsDataURL(file);

});

</script>

@endsection
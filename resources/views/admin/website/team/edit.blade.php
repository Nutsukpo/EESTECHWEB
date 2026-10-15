@extends('layouts.app')

@section('title', 'Edit Team Member')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Edit Team Member</h4>
            <p class="text-muted mb-0">
                Update {{ $teamMember->name }}'s information.
            </p>
        </div>

        <a href="{{ route('admin.team.index') }}"
           class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i>
            Back to Team
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Please correct the following:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.team.update', $teamMember) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="row g-4">

            {{-- MAIN INFORMATION --}}
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
                                    class="form-control"
                                    value="{{ old('name', $teamMember->name) }}"
                                    required
                                >
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">
                                    Position
                                </label>

                                <input
                                    type="text"
                                    name="position"
                                    class="form-control"
                                    value="{{ old('position', $teamMember->position) }}"
                                    required
                                >
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">
                                    Department
                                </label>

                                <input
                                    type="text"
                                    name="department"
                                    class="form-control"
                                    value="{{ old('department', $teamMember->department) }}"
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
                                    value="{{ old('email', $teamMember->email) }}"
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
                                    value="{{ old('phone', $teamMember->phone) }}"
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
                                    min="0"
                                    value="{{ old('display_order', $teamMember->display_order) }}"
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
                                >{{ old('description', $teamMember->description) }}</textarea>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- SOCIAL MEDIA --}}

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
                                    value="{{ old('linkedin_url', $teamMember->linkedin_url) }}"
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
                                    value="{{ old('facebook_url', $teamMember->facebook_url) }}"
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
                                    value="{{ old('instagram_url', $teamMember->instagram_url) }}"
                                >

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- PHOTO / STATUS --}}

            <div class="col-lg-4">

                <div class="card border-0 shadow-sm">

                    <div class="card-body">

                        <h5 class="fw-bold mb-4">
                            Profile Photo
                        </h5>

                        <div class="text-center mb-4">

                            @if($teamMember->photo)

                                <img
                                    id="photoPreview"
                                    src="{{ asset('storage/' . $teamMember->photo) }}"
                                    alt="{{ $teamMember->name }}"
                                    class="rounded-circle shadow-sm"
                                    style="
                                        width:180px;
                                        height:180px;
                                        object-fit:cover;
                                    "
                                >

                            @else

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

                                <img
                                    id="photoPreview"
                                    src=""
                                    alt="Preview"
                                    class="rounded-circle shadow-sm d-none"
                                    style="
                                        width:180px;
                                        height:180px;
                                        object-fit:cover;
                                    "
                                >

                            @endif

                        </div>

                        <input
                            type="file"
                            name="photo"
                            id="photo"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        <small class="text-muted d-block mt-2">
                            Upload a new image only if you want to replace
                            the current photo.
                        </small>

                    </div>

                </div>


                {{-- STATUS --}}

                <div class="card border-0 shadow-sm mt-4">

                    <div class="card-body">

                        <div class="form-check form-switch">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="is_active"
                                value="1"
                                id="is_active"
                                {{ old('is_active', $teamMember->is_active) ? 'checked' : '' }}
                            >

                            <label
                                class="form-check-label fw-semibold"
                                for="is_active"
                            >
                                Publish on website
                            </label>

                        </div>

                        <small class="text-muted d-block mt-2">
                            Inactive team members will not appear on the
                            public website.
                        </small>

                    </div>

                </div>


                <button
                    type="submit"
                    class="btn btn-primary w-100 mt-4"
                >
                    <i class="fas fa-save me-1"></i>
                    Update Team Member
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

        const preview = document.getElementById('photoPreview');
        const placeholder = document.getElementById('photoPlaceholder');

        preview.src = e.target.result;
        preview.classList.remove('d-none');

        if (placeholder) {
            placeholder.classList.add('d-none');
        }
    };

    reader.readAsDataURL(file);

});

</script>

@endsection
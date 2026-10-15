@extends('layouts.app')

@section('title', $teamMember->name)

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="fw-bold mb-1">
                Team Member
            </h4>

            <p class="text-muted mb-0">
                View team member details.
            </p>
        </div>

        <div class="d-flex gap-2">

            <a
                href="{{ route('admin.team.edit', $teamMember) }}"
                class="btn btn-primary"
            >
                <i class="fas fa-edit me-1"></i>
                Edit
            </a>

            <a
                href="{{ route('admin.team.index') }}"
                class="btn btn-outline-secondary"
            >
                <i class="fas fa-arrow-left me-1"></i>
                Back
            </a>

        </div>

    </div>


    <div class="row g-4">

        {{-- PROFILE --}}

        <div class="col-lg-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center py-5">

                    @if($teamMember->photo)

                        <img
                            src="{{ asset('storage/' . $teamMember->photo) }}"
                            alt="{{ $teamMember->name }}"
                            class="rounded-circle shadow-sm mb-4"
                            style="
                                width:200px;
                                height:200px;
                                object-fit:cover;
                            "
                        >

                    @else

                        <div
                            class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto mb-4"
                            style="
                                width:200px;
                                height:200px;
                            "
                        >
                            <i class="fas fa-user fa-5x text-muted"></i>
                        </div>

                    @endif


                    <h3 class="fw-bold mb-1">
                        {{ $teamMember->name }}
                    </h3>

                    <p class="text-primary fw-semibold mb-2">
                        {{ $teamMember->position }}
                    </p>

                    @if($teamMember->department)

                        <p class="text-muted mb-3">
                            {{ $teamMember->department }}
                        </p>

                    @endif


                    @if($teamMember->is_active)

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

        </div>


        {{-- DETAILS --}}

        <div class="col-lg-8">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <h5 class="fw-bold mb-4">
                        Professional Information
                    </h5>


                    @if($teamMember->description)

                        <div class="mb-4">

                            <h6 class="fw-semibold">
                                About
                            </h6>

                            <p class="text-muted">
                                {{ $teamMember->description }}
                            </p>

                        </div>

                    @endif


                    <div class="row g-4">

                        @if($teamMember->email)

                            <div class="col-md-6">

                                <small class="text-muted d-block">
                                    Email
                                </small>

                                <a href="mailto:{{ $teamMember->email }}">
                                    {{ $teamMember->email }}
                                </a>

                            </div>

                        @endif


                        @if($teamMember->phone)

                            <div class="col-md-6">

                                <small class="text-muted d-block">
                                    Phone
                                </small>

                                <a href="tel:{{ $teamMember->phone }}">
                                    {{ $teamMember->phone }}
                                </a>

                            </div>

                        @endif


                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Display Order
                            </small>

                            <strong>
                                {{ $teamMember->display_order }}
                            </strong>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Website Visibility
                            </small>

                            <strong>
                                {{ $teamMember->is_active ? 'Published' : 'Hidden' }}
                            </strong>

                        </div>

                    </div>

                </div>

            </div>


            {{-- SOCIAL LINKS --}}

            @if(
                $teamMember->linkedin_url ||
                $teamMember->facebook_url ||
                $teamMember->instagram_url
            )

                <div class="card border-0 shadow-sm mt-4">

                    <div class="card-body">

                        <h5 class="fw-bold mb-4">
                            Social Media
                        </h5>

                        <div class="d-flex gap-2 flex-wrap">

                            @if($teamMember->linkedin_url)

                                <a
                                    href="{{ $teamMember->linkedin_url }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="btn btn-outline-primary"
                                >
                                    <i class="fab fa-linkedin me-1"></i>
                                    LinkedIn
                                </a>

                            @endif


                            @if($teamMember->facebook_url)

                                <a
                                    href="{{ $teamMember->facebook_url }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="btn btn-outline-primary"
                                >
                                    <i class="fab fa-facebook me-1"></i>
                                    Facebook
                                </a>

                            @endif


                            @if($teamMember->instagram_url)

                                <a
                                    href="{{ $teamMember->instagram_url }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="btn btn-outline-danger"
                                >
                                    <i class="fab fa-instagram me-1"></i>
                                    Instagram
                                </a>

                            @endif

                        </div>

                    </div>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection
@extends('layouts.app')

@section('title', 'User Details')

@section('content')

<div class="container-fluid">

    {{-- Header --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold mb-1">
                User Details
            </h3>

            <p class="text-muted mb-0">
                View account information and permissions.
            </p>

        </div>

        <div class="d-flex gap-2">

            <a
                href="{{ route('users.index') }}"
                class="btn btn-light border"
            >

                <i class="fa-solid fa-arrow-left me-2"></i>

                Back

            </a>

            @can('edit users')

                <a
                    href="{{ route('users.edit', $user) }}"
                    class="btn btn-dark"
                >

                    <i class="fa-solid fa-pen me-2"></i>

                    Edit User

                </a>

            @endcan

        </div>

    </div>


    <div class="row g-4">

        {{-- Profile --}}

        <div class="col-lg-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center p-4">

                    @if($user->profile_photo)

                        <img
                            src="{{ asset('storage/' . $user->profile_photo) }}"
                            alt="{{ $user->name }}"
                            class="rounded-circle mb-3"
                            width="120"
                            height="120"
                            style="object-fit:cover;"
                        >

                    @else

                        <div
                            class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3"
                            style="width:120px;height:120px;font-size:42px;"
                        >

                            {{ strtoupper(substr($user->name, 0, 1)) }}

                        </div>

                    @endif


                    <h4 class="fw-bold mb-1">
                        {{ $user->name }}
                    </h4>

                    <p class="text-muted mb-3">
                        {{ $user->email }}
                    </p>


                    @forelse($user->roles as $role)

                        <span class="badge bg-primary mb-3">
                            {{ $role->name }}
                        </span>

                    @empty

                        <span class="badge bg-secondary mb-3">
                            No Role Assigned
                        </span>

                    @endforelse


                    <div>

                        @if($user->status === 'active')

                            <span class="badge bg-success-subtle text-success">

                                <i class="fa-solid fa-circle fa-xs me-1"></i>

                                Active Account

                            </span>

                        @else

                            <span class="badge bg-danger-subtle text-danger">

                                <i class="fa-solid fa-circle fa-xs me-1"></i>

                                Inactive Account

                            </span>

                        @endif

                    </div>

                </div>

            </div>

        </div>


        {{-- Account Information --}}

        <div class="col-lg-8">

            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white py-3">

                    <h5 class="fw-bold mb-0">
                        Account Information
                    </h5>

                </div>

                <div class="card-body">

                    <div class="row g-4">

                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Full Name
                            </small>

                            <strong>
                                {{ $user->name }}
                            </strong>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Email Address
                            </small>

                            <strong>
                                {{ $user->email }}
                            </strong>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Phone Number
                            </small>

                            <strong>

                                {{ $user->phone ?: 'Not provided' }}

                            </strong>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Department
                            </small>

                            <strong>

                                {{ $user->department?->name ?: 'Not assigned' }}

                            </strong>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Account Created
                            </small>

                            <strong>

                                {{ $user->created_at?->format('d F Y, h:i A') }}

                            </strong>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Last Updated
                            </small>

                            <strong>

                                {{ $user->updated_at?->format('d F Y, h:i A') }}

                            </strong>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Roles & Permissions --}}

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white py-3">

                    <h5 class="fw-bold mb-0">
                        Roles & Permissions
                    </h5>

                </div>

                <div class="card-body">

                    <h6 class="fw-bold">
                        Assigned Roles
                    </h6>

                    <div class="mb-4">

                        @forelse($user->roles as $role)

                            <span class="badge bg-primary me-1">

                                {{ $role->name }}

                            </span>

                        @empty

                            <span class="text-muted">
                                No roles assigned.
                            </span>

                        @endforelse

                    </div>


                    <h6 class="fw-bold">
                        Direct Permissions
                    </h6>

                    @if($user->permissions->count())

                        <div class="row g-2">

                            @foreach($user->permissions as $permission)

                                <div class="col-md-6">

                                    <div class="border rounded p-2">

                                        <i class="fa-solid fa-check text-success me-2"></i>

                                        {{ $permission->name }}

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @else

                        <p class="text-muted mb-0">
                            No direct permissions assigned.
                            Permissions are inherited from the user's role.
                        </p>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
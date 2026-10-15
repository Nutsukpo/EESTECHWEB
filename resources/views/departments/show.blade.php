@extends('layouts.app')

@section('title', $department->name)

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <div class="d-flex align-items-center gap-3">

                <div
                    class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center"
                    style="width: 55px; height: 55px;"
                >
                    <i class="fas fa-building fa-lg"></i>
                </div>

                <div>

                    <h1 class="h3 mb-1">
                        {{ $department->name }}
                    </h1>

                    <p class="text-muted mb-0">
                        Department Details
                    </p>

                </div>

            </div>

        </div>


        <div class="d-flex gap-2">

            @can('edit departments')

                <a
                    href="{{ route('departments.edit', $department) }}"
                    class="btn btn-warning"
                >
                    <i class="fas fa-edit me-1"></i>
                    Edit
                </a>

            @endcan

            <a
                href="{{ route('departments.index') }}"
                class="btn btn-outline-secondary"
            >
                <i class="fas fa-arrow-left me-1"></i>
                Back
            </a>

        </div>

    </div>


    <div class="row g-4">

        {{-- Department Information --}}
        <div class="col-lg-5">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-header bg-white py-3">

                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2 text-primary"></i>
                        Department Information
                    </h5>

                </div>

                <div class="card-body">

                    <div class="mb-4">

                        <small class="text-muted d-block mb-1">
                            Department Name
                        </small>

                        <h5 class="mb-0">
                            {{ $department->name }}
                        </h5>

                    </div>


                    <div class="mb-4">

                        <small class="text-muted d-block mb-1">
                            Department Code
                        </small>

                        @if($department->code)

                            <span class="badge bg-light text-dark border fs-6">
                                {{ $department->code }}
                            </span>

                        @else

                            <span class="text-muted">
                                Not specified
                            </span>

                        @endif

                    </div>


                    <div class="mb-4">

                        <small class="text-muted d-block mb-1">
                            Status
                        </small>

                        @if($department->status === 'active')

                            <span class="badge bg-success">
                                <i class="fas fa-check-circle me-1"></i>
                                Active
                            </span>

                        @else

                            <span class="badge bg-secondary">
                                <i class="fas fa-ban me-1"></i>
                                Inactive
                            </span>

                        @endif

                    </div>


                    <div class="mb-4">

                        <small class="text-muted d-block mb-1">
                            Description
                        </small>

                        @if($department->description)

                            <p class="mb-0 text-muted">
                                {{ $department->description }}
                            </p>

                        @else

                            <span class="text-muted">
                                No description provided.
                            </span>

                        @endif

                    </div>


                    <div class="row">

                        <div class="col-6">

                            <small class="text-muted d-block">
                                Created
                            </small>

                            <strong>
                                {{ $department->created_at->format('d M Y') }}
                            </strong>

                        </div>

                        <div class="col-6">

                            <small class="text-muted d-block">
                                Last Updated
                            </small>

                            <strong>
                                {{ $department->updated_at->format('d M Y') }}
                            </strong>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Department Users --}}
        <div class="col-lg-7">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-header bg-white py-3">

                    <div class="d-flex justify-content-between align-items-center">

                        <h5 class="mb-0">
                            <i class="fas fa-users me-2 text-primary"></i>
                            Department Users
                        </h5>

                        <span class="badge bg-primary">
                            {{ $department->users->count() }}
                        </span>

                    </div>

                </div>


                <div class="card-body p-0">

                    @if($department->users->count())

                        <div class="table-responsive">

                            <table class="table table-hover align-middle mb-0">

                                <thead class="table-light">

                                    <tr>

                                        <th class="px-4">
                                            User
                                        </th>

                                        <th>
                                            Email
                                        </th>

                                        <th>
                                            Status
                                        </th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach($department->users as $user)

                                        <tr>

                                            <td class="px-4">

                                                <div class="d-flex align-items-center">

                                                    @if($user->profile_photo)

                                                        <img
                                                            src="{{ asset('storage/' . $user->profile_photo) }}"
                                                            alt="{{ $user->name }}"
                                                            class="rounded-circle me-2"
                                                            width="38"
                                                            height="38"
                                                            style="object-fit: cover;"
                                                        >

                                                    @else

                                                        <div
                                                            class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2"
                                                            style="width: 38px; height: 38px;"
                                                        >
                                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                                        </div>

                                                    @endif

                                                    <div>

                                                        <div class="fw-semibold">
                                                            {{ $user->name }}
                                                        </div>

                                                        @if($user->roles->count())

                                                            <small class="text-muted">
                                                                {{ $user->roles->pluck('name')->join(', ') }}
                                                            </small>

                                                        @endif

                                                    </div>

                                                </div>

                                            </td>


                                            <td>
                                                {{ $user->email }}
                                            </td>


                                            <td>

                                                @if($user->status === 'active')

                                                    <span class="badge bg-success">
                                                        Active
                                                    </span>

                                                @else

                                                    <span class="badge bg-secondary">
                                                        Inactive
                                                    </span>

                                                @endif

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    @else

                        <div class="text-center py-5">

                            <i class="fas fa-users fa-2x text-muted mb-3"></i>

                            <h6>
                                No users assigned
                            </h6>

                            <p class="text-muted mb-0">
                                There are currently no users in this department.
                            </p>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
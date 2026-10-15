@extends('layouts.app')

@section('title', $staff->full_name)

@section('content')

<div class="container-fluid">

    {{-- HEADER ACTIONS --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold mb-1">
                Staff Profile
            </h3>

            <p class="text-muted mb-0">
                Employee information and employment details.
            </p>

        </div>


        <div class="d-flex gap-2">

            <a
                href="{{ route('staff.index') }}"
                class="btn btn-light"
            >
                <i class="fa-solid fa-arrow-left me-2"></i>
                Back
            </a>


            @can('edit staff')

                <a
                    href="{{ route('staff.edit', $staff) }}"
                    class="btn btn-dark"
                >
                    <i class="fa-solid fa-pen me-2"></i>
                    Edit
                </a>

            @endcan

        </div>

    </div>


    {{-- PROFILE HEADER --}}

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body p-4">

            <div class="row align-items-center">

                <div class="col-md-3 text-center">

                    @if($staff->profile_photo)

                        <img
                            src="{{ asset('storage/' . $staff->profile_photo) }}"
                            alt="{{ $staff->full_name }}"
                            class="rounded-circle shadow-sm"
                            width="170"
                            height="170"
                            style="object-fit: cover;"
                        >

                    @else

                        <div
                            class="rounded-circle bg-light border d-flex align-items-center justify-content-center mx-auto"
                            style="width:170px;height:170px;"
                        >

                            <span
                                class="fw-bold"
                                style="font-size:55px;"
                            >
                                {{ strtoupper(
                                    substr($staff->first_name, 0, 1) .
                                    substr($staff->last_name, 0, 1)
                                ) }}
                            </span>

                        </div>

                    @endif

                </div>


                <div class="col-md-9">

                    <h2 class="fw-bold mb-2">
                        {{ $staff->full_name }}
                    </h2>


                    <div class="d-flex flex-wrap gap-2 mb-3">

                        <span class="badge bg-dark">
                            {{ $staff->position }}
                        </span>


                        @if($staff->department)

                            <span class="badge bg-light text-dark border">
                                {{ $staff->department->name }}
                            </span>

                        @endif


                        @if($staff->status === 'active')

                            <span class="badge bg-success">
                                Active
                            </span>

                        @else

                            <span class="badge bg-secondary">
                                Inactive
                            </span>

                        @endif

                    </div>


                    <div class="row g-3">

                        <div class="col-md-6">

                            <div class="text-muted small">
                                Staff ID
                            </div>

                            <div class="fw-semibold">
                                {{ $staff->staff_id }}
                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="text-muted small">
                                Email
                            </div>

                            <div class="fw-semibold">
                                {{ $staff->email }}
                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="text-muted small">
                                Phone
                            </div>

                            <div class="fw-semibold">
                                {{ $staff->phone ?? '—' }}
                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="text-muted small">
                                Department
                            </div>

                            <div class="fw-semibold">
                                {{ $staff->department?->name ?? '—' }}
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- DETAILS --}}

    <div class="row g-4">

        {{-- PERSONAL INFORMATION --}}

        <div class="col-lg-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-header bg-white border-0 pt-4 px-4">

                    <h5 class="fw-bold mb-0">

                        <i class="fa-solid fa-user me-2"></i>

                        Personal Information

                    </h5>

                </div>


                <div class="card-body px-4">

                    <div class="table-responsive">

                        <table class="table table-bordered align-middle mb-0">

                            <tr>

                                <th width="40%">
                                    First Name
                                </th>

                                <td>
                                    {{ $staff->first_name }}
                                </td>

                            </tr>


                            <tr>

                                <th>
                                    Last Name
                                </th>

                                <td>
                                    {{ $staff->last_name }}
                                </td>

                            </tr>


                            <tr>

                                <th>
                                    Other Name
                                </th>

                                <td>
                                    {{ $staff->other_name ?? '—' }}
                                </td>

                            </tr>


                            <tr>

                                <th>
                                    Gender
                                </th>

                                <td>
                                    {{ $staff->gender ?? '—' }}
                                </td>

                            </tr>


                            <tr>

                                <th>
                                    Date of Birth
                                </th>

                                <td>
                                    {{ $staff->date_of_birth?->format('F d, Y') ?? '—' }}
                                </td>

                            </tr>


                            <tr>

                                <th>
                                    Address
                                </th>

                                <td>
                                    {{ $staff->address ?? '—' }}
                                </td>

                            </tr>

                        </table>

                    </div>

                </div>

            </div>

        </div>


        {{-- EMPLOYMENT INFORMATION --}}

        <div class="col-lg-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-header bg-white border-0 pt-4 px-4">

                    <h5 class="fw-bold mb-0">

                        <i class="fa-solid fa-briefcase me-2"></i>

                        Employment Information

                    </h5>

                </div>


                <div class="card-body px-4">

                    <div class="table-responsive">

                        <table class="table table-bordered align-middle mb-0">

                            <tr>

                                <th width="40%">
                                    Department
                                </th>

                                <td>
                                    {{ $staff->department?->name ?? '—' }}
                                </td>

                            </tr>


                            <tr>

                                <th>
                                    Position
                                </th>

                                <td>
                                    {{ $staff->position }}
                                </td>

                            </tr>


                            <tr>

                                <th>
                                    Salary
                                </th>

                                <td class="fw-bold">

                                    @if($staff->salary !== null)

                                        GHS {{ number_format($staff->salary, 2) }}

                                    @else

                                        —

                                    @endif

                                </td>

                            </tr>


                            <tr>

                                <th>
                                    Employment Date
                                </th>

                                <td>
                                    {{ $staff->employment_date?->format('F d, Y') ?? '—' }}
                                </td>

                            </tr>


                            <tr>

                                <th>
                                    Status
                                </th>

                                <td>

                                    @if($staff->status === 'active')

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


                            <tr>

                                <th>
                                    System Account
                                </th>

                                <td>

                                    @if($staff->user)

                                        <span class="badge bg-success">
                                            Connected
                                        </span>

                                    @else

                                        <span class="badge bg-light text-dark border">
                                            Not Connected
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- RECORD INFORMATION --}}

    <div class="card border-0 shadow-sm mt-4">

        <div class="card-body text-center text-muted small">

            Record ID: #{{ $staff->id }}

            <span class="mx-2">|</span>

            Created:
            {{ $staff->created_at?->format('F d, Y h:i A') }}

            <span class="mx-2">|</span>

            Updated:
            {{ $staff->updated_at?->format('F d, Y h:i A') }}

        </div>

    </div>

</div>

@endsection
@extends('layouts.app')

@section('title', 'Staff Management')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold mb-1">
                Staff
            </h3>

            <p class="text-muted mb-0">
                Manage EES-Tech employees and employment records.
            </p>
        </div>


        @can('create staff')

            <a
                href="{{ route('staff.create') }}"
                class="btn btn-dark"
            >
                <i class="fa-solid fa-user-plus me-2"></i>
                Add Staff
            </a>

        @endcan

    </div>


    {{-- ALERTS --}}

    @if(session('success'))

        <div class="alert alert-success">
            <i class="fa-solid fa-circle-check me-2"></i>
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="alert alert-danger">
            <i class="fa-solid fa-circle-exclamation me-2"></i>
            {{ session('error') }}
        </div>

    @endif


    {{-- FILTERS --}}

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <form method="GET" action="{{ route('staff.index') }}">

                <div class="row g-3">

                    <div class="col-lg-5">

                        <label class="form-label fw-semibold">
                            Search
                        </label>

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            value="{{ request('search') }}"
                            placeholder="Search name, staff ID, email, phone..."
                        >

                    </div>


                    <div class="col-lg-3">

                        <label class="form-label fw-semibold">
                            Department
                        </label>

                        <select
                            name="department_id"
                            class="form-select"
                        >

                            <option value="">
                                All Departments
                            </option>

                            @foreach($departments as $department)

                                <option
                                    value="{{ $department->id }}"
                                    @selected(request('department_id') == $department->id)
                                >
                                    {{ $department->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="col-lg-2">

                        <label class="form-label fw-semibold">
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-select"
                        >

                            <option value="">
                                All
                            </option>

                            <option
                                value="active"
                                @selected(request('status') === 'active')
                            >
                                Active
                            </option>

                            <option
                                value="inactive"
                                @selected(request('status') === 'inactive')
                            >
                                Inactive
                            </option>

                        </select>

                    </div>


                    <div class="col-lg-2 d-flex align-items-end">

                        <button
                            type="submit"
                            class="btn btn-dark w-100"
                        >
                            <i class="fa-solid fa-filter me-2"></i>
                            Filter
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- STAFF TABLE --}}

    <div class="card border-0 shadow-sm">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th class="px-4">
                                Staff
                            </th>

                            <th>
                                Staff ID
                            </th>

                            <th>
                                Department
                            </th>

                            <th>
                                Position
                            </th>

                            <th>
                                Phone
                            </th>

                            <th>
                                Status
                            </th>

                            <th class="text-end px-4">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($staff as $member)

                            <tr>

                                {{-- STAFF --}}

                                <td class="px-4">

                                    <div class="d-flex align-items-center">

                                        @if($member->profile_photo)

                                            <img
                                                src="{{ asset('storage/' . $member->profile_photo) }}"
                                                alt="{{ $member->full_name }}"
                                                class="rounded-circle me-3"
                                                width="45"
                                                height="45"
                                                style="object-fit: cover;"
                                            >

                                        @else

                                            <div
                                                class="rounded-circle bg-dark text-white d-flex align-items-center justify-content-center me-3"
                                                style="width:45px;height:45px;"
                                            >
                                                {{ strtoupper(substr($member->first_name, 0, 1) . substr($member->last_name, 0, 1)) }}
                                            </div>

                                        @endif


                                        <div>

                                            <div class="fw-semibold">
                                                {{ $member->full_name }}
                                            </div>

                                            <small class="text-muted">
                                                {{ $member->email }}
                                            </small>

                                        </div>

                                    </div>

                                </td>


                                {{-- STAFF ID --}}

                                <td>
                                    {{ $member->staff_id }}
                                </td>


                                {{-- DEPARTMENT --}}

                                <td>

                                    {{ $member->department?->name ?? '—' }}

                                </td>


                                {{-- POSITION --}}

                                <td>
                                    {{ $member->position }}
                                </td>


                                {{-- PHONE --}}

                                <td>
                                    {{ $member->phone ?? '—' }}
                                </td>


                                {{-- STATUS --}}

                                <td>

                                    @if($member->status === 'active')

                                        <span class="badge bg-success">
                                            Active
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            Inactive
                                        </span>

                                    @endif

                                </td>


                                {{-- ACTIONS --}}

                                <td class="text-end px-4">

                                    <div class="dropdown">

                                        <button
                                            class="btn btn-sm btn-light"
                                            data-bs-toggle="dropdown"
                                        >
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>


                                        <ul class="dropdown-menu dropdown-menu-end">

                                            @can('view staff')

                                                <li>

                                                    <a
                                                        class="dropdown-item"
                                                        href="{{ route('staff.show', $member) }}"
                                                    >
                                                        <i class="fa-solid fa-eye me-2"></i>
                                                        View
                                                    </a>

                                                </li>

                                            @endcan


                                            @can('edit staff')

                                                <li>

                                                    <a
                                                        class="dropdown-item"
                                                        href="{{ route('staff.edit', $member) }}"
                                                    >
                                                        <i class="fa-solid fa-pen me-2"></i>
                                                        Edit
                                                    </a>

                                                </li>


                                                <li>

                                                    <form
                                                        method="POST"
                                                        action="{{ route('staff.toggle-status', $member) }}"
                                                    >

                                                        @csrf
                                                        @method('PATCH')

                                                        <button
                                                            type="submit"
                                                            class="dropdown-item"
                                                        >

                                                            @if($member->status === 'active')

                                                                <i class="fa-solid fa-user-slash me-2"></i>
                                                                Deactivate

                                                            @else

                                                                <i class="fa-solid fa-user-check me-2"></i>
                                                                Activate

                                                            @endif

                                                        </button>

                                                    </form>

                                                </li>

                                            @endcan


                                            @can('delete staff')

                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>

                                                <li>

                                                    <form
                                                        method="POST"
                                                        action="{{ route('staff.destroy', $member) }}"
                                                        onsubmit="return confirm('Delete this staff record?');"
                                                    >

                                                        @csrf
                                                        @method('DELETE')

                                                        <button
                                                            type="submit"
                                                            class="dropdown-item text-danger"
                                                        >

                                                            <i class="fa-solid fa-trash me-2"></i>
                                                            Delete

                                                        </button>

                                                    </form>

                                                </li>

                                            @endcan

                                        </ul>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="7"
                                    class="text-center py-5"
                                >

                                    <i class="fa-solid fa-users fa-2x text-muted mb-3"></i>

                                    <h6 class="fw-bold">
                                        No staff records found
                                    </h6>

                                    <p class="text-muted mb-0">
                                        Staff members will appear here once added.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        @if($staff->hasPages())

            <div class="card-footer bg-white">

                {{ $staff->links() }}

            </div>

        @endif

    </div>

</div>

@endsection
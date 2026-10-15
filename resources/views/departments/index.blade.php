@extends('layouts.app')

@section('title', 'Departments')

@section('content')

<div class="container-fluid">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="h3 mb-1">
                Departments
            </h1>

            <p class="text-muted mb-0">
                Manage EES-Tech departments and organizational units.
            </p>
        </div>

        @can('create departments')
            <a
                href="{{ route('departments.create') }}"
                class="btn btn-primary"
            >
                <i class="fas fa-plus me-1"></i>
                Add Department
            </a>
        @endcan

    </div>


    {{-- Search --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <div class="row">

                <div class="col-md-6">

                    <div class="input-group">

                        <span class="input-group-text bg-white">
                            <i class="fas fa-search text-muted"></i>
                        </span>

                        <input
                            type="text"
                            id="departmentSearch"
                            class="form-control"
                            placeholder="Search departments..."
                        >

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Departments Table --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">

            <div class="d-flex justify-content-between align-items-center">

                <h5 class="mb-0">
                    <i class="fas fa-building me-2 text-primary"></i>
                    All Departments
                </h5>

                <span class="badge bg-light text-dark">
                    {{ $departments->total() }} Total
                </span>

            </div>

        </div>


        <div class="card-body p-0">

            @if($departments->count())

                <div class="table-responsive">

                    <table
                        class="table table-hover align-middle mb-0"
                        id="departmentsTable"
                    >

                        <thead class="table-light">

                            <tr>

                                <th class="px-4">
                                    Department
                                </th>

                                <th>
                                    Code
                                </th>

                                <th>
                                    Users
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Created
                                </th>

                                <th class="text-end px-4">
                                    Actions
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($departments as $department)

                                <tr>

                                    {{-- Department --}}
                                    <td class="px-4">

                                        <div class="d-flex align-items-center">

                                            <div
                                                class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center me-3"
                                                style="width: 42px; height: 42px;"
                                            >
                                                <i class="fas fa-building"></i>
                                            </div>

                                            <div>

                                                <div class="fw-semibold department-name">
                                                    {{ $department->name }}
                                                </div>

                                                @if($department->description)
                                                    <small class="text-muted">
                                                        {{ Str::limit($department->description, 60) }}
                                                    </small>
                                                @endif

                                            </div>

                                        </div>

                                    </td>


                                    {{-- Code --}}
                                    <td>

                                        @if($department->code)

                                            <span class="badge bg-light text-dark border">
                                                {{ $department->code }}
                                            </span>

                                        @else
                                            <span class="text-muted">
                                                —
                                            </span>
                                        @endif

                                    </td>


                                    {{-- Users --}}
                                    <td>

                                        <span class="badge bg-info bg-opacity-10 text-info">
                                            <i class="fas fa-users me-1"></i>
                                            {{ $department->users_count }}
                                        </span>

                                    </td>


                                    {{-- Status --}}
                                    <td>

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

                                    </td>


                                    {{-- Created --}}
                                    <td>

                                        <span class="text-muted">
                                            {{ $department->created_at->format('d M Y') }}
                                        </span>

                                    </td>


                                    {{-- Actions --}}
                                    <td class="text-end px-4">

                                        <div class="dropdown">

                                            <button
                                                class="btn btn-sm btn-light border"
                                                type="button"
                                                data-bs-toggle="dropdown"
                                            >
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>

                                            <ul class="dropdown-menu dropdown-menu-end">

                                                @can('view departments')
                                                    <li>
                                                        <a
                                                            class="dropdown-item"
                                                            href="{{ route('departments.show', $department) }}"
                                                        >
                                                            <i class="fas fa-eye fa-fw me-2 text-primary"></i>
                                                            View
                                                        </a>
                                                    </li>
                                                @endcan


                                                @can('edit departments')

                                                    <li>
                                                        <a
                                                            class="dropdown-item"
                                                            href="{{ route('departments.edit', $department) }}"
                                                        >
                                                            <i class="fas fa-edit fa-fw me-2 text-warning"></i>
                                                            Edit
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <form
                                                            action="{{ route('departments.toggle-status', $department) }}"
                                                            method="POST"
                                                        >
                                                            @csrf
                                                            @method('PATCH')

                                                            <button
                                                                type="submit"
                                                                class="dropdown-item"
                                                            >

                                                                @if($department->status === 'active')

                                                                    <i class="fas fa-ban fa-fw me-2 text-secondary"></i>
                                                                    Deactivate

                                                                @else

                                                                    <i class="fas fa-check fa-fw me-2 text-success"></i>
                                                                    Activate

                                                                @endif

                                                            </button>

                                                        </form>
                                                    </li>

                                                @endcan


                                                @can('delete departments')

                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>

                                                    <li>

                                                        <form
                                                            action="{{ route('departments.destroy', $department) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Are you sure you want to delete this department?');"
                                                        >

                                                            @csrf
                                                            @method('DELETE')

                                                            <button
                                                                type="submit"
                                                                class="dropdown-item text-danger"
                                                            >
                                                                <i class="fas fa-trash fa-fw me-2"></i>
                                                                Delete
                                                            </button>

                                                        </form>

                                                    </li>

                                                @endcan

                                            </ul>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="text-center py-5">

                    <div
                        class="rounded-circle bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center mb-3"
                        style="width: 70px; height: 70px;"
                    >
                        <i class="fas fa-building fa-2x"></i>
                    </div>

                    <h5>
                        No departments found
                    </h5>

                    <p class="text-muted">
                        Start by creating your first department.
                    </p>

                    @can('create departments')
                        <a
                            href="{{ route('departments.create') }}"
                            class="btn btn-primary"
                        >
                            <i class="fas fa-plus me-1"></i>
                            Create Department
                        </a>
                    @endcan

                </div>

            @endif

        </div>


        @if($departments->hasPages())

            <div class="card-footer bg-white">

                {{ $departments->links() }}

            </div>

        @endif

    </div>

</div>

@endsection


@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('departmentSearch');
    const table = document.getElementById('departmentsTable');

    if (!searchInput || !table) {
        return;
    }

    searchInput.addEventListener('input', function () {

        const search = this.value.toLowerCase().trim();
        const rows = table.querySelectorAll('tbody tr');

        rows.forEach(function (row) {

            const text = row.textContent.toLowerCase();

            row.style.display = text.includes(search)
                ? ''
                : 'none';

        });

    });

});

</script>

@endpush
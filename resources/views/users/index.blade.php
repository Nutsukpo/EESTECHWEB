@extends('layouts.app')

@section('title', 'Users')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold mb-1">
                Users
            </h3>

            <p class="text-muted mb-0">
                Manage EES-Tech system users and access.
            </p>
        </div>

        @can('create users')
            <a
                href="{{ route('users.create') }}"
                class="btn btn-dark"
            >
                <i class="fa-solid fa-user-plus me-2"></i>
                Add User
            </a>
        @endcan

    </div>


    {{-- Flash Messages --}}

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            <i class="fa-solid fa-circle-check me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show">

            <i class="fa-solid fa-circle-exclamation me-2"></i>

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- Users Card --}}

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            {{-- Search / Filter Header --}}

            <div class="row g-3 align-items-center mb-4">

                <div class="col-md-6">

                    <h5 class="fw-bold mb-1">
                        System Users
                    </h5>

                    <small class="text-muted">
                        {{ $users->total() }} total users
                    </small>

                </div>

                <div class="col-md-6">

                    <div class="input-group">

                        <span class="input-group-text bg-white">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>

                        <input
                            type="text"
                            id="userSearch"
                            class="form-control"
                            placeholder="Search users..."
                        >

                    </div>

                </div>

            </div>


            {{-- Table --}}

            <div class="table-responsive">

                <table
                    class="table align-middle"
                    id="usersTable"
                >

                    <thead class="table-light">

                        <tr>

                            <th>User</th>

                            <th>Contact</th>

                            <th>Department</th>

                            <th>Role</th>

                            <th>Status</th>

                            <th>Created</th>

                            <th class="text-end">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($users as $user)

                            <tr>

                                {{-- User --}}

                                <td>

                                    <div class="d-flex align-items-center">

                                        @if($user->profile_photo)

                                            <img
                                                src="{{ asset('storage/' . $user->profile_photo) }}"
                                                alt="{{ $user->name }}"
                                                class="rounded-circle me-3"
                                                width="42"
                                                height="42"
                                                style="object-fit: cover;"
                                            >

                                        @else

                                            <div
                                                class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3"
                                                style="width:42px;height:42px;"
                                            >

                                                <strong>
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </strong>

                                            </div>

                                        @endif

                                        <div>

                                            <div class="fw-semibold">
                                                {{ $user->name }}
                                            </div>

                                            <small class="text-muted">
                                                {{ $user->email }}
                                            </small>

                                        </div>

                                    </div>

                                </td>


                                {{-- Contact --}}

                                <td>

                                    @if($user->phone)

                                        <div>
                                            {{ $user->phone }}
                                        </div>

                                    @else

                                        <span class="text-muted">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- Department --}}

                                <td>

                                    @if($user->department)

                                        <span>
                                            {{ $user->department->name }}
                                        </span>

                                    @else

                                        <span class="text-muted">
                                            Not assigned
                                        </span>

                                    @endif

                                </td>


                                {{-- Role --}}

                                <td>

                                    @forelse($user->roles as $role)

                                        @php

                                            $roleClass = match($role->name) {

                                                'Super Admin' => 'bg-danger',

                                                'Administrator' => 'bg-primary',

                                                'Manager' => 'bg-success',

                                                'IT Staff' => 'bg-info text-dark',

                                                'Accountant' => 'bg-warning text-dark',

                                                'HR Staff' => 'bg-secondary',

                                                default => 'bg-dark',

                                            };

                                        @endphp

                                        <span class="badge {{ $roleClass }}">

                                            {{ $role->name }}

                                        </span>

                                    @empty

                                        <span class="badge bg-light text-dark">
                                            No Role
                                        </span>

                                    @endforelse

                                </td>


                                {{-- Status --}}

                                <td>

                                    @if($user->status === 'active')

                                        <span class="badge bg-success-subtle text-success">

                                            <i class="fa-solid fa-circle fa-xs me-1"></i>

                                            Active

                                        </span>

                                    @else

                                        <span class="badge bg-danger-subtle text-danger">

                                            <i class="fa-solid fa-circle fa-xs me-1"></i>

                                            Inactive

                                        </span>

                                    @endif

                                </td>


                                {{-- Created --}}

                                <td>

                                    <small class="text-muted">

                                        {{ $user->created_at?->format('d M Y') }}

                                    </small>

                                </td>


                                {{-- Actions --}}

                                <td class="text-end">

                                    <div class="dropdown">

                                        <button
                                            class="btn btn-sm btn-light border dropdown-toggle"
                                            type="button"
                                            data-bs-toggle="dropdown"
                                        >

                                            <i class="fa-solid fa-ellipsis-vertical"></i>

                                        </button>


                                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">

                                            @can('view users')

                                                <li>

                                                    <a
                                                        href="{{ route('users.show', $user) }}"
                                                        class="dropdown-item"
                                                    >

                                                        <i class="fa-solid fa-eye me-2"></i>

                                                        View

                                                    </a>

                                                </li>

                                            @endcan


                                            @can('edit users')

                                                <li>

                                                    <a
                                                        href="{{ route('users.edit', $user) }}"
                                                        class="dropdown-item"
                                                    >

                                                        <i class="fa-solid fa-pen me-2"></i>

                                                        Edit

                                                    </a>

                                                </li>

                                                <li>

                                                    <form
                                                        method="POST"
                                                        action="{{ route('users.toggle-status', $user) }}"
                                                    >

                                                        @csrf
                                                        @method('PATCH')

                                                        <button
                                                            type="submit"
                                                            class="dropdown-item"
                                                        >

                                                            @if($user->status === 'active')

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


                                            @can('delete users')

                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>

                                                <li>

                                                    <form
                                                        method="POST"
                                                        action="{{ route('users.destroy', $user) }}"
                                                        onsubmit="return confirm('Are you sure you want to delete this user?');"
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

                                    <div class="text-muted">

                                        <i class="fa-solid fa-users fa-2x mb-3"></i>

                                        <h6>
                                            No users found
                                        </h6>

                                        <p class="mb-0">
                                            Create your first EES-Tech user.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- Pagination --}}

            @if($users->hasPages())

                <div class="d-flex justify-content-between align-items-center mt-4">

                    <div class="text-muted small">

                        Showing
                        {{ $users->firstItem() }}
                        to
                        {{ $users->lastItem() }}
                        of
                        {{ $users->total() }}
                        users

                    </div>

                    <div>
                        {{ $users->links() }}
                    </div>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection


@push('scripts')

<script>

document.getElementById('userSearch').addEventListener('keyup', function () {

    const search = this.value.toLowerCase();

    document
        .querySelectorAll('#usersTable tbody tr')
        .forEach(function (row) {

            row.style.display =
                row.innerText.toLowerCase().includes(search)
                    ? ''
                    : 'none';

        });

});

</script>

@endpush
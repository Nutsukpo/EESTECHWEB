@extends('layouts.app')

@section('title', 'Team Members')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Team Members</h4>
            <p class="text-muted mb-0">
                Manage the people displayed on the EES-Tech website.
            </p>
        </div>

        <a href="{{ route('admin.team.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>
            Add Team Member
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th width="80">Photo</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Department</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th width="180">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($teamMembers as $member)

                        <tr>

                            <td>

                                @if($member->photo)

                                    <img
                                        src="{{ asset('storage/' . $member->photo) }}"
                                        alt="{{ $member->name }}"
                                        width="55"
                                        height="55"
                                        class="rounded-circle object-fit-cover"
                                    >

                                @else

                                    <div
                                        class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                                        style="width:55px;height:55px;"
                                    >
                                        <i class="fas fa-user text-muted"></i>
                                    </div>

                                @endif

                            </td>

                            <td>
                                <div class="fw-semibold">
                                    {{ $member->name }}
                                </div>

                                @if($member->email)
                                    <small class="text-muted">
                                        {{ $member->email }}
                                    </small>
                                @endif
                            </td>

                            <td>
                                {{ $member->position }}
                            </td>

                            <td>
                                {{ $member->department ?? '—' }}
                            </td>

                            <td>
                                <span class="badge bg-secondary">
                                    {{ $member->display_order }}
                                </span>
                            </td>

                            <td>

                                @if($member->is_active)

                                    <span class="badge bg-success">
                                        Active
                                    </span>

                                @else

                                    <span class="badge bg-secondary">
                                        Inactive
                                    </span>

                                @endif

                            </td>

                            <td>

                                <div class="d-flex gap-1">

                                    <a
                                        href="{{ route('admin.team.show', $member) }}"
                                        class="btn btn-sm btn-outline-info"
                                        title="View"
                                    >
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a
                                        href="{{ route('admin.team.edit', $member) }}"
                                        class="btn btn-sm btn-outline-primary"
                                        title="Edit"
                                    >
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form
                                        action="{{ route('admin.team.toggle-status', $member) }}"
                                        method="POST"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-warning"
                                            title="Toggle status"
                                        >
                                            <i class="fas fa-power-off"></i>
                                        </button>

                                    </form>

                                    <form
                                        action="{{ route('admin.team.destroy', $member) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this team member?');"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            title="Delete"
                                        >
                                            <i class="fas fa-trash"></i>
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="text-center py-5">

                                <i class="fas fa-users fa-3x text-muted mb-3"></i>

                                <h5>No team members yet</h5>

                                <p class="text-muted">
                                    Add your first EES-Tech team member.
                                </p>

                                <a
                                    href="{{ route('admin.team.create') }}"
                                    class="btn btn-primary"
                                >
                                    Add Team Member
                                </a>

                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection
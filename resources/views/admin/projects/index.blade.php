
@extends('layouts.app')

@section('title', 'Our Projects')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="h3 mb-1">Our Projects</h1>
            <p class="text-muted mb-0">
                Manage projects displayed on the EES Technologies website.
            </p>
        </div>

        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add New Project
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h5 class="mb-0">Project Register</h5>
                <span class="badge bg-light text-dark">
                    {{ $projects->total() }} projects
                </span>
            </div>
        </div>

        <div class="card-body p-0">
            @if($projects->count())
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">Project</th>
                                <th>Category</th>
                                <th>Client</th>
                                <th>Status</th>
                                <th>Featured</th>
                                <th>Order</th>
                                <th class="text-end pe-3">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($projects as $project)
                                <tr>
                                    <td class="ps-3">
                                        <div class="d-flex align-items-center gap-3">
                                            @if($project->cover_image)
                                                <img
                                                    src="{{ asset('storage/' . $project->cover_image) }}"
                                                    alt="{{ $project->title }}"
                                                    width="64"
                                                    height="48"
                                                    class="rounded border"
                                                    style="object-fit: cover;"
                                                >
                                            @else
                                                <div
                                                    class="rounded border bg-light d-flex align-items-center justify-content-center"
                                                    style="width:64px;height:48px;"
                                                >
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                            @endif

                                            <div>
                                                <a
                                                    href="{{ route('admin.projects.show', $project) }}"
                                                    class="fw-semibold text-decoration-none"
                                                >
                                                    {{ $project->title }}
                                                </a>
                                                <div class="small text-muted">
                                                    {{ $project->slug }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>{{ $project->category ?: '—' }}</td>
                                    <td>{{ $project->client_name ?: '—' }}</td>

                                    <td>
                                        @if($project->is_published && $project->published_at && $project->published_at->lte(now()))
                                            <span class="badge bg-success">Published</span>
                                        @elseif($project->is_published)
                                            <span class="badge bg-warning text-dark">Scheduled</span>
                                        @else
                                            <span class="badge bg-secondary">Draft</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($project->is_featured)
                                            <span class="badge bg-info text-dark">
                                                <i class="fas fa-star me-1"></i>Featured
                                            </span>
                                        @else
                                            <span class="text-muted">No</span>
                                        @endif
                                    </td>

                                    <td>{{ $project->display_order }}</td>

                                    <td class="text-end pe-3">
                                        <div class="d-inline-flex gap-1">
                                            <a
                                                href="{{ route('admin.projects.show', $project) }}"
                                                class="btn btn-sm btn-outline-info"
                                                title="View project"
                                            >
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <a
                                                href="{{ route('admin.projects.edit', $project) }}"
                                                class="btn btn-sm btn-outline-primary"
                                                title="Edit project"
                                            >
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form
                                                action="{{ route('admin.projects.toggle-publication', $project) }}"
                                                method="POST"
                                                class="d-inline"
                                            >
                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm {{ $project->is_published ? 'btn-outline-warning' : 'btn-outline-success' }}"
                                                    title="{{ $project->is_published ? 'Unpublish project' : 'Publish project' }}"
                                                >
                                                    <i class="fas {{ $project->is_published ? 'fa-eye-slash' : 'fa-globe' }}"></i>
                                                </button>
                                            </form>

                                            <form
                                                action="{{ route('admin.projects.destroy', $project) }}"
                                                method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Move this project to the deleted records?');"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Delete project"
                                                >
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="p-3">
                    {{ $projects->links() }}
                </div>
            @else
                <div class="text-center py-5 px-3">
                    <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                    <h5>No Projects Registered</h5>
                    <p class="text-muted">
                        Add your first project to begin building your portfolio.
                    </p>
                    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Add First Project
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

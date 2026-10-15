
@extends('layouts.app')

@section('title', $project->title)

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="h3 mb-1">{{ $project->title }}</h1>
            <p class="text-muted mb-0">Project details and publication information.</p>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back
            </a>

            <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-primary">
                <i class="fas fa-edit me-1"></i> Edit Project
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                @if($project->cover_image)
                    <img
                        src="{{ asset('storage/' . $project->cover_image) }}"
                        alt="{{ $project->title }}"
                        class="card-img-top"
                        style="max-height:420px;object-fit:cover;"
                    >
                @else
                    <div
                        class="bg-light d-flex flex-column align-items-center justify-content-center text-muted"
                        style="height:240px;"
                    >
                        <i class="fas fa-image fa-3x mb-2"></i>
                        <span>No cover image uploaded</span>
                    </div>
                @endif

                <div class="card-body p-4">
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        @if($project->category)
                            <span class="badge bg-light text-dark">
                                {{ $project->category }}
                            </span>
                        @endif

                        @if($project->is_featured)
                            <span class="badge bg-info text-dark">
                                <i class="fas fa-star me-1"></i>Featured
                            </span>
                        @endif

                        @if($project->is_published && $project->published_at && $project->published_at->lte(now()))
                            <span class="badge bg-success">Published</span>
                        @elseif($project->is_published)
                            <span class="badge bg-warning text-dark">Scheduled</span>
                        @else
                            <span class="badge bg-secondary">Draft</span>
                        @endif
                    </div>

                    @if($project->short_description)
                        <p class="lead">{{ $project->short_description }}</p>
                    @endif

                    <hr>

                    <h5>Project Description</h5>
                    <div class="text-muted" style="white-space:pre-line;">{{ $project->description ?: 'No full description provided.' }}</div>

                    @if($project->challenge)
                        <hr>
                        <h5>Challenge</h5>
                        <div class="text-muted" style="white-space:pre-line;">{{ $project->challenge }}</div>
                    @endif

                    @if($project->solution)
                        <hr>
                        <h5>Solution</h5>
                        <div class="text-muted" style="white-space:pre-line;">{{ $project->solution }}</div>
                    @endif

                    @if($project->results)
                        <hr>
                        <h5>Results / Impact</h5>
                        <div class="text-muted" style="white-space:pre-line;">{{ $project->results }}</div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Project Summary</h5>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <small class="text-muted d-block">Client / Organisation</small>
                        <strong>{{ $project->client_name ?: 'Not specified' }}</strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Category</small>
                        <strong>{{ $project->category ?: 'Not specified' }}</strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">URL Slug</small>
                        <code>{{ $project->slug }}</code>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Display Order</small>
                        <strong>{{ $project->display_order }}</strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block">Created</small>
                        <strong>{{ $project->created_at?->format('d M Y, H:i') ?? '—' }}</strong>
                    </div>

                    <div class="mb-0">
                        <small class="text-muted d-block">Last Updated</small>
                        <strong>{{ $project->updated_at?->format('d M Y, H:i') ?? '—' }}</strong>
                    </div>

                    @if($project->project_url)
                        <hr>
                        <a
                            href="{{ $project->project_url }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="btn btn-outline-primary w-100"
                        >
                            <i class="fas fa-external-link-alt me-2"></i>Visit Project Website
                        </a>
                    @endif
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Technologies Used</h5>
                </div>

                <div class="card-body">
                    @forelse($project->technologies ?? [] as $technology)
                        <span class="badge bg-light text-dark border me-1 mb-2">
                            {{ $technology }}
                        </span>
                    @empty
                        <p class="text-muted mb-0">No technologies recorded.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


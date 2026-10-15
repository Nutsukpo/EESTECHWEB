
@extends('layouts.app')

@section('title', 'Edit Project')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="h3 mb-1">Edit Project</h1>
            <p class="text-muted mb-0">
                Update the details for <strong>{{ $project->title }}</strong>.
            </p>
        </div>

        <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Projects
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Please correct the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('admin.projects.update', $project) }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')

        @include('admin.projects._form', [
            'project' => $project,
            'submitLabel' => 'Save Changes'
        ])
    </form>
</div>
@endsection

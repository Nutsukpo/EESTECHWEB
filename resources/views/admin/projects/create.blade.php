
@extends('layouts.app')

@section('title', 'Add Project')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="h3 mb-1">Add New Project</h1>
            <p class="text-muted mb-0">
                Register a project developed or delivered by EES Technologies.
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

    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('admin.projects._form', [
            'project' => null,
            'submitLabel' => 'Create Project'
        ])
    </form>
</div>
@endsection

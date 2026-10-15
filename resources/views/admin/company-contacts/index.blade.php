@extends('layouts.app')

@section('title', 'Company Contact Details')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="h3 mb-1">Contact Us Management</h1>
            <p class="text-muted mb-0">Manage the contact details displayed on your public website.</p>
        </div>

        <a href="{{ route('company-contacts.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add Contact Details
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            Please correct the errors in your submission.
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">Registered Contact Records</h5>
        </div>

        <div class="card-body p-0">
            @if($contacts->count())
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">Company</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th class="text-end pe-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contacts as $contact)
                                <tr>
                                    <td class="ps-3 fw-semibold">{{ $contact->company_name }}</td>
                                    <td>{{ $contact->primary_phone ?: '—' }}</td>
                                    <td>{{ $contact->email ?: '—' }}</td>
                                    <td>{{ collect([$contact->city, $contact->region])->filter()->join(', ') ?: '—' }}</td>
                                    <td>
                                        @if($contact->is_published)
                                            <span class="badge bg-success">Published</span>
                                        @else
                                            <span class="badge bg-secondary">Draft</span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-3">
                                        <div class="d-inline-flex flex-wrap justify-content-end gap-1">
                                            <a
                                                href="{{ route('company-contacts.show', $contact) }}"
                                                class="btn btn-sm btn-outline-info"
                                                title="View"
                                            ><i class="fas fa-eye"></i></a>

                                            <a
                                                href="{{ route('company-contacts.edit', $contact) }}"
                                                class="btn btn-sm btn-outline-primary"
                                                title="Edit"
                                            ><i class="fas fa-edit"></i></a>

                                            <form
                                                action="{{ route('admin.company-contacts.toggle-publication', $contact) }}"
                                                method="POST"
                                            >
                                                @csrf
                                                @method('PATCH')
                                                <button
                                                    type="submit"
                                                    class="btn btn-sm {{ $contact->is_published ? 'btn-outline-warning' : 'btn-outline-success' }}"
                                                    title="{{ $contact->is_published ? 'Unpublish' : 'Publish' }}"
                                                >
                                                    <i class="fas {{ $contact->is_published ? 'fa-eye-slash' : 'fa-globe' }}"></i>
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
                    {{ $contacts->links() }}
                </div>
            @else
                <div class="text-center py-5 px-3">
                    <i class="fas fa-address-card fa-3x text-muted mb-3"></i>
                    <h5>No Contact Details Registered</h5>
                    <p class="text-muted">Add your company's contact information to get started.</p>
                    <a href="{{ route('company-contacts.create') }}" class="btn btn-primary">
                        Add Contact Details
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

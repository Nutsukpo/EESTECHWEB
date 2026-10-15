@extends('layouts.app')

@section('title', 'View Contact Enquiry')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="h3 mb-1">Enquiry Details</h1>
            <p class="text-muted mb-0">Submitted {{ $contactEnquiry->created_at?->format('d M Y, H:i') }}</p>
        </div>

        <a href="{{ route('admin.contact-enquiries.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Enquiries
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">{{ $contactEnquiry->subject ?: 'General Enquiry' }}</h5>
                </div>

                <div class="card-body p-4">
                    <div class="mb-4">
                        <small class="text-muted d-block mb-1">Message</small>
                        <div style="white-space:pre-wrap;overflow-wrap:anywhere;">{{ $contactEnquiry->message }}</div>
                    </div>

                    <hr>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <small class="text-muted d-block">Contact Person</small>
                            <strong>{{ $contactEnquiry->contact_name }}</strong>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block">Company</small>
                            <strong>{{ $contactEnquiry->company_name ?: 'Not provided' }}</strong>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block">Email</small>
                            <a href="mailto:{{ $contactEnquiry->email }}">{{ $contactEnquiry->email }}</a>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block">Phone</small>
                            @if($contactEnquiry->phone)
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $contactEnquiry->phone) }}">
                                    {{ $contactEnquiry->phone }}
                                </a>
                            @else
                                <strong>Not provided</strong>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <a href="mailto:{{ $contactEnquiry->email }}?subject={{ rawurlencode('Re: ' . ($contactEnquiry->subject ?: 'Your enquiry to EES Technologies')) }}"
                       class="btn btn-primary">
                        <i class="fas fa-reply me-2"></i>Reply by Email
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Manage Status</h5>
                </div>

                <div class="card-body">
                    <p class="text-muted small">Current status</p>

                    @php
                        $statusClass = match($contactEnquiry->status) {
                            'new' => 'danger',
                            'read' => 'info',
                            'resolved' => 'success',
                            default => 'secondary',
                        };
                    @endphp

                    <span class="badge bg-{{ $statusClass }} mb-3">
                        {{ ucfirst($contactEnquiry->status) }}
                    </span>

                    <form
                        action="{{ route('admin.contact-enquiries.status', $contactEnquiry) }}"
                        method="POST"
                    >
                        @csrf
                        @method('PATCH')

                        <label for="status" class="form-label">Change Status</label>
                        <select name="status" id="status" class="form-select mb-3" required>
                            <option value="new" @selected($contactEnquiry->status === 'new')>New</option>
                            <option value="read" @selected($contactEnquiry->status === 'read')>Read</option>
                            <option value="resolved" @selected($contactEnquiry->status === 'resolved')>Resolved</option>
                        </select>

                        <button type="submit" class="btn btn-primary w-100">
                            Update Status
                        </button>
                    </form>

                    <hr>

                    <form
                        action="{{ route('admin.contact-enquiries.destroy', $contactEnquiry) }}"
                        method="POST"
                        onsubmit="return confirm('Delete this enquiry permanently?');"
                    >
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="fas fa-trash me-2"></i>Delete Enquiry
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

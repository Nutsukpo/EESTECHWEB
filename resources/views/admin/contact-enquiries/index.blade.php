
@extends('layouts.app')

@section('title', 'Contact Enquiries')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="h3 mb-1">Contact Enquiries</h1>
            <p class="text-muted mb-0">Review and manage messages submitted through your website.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-3 mb-4">
        @foreach([
            'total' => ['Total Enquiries', 'primary', 'fa-inbox'],
            'new' => ['New', 'danger', 'fa-envelope'],
            'read' => ['Read', 'info', 'fa-envelope-open'],
            'resolved' => ['Resolved', 'success', 'fa-check-circle'],
        ] as $key => $card)
            <div class="col-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <div class="small text-muted">{{ $card[0] }}</div>
                            <div class="h3 mb-0">{{ $counts[$key] }}</div>
                        </div>
                        <div class="rounded-circle bg-{{ $card[1] }} bg-opacity-10 text-{{ $card[1] }} p-3">
                            <i class="fas {{ $card[2] }} fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">Enquiry Register</h5>
        </div>

        <div class="card-body border-bottom">
            <form method="GET" action="{{ route('admin.contact-enquiries.index') }}">
                <div class="row g-2">
                    <div class="col-md-7">
                        <input
                            type="search"
                            name="search"
                            class="form-control"
                            value="{{ $filters['search'] ?? '' }}"
                            placeholder="Search name, company, email, subject or message..."
                        >
                    </div>
                    <div class="col-md-3">
                        <select name="status" class="form-select">
                            <option value="">All statuses</option>
                            <option value="new" @selected(($filters['status'] ?? '') === 'new')>New</option>
                            <option value="read" @selected(($filters['status'] ?? '') === 'read')>Read</option>
                            <option value="resolved" @selected(($filters['status'] ?? '') === 'resolved')>Resolved</option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex gap-2">
                        <button class="btn btn-primary flex-grow-1" type="submit">
                            <i class="fas fa-search me-1"></i>Filter
                        </button>
                        <a href="{{ route('admin.contact-enquiries.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>

        @if($enquiries->count())
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">Contact</th>
                            <th>Subject / Message</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th class="text-end pe-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($enquiries as $enquiry)
                            <tr>
                                <td class="ps-3">
                                    <div class="fw-semibold">{{ $enquiry->contact_name }}</div>
                                    <div class="small text-muted">{{ $enquiry->email }}</div>
                                    @if($enquiry->company_name)
                                        <div class="small text-muted">{{ $enquiry->company_name }}</div>
                                    @endif
                                </td>
                                <td style="min-width:220px;max-width:360px;">
                                    <div class="fw-semibold">{{ $enquiry->subject ?: 'General enquiry' }}</div>
                                    <div class="small text-muted">
                                        {{ \Illuminate\Support\Str::limit($enquiry->message, 100) }}
                                    </div>
                                </td>
                                <td class="text-nowrap">
                                    {{ $enquiry->created_at?->format('d M Y') }}
                                    <div class="small text-muted">{{ $enquiry->created_at?->format('H:i') }}</div>
                                </td>
                                <td>
                                    @php
                                        $statusClass = match($enquiry->status) {
                                            'new' => 'danger',
                                            'read' => 'info',
                                            'resolved' => 'success',
                                            default => 'secondary',
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $statusClass }}">
                                        {{ ucfirst($enquiry->status) }}
                                    </span>
                                </td>
                                <td class="text-end pe-3">
                                    <div class="d-inline-flex gap-1">
                                        <a
                                            href="{{ route('admin.contact-enquiries.show', $enquiry) }}"
                                            class="btn btn-sm btn-outline-primary"
                                            title="View enquiry"
                                        ><i class="fas fa-eye"></i></a>

                                        <form
                                            action="{{ route('admin.contact-enquiries.destroy', $enquiry) }}"
                                            method="POST"
                                            onsubmit="return confirm('Delete this enquiry permanently?');"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete enquiry">
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
                {{ $enquiries->links() }}
            </div>
        @else
            <div class="text-center py-5 px-3">
                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                <h5>No enquiries found</h5>
                <p class="text-muted mb-0">New messages submitted through the public Contact Us form will appear here.</p>
            </div>
        @endif
    </div>
</div>
@endsection

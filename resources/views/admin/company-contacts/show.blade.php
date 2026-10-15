
@extends('layouts.app')

@section('title', 'Contact Details')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="h3 mb-1">{{ $companyContact->company_name }}</h1>
            <p class="text-muted mb-0">Company contact information overview.</p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('company-contacts.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back
            </a>
            <a href="{{ route('company-contacts.edit', $companyContact) }}" class="btn btn-primary">
                <i class="fas fa-edit me-1"></i> Edit
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Contact Information</h5>
                </div>

                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <small class="text-muted d-block">Primary Phone</small>
                            <strong>{{ $companyContact->primary_phone ?: 'Not provided' }}</strong>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block">Secondary Phone</small>
                            <strong>{{ $companyContact->secondary_phone ?: 'Not provided' }}</strong>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block">Primary Email</small>
                            <strong>{{ $companyContact->email ?: 'Not provided' }}</strong>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block">Secondary Email</small>
                            <strong>{{ $companyContact->secondary_email ?: 'Not provided' }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Office Location</h5>
                </div>

                <div class="card-body">
                    <p class="mb-1">{{ $companyContact->address ?: 'Address not provided' }}</p>
                    <p class="text-muted">
                        {{ collect([
                            $companyContact->city,
                            $companyContact->region,
                            $companyContact->country
                        ])->filter()->join(', ') }}
                    </p>

                    @if($companyContact->google_maps_url)
                        <a
                            href="{{ $companyContact->google_maps_url }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="btn btn-outline-primary btn-sm"
                        >
                            <i class="fas fa-map-marker-alt me-1"></i> Open Google Maps
                        </a>
                    @endif

                    @if($companyContact->google_maps_embed)
                        <div class="mt-3">
                            <small class="text-muted d-block mb-2">Map embed URL saved</small>
                            <code class="text-break">{{ $companyContact->google_maps_embed }}</code>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Social Media</h5>
                </div>

                <div class="card-body">
                    @php
                        $socialLinks = [
                            'LinkedIn' => $companyContact->linkedin_url,
                            'Facebook' => $companyContact->facebook_url,
                            'Instagram' => $companyContact->instagram_url,
                            'X (Twitter)' => $companyContact->x_url,
                        ];
                    @endphp

                    @forelse($socialLinks as $label => $url)
                        @if($url)
                            <div class="mb-2">
                                <span class="text-muted">{{ $label }}:</span>
                                <a href="{{ $url }}" target="_blank" rel="noopener noreferrer">
                                    {{ $url }}
                                </a>
                            </div>
                        @endif
                    @empty
                        <p class="text-muted mb-0">No social media links registered.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Working Hours</h5>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <small class="text-muted d-block">Monday – Friday</small>
                        <strong>{{ $companyContact->weekday_hours ?: 'Not specified' }}</strong>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted d-block">Saturday</small>
                        <strong>{{ $companyContact->saturday_hours ?: 'Not specified' }}</strong>
                    </div>
                    <div>
                        <small class="text-muted d-block">Sunday</small>
                        <strong>{{ $companyContact->sunday_hours ?: 'Not specified' }}</strong>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Publication Status</h5>
                </div>

                <div class="card-body">
                    @if($companyContact->is_published)
                        <span class="badge bg-success mb-3">Published</span>
                        <p class="small text-muted">This record is eligible to appear on the public website.</p>
                    @else
                        <span class="badge bg-secondary mb-3">Draft</span>
                        <p class="small text-muted">This record is hidden from the public website.</p>
                    @endif

                    <form
                        action="{{ route('admin.company-contacts.toggle-publication', $companyContact) }}"
                        method="POST"
                    >
                        @csrf
                        @method('PATCH')
                        <button
                            type="submit"
                            class="btn {{ $companyContact->is_published ? 'btn-outline-warning' : 'btn-outline-success' }} w-100"
                        >
                            {{ $companyContact->is_published ? 'Unpublish Details' : 'Publish Details' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

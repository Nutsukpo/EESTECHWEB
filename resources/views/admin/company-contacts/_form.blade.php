@php
    $contact = $contact ?? null;
@endphp

<div class="row g-4">
    <div class="col-lg-8">
        {{-- Company details --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Company Information</h5>
            </div>

            <div class="card-body">
                <div class="mb-3">
                    <label for="company_name" class="form-label">
                        Company Name <span class="text-danger">*</span>
                    </label>
                    <input
                        type="text"
                        id="company_name"
                        name="company_name"
                        class="form-control @error('company_name') is-invalid @enderror"
                        value="{{ old('company_name', $contact?->company_name ?? 'EES Technologies Ghana') }}"
                        maxlength="255"
                        required
                    >
                    @error('company_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="primary_phone" class="form-label">Primary Phone</label>
                        <input
                            type="text"
                            id="primary_phone"
                            name="primary_phone"
                            class="form-control @error('primary_phone') is-invalid @enderror"
                            value="{{ old('primary_phone', $contact?->primary_phone) }}"
                            placeholder="+233 ..."
                            maxlength="50"
                        >
                        @error('primary_phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="secondary_phone" class="form-label">Secondary Phone</label>
                        <input
                            type="text"
                            id="secondary_phone"
                            name="secondary_phone"
                            class="form-control @error('secondary_phone') is-invalid @enderror"
                            value="{{ old('secondary_phone', $contact?->secondary_phone) }}"
                            placeholder="+233 ..."
                            maxlength="50"
                        >
                        @error('secondary_phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Primary Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $contact?->email) }}"
                            placeholder="info@example.com"
                            maxlength="255"
                        >
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="secondary_email" class="form-label">Secondary Email</label>
                        <input
                            type="email"
                            id="secondary_email"
                            name="secondary_email"
                            class="form-control @error('secondary_email') is-invalid @enderror"
                            value="{{ old('secondary_email', $contact?->secondary_email) }}"
                            placeholder="support@example.com"
                            maxlength="255"
                        >
                        @error('secondary_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Office location --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Office Location</h5>
            </div>

            <div class="card-body">
                <div class="mb-3">
                    <label for="address" class="form-label">Street Address</label>
                    <textarea
                        id="address"
                        name="address"
                        rows="2"
                        class="form-control @error('address') is-invalid @enderror"
                        placeholder="Enter your office address"
                    >{{ old('address', $contact?->address) }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="city" class="form-label">City</label>
                        <input
                            type="text"
                            id="city"
                            name="city"
                            class="form-control @error('city') is-invalid @enderror"
                            value="{{ old('city', $contact?->city) }}"
                            maxlength="150"
                        >
                        @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="region" class="form-label">Region</label>
                        <input
                            type="text"
                            id="region"
                            name="region"
                            class="form-control @error('region') is-invalid @enderror"
                            value="{{ old('region', $contact?->region) }}"
                            maxlength="150"
                        >
                        @error('region')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="country" class="form-label">Country</label>
                        <input
                            type="text"
                            id="country"
                            name="country"
                            class="form-control @error('country') is-invalid @enderror"
                            value="{{ old('country', $contact?->country ?? 'Ghana') }}"
                            maxlength="150"
                        >
                        @error('country')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-3">
                    <label for="google_maps_url" class="form-label">Google Maps URL</label>
                    <input
                        type="url"
                        id="google_maps_url"
                        name="google_maps_url"
                        class="form-control @error('google_maps_url') is-invalid @enderror"
                        value="{{ old('google_maps_url', $contact?->google_maps_url) }}"
                        placeholder="https://maps.google.com/..."
                    >
                    <div class="form-text">
                        Paste the share link for your office location.
                    </div>
                    @error('google_maps_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-3">
                    <label for="google_maps_embed" class="form-label">
                        Google Maps Embed URL (optional)
                    </label>
                    <input
                        type="url"
                        id="google_maps_embed"
                        name="google_maps_embed"
                        class="form-control @error('google_maps_embed') is-invalid @enderror"
                        value="{{ old('google_maps_embed', $contact?->google_maps_embed) }}"
                        placeholder="https://www.google.com/maps/embed?pb=..."
                    >
                    <div class="form-text">
                        Enter the map's iframe <strong>src URL only</strong>, not the complete HTML iframe code.
                        It should begin with https://www.google.com/maps/embed.
                    </div>
                    @error('google_maps_embed')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Business hours --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Working Hours</h5>
            </div>

            <div class="card-body">
                <div class="mb-3">
                    <label for="weekday_hours" class="form-label">Monday – Friday</label>
                    <input
                        type="text"
                        id="weekday_hours"
                        name="weekday_hours"
                        class="form-control @error('weekday_hours') is-invalid @enderror"
                        value="{{ old('weekday_hours', $contact?->weekday_hours) }}"
                        placeholder="8:00 AM – 5:00 PM"
                        maxlength="255"
                    >
                    @error('weekday_hours')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="saturday_hours" class="form-label">Saturday</label>
                    <input
                        type="text"
                        id="saturday_hours"
                        name="saturday_hours"
                        class="form-control @error('saturday_hours') is-invalid @enderror"
                        value="{{ old('saturday_hours', $contact?->saturday_hours) }}"
                        placeholder="Closed"
                        maxlength="255"
                    >
                    @error('saturday_hours')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-0">
                    <label for="sunday_hours" class="form-label">Sunday</label>
                    <input
                        type="text"
                        id="sunday_hours"
                        name="sunday_hours"
                        class="form-control @error('sunday_hours') is-invalid @enderror"
                        value="{{ old('sunday_hours', $contact?->sunday_hours) }}"
                        placeholder="Closed"
                        maxlength="255"
                    >
                    @error('sunday_hours')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Social media --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Social Media Links</h5>
            </div>

            <div class="card-body">
                @foreach([
                    'linkedin_url' => 'LinkedIn URL',
                    'facebook_url' => 'Facebook URL',
                    'instagram_url' => 'Instagram URL',
                    'x_url' => 'X (Twitter) URL',
                ] as $field => $label)
                    <div class="mb-3">
                        <label for="{{ $field }}" class="form-label">{{ $label }}</label>
                        <input
                            type="url"
                            id="{{ $field }}"
                            name="{{ $field }}"
                            class="form-control @error($field) is-invalid @enderror"
                            value="{{ old($field, $contact?->{$field}) }}"
                            placeholder="https://..."
                        >
                        @error($field)
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Publication panel --}}
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Publication Settings</h5>
            </div>

            <div class="card-body">
                <p class="text-muted small">
                    Only published contact details will be displayed on the public website.
                </p>

                <input type="hidden" name="is_published" value="0">

                <div class="form-check form-switch mb-3">
                    <input
                        type="checkbox"
                        class="form-check-input"
                        id="is_published"
                        name="is_published"
                        value="1"
                        @checked((bool) old('is_published', $contact?->is_published ?? false))
                    >
                    <label class="form-check-label" for="is_published">
                        <strong>Publish Contact Details</strong>
                    </label>
                </div>

                <hr>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>
                        {{ $submitLabel ?? 'Save Contact Details' }}
                    </button>

                    <a href="{{ route('company-contacts.index') }}"
                       class="btn btn-outline-secondary">
                        Cancel
                    </a>
                </div>
            </div>
        </div>

        <div class="alert alert-info small">
            <i class="fas fa-info-circle me-1"></i>
            Use accurate contact details so clients can reach the company. Leave optional fields empty if they do not apply.
        </div>
    </div>
</div>

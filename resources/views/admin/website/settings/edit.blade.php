@extends('layouts.app')

@section('title', 'Website Settings')

@section('content')

<div class="container-fluid">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="h3 mb-1">
                <i class="fas fa-globe me-2"></i>
                Website Settings
            </h1>

            <p class="text-muted mb-0">
                Manage your EES-Tech website information.
            </p>
        </div>

    </div>


    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>
        </div>
    @endif


    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="alert alert-danger">

            <strong>
                Please correct the following errors:
            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>
    @endif


    <form
        method="POST"
        action="{{ route('admin.website.settings.update') }}"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')


        {{-- Company Information --}}
        <div class="card shadow-sm mb-4">

            <div class="card-header bg-white">

                <h5 class="mb-0">
                    <i class="fas fa-building me-2"></i>
                    Company Information
                </h5>

            </div>

            <div class="card-body">

                <div class="row g-3">

                    {{-- Company Name --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Company Name
                        </label>

                        <input
                            type="text"
                            name="company_name"
                            class="form-control"
                            value="{{ old('company_name', $settings->company_name) }}"
                            required>

                    </div>


                    {{-- Tagline --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Tagline
                        </label>

                        <input
                            type="text"
                            name="tagline"
                            class="form-control"
                            value="{{ old('tagline', $settings->tagline) }}">

                    </div>


                    {{-- Description --}}
                    <div class="col-12">

                        <label class="form-label">
                            Company Description
                        </label>

                        <textarea
                            name="description"
                            rows="4"
                            class="form-control">{{ old('description', $settings->description) }}</textarea>

                    </div>


                    {{-- Email --}}
                    <div class="col-md-4">

                        <label class="form-label">
                            Email Address
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email', $settings->email) }}">

                    </div>


                    {{-- Phone --}}
                    <div class="col-md-4">

                        <label class="form-label">
                            Phone
                        </label>

                        <input
                            type="text"
                            name="phone"
                            class="form-control"
                            value="{{ old('phone', $settings->phone) }}">

                    </div>


                    {{-- Address --}}
                    <div class="col-md-4">

                        <label class="form-label">
                            Address
                        </label>

                        <input
                            type="text"
                            name="address"
                            class="form-control"
                            value="{{ old('address', $settings->address) }}">

                    </div>

                </div>

            </div>

        </div>


        {{-- Branding --}}
        <div class="card shadow-sm mb-4">

            <div class="card-header bg-white">

                <h5 class="mb-0">
                    <i class="fas fa-image me-2"></i>
                    Branding
                </h5>

            </div>

            <div class="card-body">

                <div class="row g-4">

                    {{-- Logo --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Company Logo
                        </label>

                        <input
                            type="file"
                            name="logo"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp,.svg">

                        @if($settings->logo)

                            <div class="mt-3">

                                <p class="small text-muted mb-2">
                                    Current Logo
                                </p>

                                <img
                                    src="{{ asset('storage/' . $settings->logo) }}"
                                    alt="Company Logo"
                                    style="max-height:100px; max-width:250px;"
                                    class="img-thumbnail">

                            </div>

                        @endif

                    </div>


                    {{-- Favicon --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Favicon
                        </label>

                        <input
                            type="file"
                            name="favicon"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.ico,.webp">

                        @if($settings->favicon)

                            <div class="mt-3">

                                <p class="small text-muted mb-2">
                                    Current Favicon
                                </p>

                                <img
                                    src="{{ asset('storage/' . $settings->favicon) }}"
                                    alt="Favicon"
                                    style="width:64px;height:64px;"
                                    class="img-thumbnail">

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>


        {{-- Social Media --}}
        <div class="card shadow-sm mb-4">

            <div class="card-header bg-white">

                <h5 class="mb-0">
                    <i class="fas fa-share-alt me-2"></i>
                    Social Media
                </h5>

            </div>

            <div class="card-body">

                <div class="row g-3">

                    <div class="col-md-6">

                        <label class="form-label">
                            Facebook URL
                        </label>

                        <input
                            type="url"
                            name="facebook_url"
                            class="form-control"
                            value="{{ old('facebook_url', $settings->facebook_url) }}">

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Instagram URL
                        </label>

                        <input
                            type="url"
                            name="instagram_url"
                            class="form-control"
                            value="{{ old('instagram_url', $settings->instagram_url) }}">

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            LinkedIn URL
                        </label>

                        <input
                            type="url"
                            name="linkedin_url"
                            class="form-control"
                            value="{{ old('linkedin_url', $settings->linkedin_url) }}">

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            X / Twitter URL
                        </label>

                        <input
                            type="url"
                            name="twitter_url"
                            class="form-control"
                            value="{{ old('twitter_url', $settings->twitter_url) }}">

                    </div>

                </div>

            </div>

        </div>


        {{-- Website Status --}}
        <div class="card shadow-sm mb-4">

            <div class="card-header bg-white">

                <h5 class="mb-0">
                    <i class="fas fa-power-off me-2"></i>
                    Website Status
                </h5>

            </div>

            <div class="card-body">

                <label class="form-label">
                    Status
                </label>

                <select
                    name="status"
                    class="form-select">

                    <option
                        value="active"
                        @selected(old('status', $settings->status) === 'active')>
                        Active
                    </option>

                    <option
                        value="inactive"
                        @selected(old('status', $settings->status) === 'inactive')>
                        Inactive
                    </option>

                </select>

            </div>

        </div>


        {{-- Actions --}}
        <div class="d-flex justify-content-end gap-2">

            <button
                type="submit"
                class="btn btn-primary">

                <i class="fas fa-save me-1"></i>
                Save Settings

            </button>

        </div>

    </form>

</div>

@endsection
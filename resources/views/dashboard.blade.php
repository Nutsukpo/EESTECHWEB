@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold mb-1">
                Dashboard
            </h3>

            <p class="text-muted mb-0">
                Welcome back, {{ auth()->user()->name }}
            </p>
        </div>

        <div>
            <span class="badge bg-dark">
                {{ auth()->user()->getRoleNames()->first() }}
            </span>
        </div>

    </div>

    <div class="row g-4">

        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="text-muted mb-2">
                        Total Users
                    </div>

                    <h2 class="fw-bold">
                        {{ $stats['users'] }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="text-muted mb-2">
                        Active Users
                    </div>

                    <h2 class="fw-bold">
                        {{ $stats['active_users'] }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="text-muted mb-2">
                        Inactive Users
                    </div>

                    <h2 class="fw-bold">
                        {{ $stats['inactive_users'] }}
                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-6 col-xl-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="text-muted mb-2">
                        Departments
                    </div>

                    <h2 class="fw-bold">
                        {{ $stats['departments'] }}
                    </h2>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
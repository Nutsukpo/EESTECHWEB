@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid pb-4">

    {{-- Dashboard heading --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold mb-1">Dashboard</h3>
            <p class="text-muted mb-0">
                Welcome back, {{ auth()->user()->name }}
            </p>
        </div>

        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-dark">
                {{ auth()->user()->getRoleNames()->first() ?? 'User' }}
            </span>

            <a href="{{ route('admin.analytics.index') }}"
               class="btn btn-outline-primary btn-sm">
                <i class="fa-solid fa-chart-line me-1"></i>
                Detailed Analytics
            </a>
        </div>
    </div>

    {{-- Existing system statistics --}}
    <h5 class="fw-bold mb-3">System Overview</h5>

    <div class="row g-4 mb-5">

        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted mb-2">Total Users</div>
                    <h2 class="fw-bold mb-0">
                        {{ number_format($stats['users']) }}
                    </h2>
                    <small class="text-muted">Registered system users</small>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted mb-2">Active Users</div>
                    <h2 class="fw-bold mb-0">
                        {{ number_format($stats['active_users']) }}
                    </h2>
                    <small class="text-success">Currently active accounts</small>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted mb-2">Inactive Users</div>
                    <h2 class="fw-bold mb-0">
                        {{ number_format($stats['inactive_users']) }}
                    </h2>
                    <small class="text-muted">Inactive accounts</small>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted mb-2">Departments</div>
                    <h2 class="fw-bold mb-0">
                        {{ number_format($stats['departments']) }}
                    </h2>
                    <small class="text-muted">Configured departments</small>
                </div>
            </div>
        </div>

    </div>

    {{-- Website analytics --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <div>
            <h5 class="fw-bold mb-1">Website Analytics</h5>
            <p class="text-muted small mb-0">
                Website performance over the last 30 days
            </p>
        </div>

        <span class="badge rounded-pill text-bg-light border">
            <i class="fa-regular fa-calendar me-1"></i>
            {{ now()->subDays(29)->format('d M') }} – {{ now()->format('d M Y') }}
        </span>
    </div>

    {{-- Website traffic cards --}}
    <div class="row g-4 mb-4">

        <div class="col-sm-6 col-xl-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Page Views</span>
                        <span class="rounded-3 bg-primary bg-opacity-10 text-primary p-3">
                            <i class="fa-solid fa-eye fa-lg"></i>
                        </span>
                    </div>

                    <h2 class="fw-bold mt-3 mb-1">
                        {{ number_format($websiteStats['page_views']) }}
                    </h2>
                    <small class="text-muted">Recorded page visits</small>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Unique Visitors</span>
                        <span class="rounded-3 bg-success bg-opacity-10 text-success p-3">
                            <i class="fa-solid fa-users fa-lg"></i>
                        </span>
                    </div>

                    <h2 class="fw-bold mt-3 mb-1">
                        {{ number_format($websiteStats['unique_visitors']) }}
                    </h2>
                    <small class="text-muted">Distinct anonymous visitor IDs</small>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Sessions</span>
                        <span class="rounded-3 bg-warning bg-opacity-10 text-warning p-3">
                            <i class="fa-solid fa-clock fa-lg"></i>
                        </span>
                    </div>

                    <h2 class="fw-bold mt-3 mb-1">
                        {{ number_format($websiteStats['sessions']) }}
                    </h2>
                    <small class="text-muted">Distinct recorded session IDs</small>
                </div>
            </div>
        </div>

    </div>

    {{-- Traffic chart and popular pages --}}
    <div class="row g-4">

        <div class="col-xl-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="mb-3">
                        <h5 class="fw-bold mb-1">Website Traffic</h5>
                        <p class="text-muted small mb-0">
                            Daily page views over the last 30 days
                        </p>
                    </div>

                    <div style="height:300px; position:relative;">
                        <canvas id="dashboardTrafficChart"
                                role="img"
                                aria-label="Daily website page views"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="fw-bold mb-1">Popular Pages</h5>
                    <p class="text-muted small mb-3">
                        Top five pages by recorded views
                    </p>

                    @forelse($popularPages as $page)
                        <div class="d-flex justify-content-between align-items-start gap-3 py-3 border-bottom">
                            <div class="text-break small">
                                {{ $page->path }}
                            </div>
                            <span class="badge text-bg-light border">
                                {{ number_format($page->total_views) }}
                            </span>
                        </div>
                    @empty
                        <p class="text-muted py-4 mb-0">
                            No page views recorded yet.
                        </p>
                    @endforelse

                    <a href="{{ route('admin.analytics.index') }}"
                       class="btn btn-outline-primary btn-sm mt-3 w-100">
                        View Full Analytics
                    </a>
                </div>
            </div>
        </div>

    </div>

    {{-- Traffic sources --}}
    <div class="row g-4 mt-1">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-1">Traffic Sources</h5>
                    <p class="text-muted small mb-3">
                        Recorded sources associated with page views
                    </p>

                    <div class="row g-3">
                        @forelse($trafficSources as $source)
                            <div class="col-sm-6 col-lg-3">
                                <div class="border rounded-3 p-3 h-100">
                                    <div class="text-muted small text-capitalize">
                                        {{ $source->traffic_source }}
                                    </div>
                                    <h4 class="fw-bold mt-2 mb-0">
                                        {{ number_format($source->total) }}
                                    </h4>
                                    <small class="text-muted">Page views</small>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-muted mb-0">
                                    No traffic source data recorded yet.
                                </p>
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>

    <p class="text-muted small mt-4 mb-0">
        Analytics only includes visits recorded since tracking was installed.
        Visitor counts are approximate and depend on browser cookies.
    </p>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('dashboardTrafficChart');

    if (!canvas || typeof Chart === 'undefined') {
        return;
    }

    new Chart(canvas, {
        type: 'line',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                label: 'Page views',
                data: @json($chartValues),
                borderColor: '#0878d1',
                backgroundColor: 'rgba(8, 120, 209, 0.12)',
                fill: true,
                tension: 0.3,
                pointRadius: 2,
                pointHoverRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                intersect: false,
                mode: 'index'
            },
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
});
</script>
@endpush

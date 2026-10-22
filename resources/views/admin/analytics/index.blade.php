@extends('layouts.app')

@section('title', 'Website Analytics')

@section('content')
<div class="container-fluid pb-5">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold mb-1">Website Analytics</h3>
            <p class="text-muted mb-0">
                Understand traffic and engagement across the EES-Tech website.
            </p>
        </div>

        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">
            <i class="fa-solid fa-arrow-left me-2"></i>Back to Dashboard
        </a>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.analytics.index') }}"
                  class="row g-3 align-items-end">

                <div class="col-md-3">
                    <label for="period" class="form-label fw-semibold">Reporting period</label>
                    <select name="period" id="period" class="form-select">
                        <option value="today" @selected($period === 'today')>Today</option>
                        <option value="7" @selected($period === '7')>Last 7 days</option>
                        <option value="30" @selected($period === '30')>Last 30 days</option>
                        <option value="90" @selected($period === '90')>Last 90 days</option>
                        <option value="custom" @selected($period === 'custom')>Custom range</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="start_date" class="form-label fw-semibold">Start date</label>
                    <input type="date" name="start_date" id="start_date"
                           class="form-control"
                           value="{{ request('start_date', $startDate->toDateString()) }}">
                </div>

                <div class="col-md-3">
                    <label for="end_date" class="form-label fw-semibold">End date</label>
                    <input type="date" name="end_date" id="end_date"
                           class="form-control"
                           value="{{ request('end_date', $endDate->toDateString()) }}">
                </div>

                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fa-solid fa-filter me-2"></i>Apply filters
                    </button>
                </div>
            </form>

            <small class="text-muted d-block mt-3">
                Showing {{ $startDate->format('d M Y') }}
                to {{ $endDate->format('d M Y') }}.
                Data is available from the date tracking was installed.
            </small>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Page views</span>
                        <i class="fa-solid fa-eye text-primary fs-4"></i>
                    </div>
                    <h2 class="fw-bold mt-3 mb-1">{{ number_format($pageViews) }}</h2>
                    <small class="text-muted">Recorded page visits</small>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Unique visitors</span>
                        <i class="fa-solid fa-users text-primary fs-4"></i>
                    </div>
                    <h2 class="fw-bold mt-3 mb-1">{{ number_format($uniqueVisitors) }}</h2>
                    <small class="text-muted">Distinct anonymous visitor IDs</small>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Sessions</span>
                        <i class="fa-solid fa-clock text-primary fs-4"></i>
                    </div>
                    <h2 class="fw-bold mt-3 mb-1">{{ number_format($sessions) }}</h2>
                    <small class="text-muted">Distinct session IDs with recorded views</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-xl-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="fw-bold mb-1">Traffic over time</h5>
                    <p class="text-muted small mb-4">Daily recorded page views</p>
                    <div style="height:320px; position:relative;">
                        <canvas id="trafficChart"
                                role="img"
                                aria-label="Daily page views chart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="fw-bold mb-1">Traffic sources</h5>
                    <p class="text-muted small mb-4">Where visits originated</p>

                    @if($trafficSources->isEmpty())
                        <p class="text-muted py-4">No traffic data for this period.</p>
                    @else
                        <div style="height:260px; position:relative;">
                            <canvas id="sourcesChart"
                                    role="img"
                                    aria-label="Traffic sources chart"></canvas>
                        </div>

                        <div class="mt-3">
                            @foreach($trafficSources as $source)
                                <div class="d-flex justify-content-between border-bottom py-2">
                                    <span class="text-capitalize">
                                        {{ $source->traffic_source }}
                                    </span>
                                    <strong>{{ number_format($source->total) }}</strong>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-xl-7">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="fw-bold mb-1">Popular pages</h5>
                    <p class="text-muted small mb-3">Most visited paths in this period</p>

                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Page path</th>
                                    <th class="text-end">Views</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($popularPages as $page)
                                    <tr>
                                        <td class="text-break">{{ $page->path }}</td>
                                        <td class="text-end fw-semibold">
                                            {{ number_format($page->total_views) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center text-muted py-4">
                                            No page views recorded for this period.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-5">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="fw-bold mb-1">Devices</h5>
                    <p class="text-muted small mb-3">Device categories detected from browsers</p>

                    @forelse($devices as $device)
                        @php
                            $deviceTotal = $devices->sum('total');
                            $percentage = $deviceTotal > 0
                                ? round(($device->total / $deviceTotal) * 100)
                                : 0;
                        @endphp

                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-capitalize">{{ $device->device_type }}</span>
                                <span class="fw-semibold">
                                    {{ number_format($device->total) }} ({{ $percentage }}%)
                                </span>
                            </div>
                            <div class="progress" style="height:8px;">
                                <div class="progress-bar"
                                     role="progressbar"
                                     style="width: {{ $percentage }}%;"
                                     aria-valuenow="{{ $percentage }}"
                                     aria-valuemin="0"
                                     aria-valuemax="100"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted py-4">No device data for this period.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const trafficCanvas = document.getElementById('trafficChart');

    if (trafficCanvas) {
        new Chart(trafficCanvas, {
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
                    pointRadius: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index'
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
    }

    const sourcesCanvas = document.getElementById('sourcesChart');

    if (sourcesCanvas) {
        new Chart(sourcesCanvas, {
            type: 'doughnut',
            data: {
                labels: @json($trafficSources->pluck('traffic_source')->values()),
                datasets: [{
                    data: @json($trafficSources->pluck('total')->values()),
                    backgroundColor: [
                        '#0878d1',
                        '#061b3d',
                        '#e9b13a',
                        '#16a34a',
                        '#9333ea',
                        '#64748b'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }
});
</script>
@endpush

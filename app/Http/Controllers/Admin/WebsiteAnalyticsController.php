<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsitePageView;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebsiteAnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'period' => ['nullable', 'in:today,7,30,90,custom'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
        ]);

        $period = $validated['period'] ?? '30';
        $endDate = Carbon::today()->endOfDay();

        if ($period === 'custom') {
            $startDate = isset($validated['start_date'])
                ? Carbon::parse($validated['start_date'])->startOfDay()
                : Carbon::today()->subDays(29)->startOfDay();

            $endDate = isset($validated['end_date'])
                ? Carbon::parse($validated['end_date'])->endOfDay()
                : Carbon::today()->endOfDay();
        } else {
            $startDate = match ($period) {
                'today' => Carbon::today()->startOfDay(),
                '7' => Carbon::today()->subDays(6)->startOfDay(),
                '90' => Carbon::today()->subDays(89)->startOfDay(),
                default => Carbon::today()->subDays(29)->startOfDay(),
            };
        }

        $baseQuery = WebsitePageView::query()
            ->whereBetween('viewed_at', [$startDate, $endDate]);

        $pageViews = (clone $baseQuery)->count();

        $uniqueVisitors = (clone $baseQuery)
            ->distinct('visitor_id')
            ->count('visitor_id');

        $sessions = (clone $baseQuery)
            ->whereNotNull('session_id')
            ->distinct('session_id')
            ->count('session_id');

        $dailyRows = (clone $baseQuery)
            ->selectRaw('DATE(viewed_at) as visit_date, COUNT(*) as total')
            ->groupBy('visit_date')
            ->orderBy('visit_date')
            ->get()
            ->keyBy('visit_date');

        $chartLabels = [];
        $chartValues = [];

        $cursor = $startDate->copy()->startOfDay();
        $lastDay = $endDate->copy()->startOfDay();

        while ($cursor->lte($lastDay)) {
            $dateKey = $cursor->toDateString();

            $chartLabels[] = $cursor->format('M j');
            $chartValues[] = (int) ($dailyRows[$dateKey]->total ?? 0);

            $cursor->addDay();
        }

        $popularPages = (clone $baseQuery)
            ->select('path', DB::raw('COUNT(*) as total_views'))
            ->groupBy('path')
            ->orderByDesc('total_views')
            ->limit(10)
            ->get();

        $trafficSources = (clone $baseQuery)
            ->select('traffic_source', DB::raw('COUNT(*) as total'))
            ->groupBy('traffic_source')
            ->orderByDesc('total')
            ->get();

        $devices = (clone $baseQuery)
            ->select('device_type', DB::raw('COUNT(*) as total'))
            ->groupBy('device_type')
            ->orderByDesc('total')
            ->get();

        return view('admin.analytics.index', [
            'period' => $period,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'pageViews' => $pageViews,
            'uniqueVisitors' => $uniqueVisitors,
            'sessions' => $sessions,
            'chartLabels' => $chartLabels,
            'chartValues' => $chartValues,
            'popularPages' => $popularPages,
            'trafficSources' => $trafficSources,
            'devices' => $devices,
        ]);
    }
}

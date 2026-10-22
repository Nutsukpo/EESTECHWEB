<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use App\Models\WebsitePageView;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Existing system statistics — preserved.
        $stats = [
            'users' => User::count(),
            'active_users' => User::where('status', 'active')->count(),
            'inactive_users' => User::where('status', 'inactive')->count(),
            'departments' => Department::count(),
        ];

        // Website analytics for the last 30 days.
        $startDate = Carbon::today()->subDays(29)->startOfDay();
        $endDate = Carbon::today()->endOfDay();

        $analyticsQuery = WebsitePageView::query()
            ->whereBetween('viewed_at', [$startDate, $endDate]);

        $websiteStats = [
            'page_views' => (clone $analyticsQuery)->count(),

            'unique_visitors' => (clone $analyticsQuery)
                ->distinct('visitor_id')
                ->count('visitor_id'),

            'sessions' => (clone $analyticsQuery)
                ->whereNotNull('session_id')
                ->distinct('session_id')
                ->count('session_id'),
        ];

        // Daily page views for the chart.
        $dailyRows = (clone $analyticsQuery)
            ->selectRaw('DATE(viewed_at) as visit_date, COUNT(*) as total')
            ->groupBy('visit_date')
            ->orderBy('visit_date')
            ->get()
            ->keyBy('visit_date');

        $chartLabels = [];
        $chartValues = [];

        $date = $startDate->copy();

        while ($date->lte($endDate)) {
            $dateKey = $date->toDateString();

            $chartLabels[] = $date->format('M j');
            $chartValues[] = (int) ($dailyRows[$dateKey]->total ?? 0);

            $date->addDay();
        }

        // Most visited pages.
        $popularPages = (clone $analyticsQuery)
            ->select('path', DB::raw('COUNT(*) as total_views'))
            ->groupBy('path')
            ->orderByDesc('total_views')
            ->limit(5)
            ->get();

        // Referrer classification for recorded page views.
        $trafficSources = (clone $analyticsQuery)
            ->select('traffic_source', DB::raw('COUNT(*) as total'))
            ->groupBy('traffic_source')
            ->orderByDesc('total')
            ->get();

        return view('dashboard', compact(
            'stats',
            'websiteStats',
            'chartLabels',
            'chartValues',
            'popularPages',
            'trafficSources'
        ));
    }
}

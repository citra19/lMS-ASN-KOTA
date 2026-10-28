<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard overview
     */
    public function index()
    {
        $stats = [
            'total_activities' => Activity::count(),
            'published_count' => Activity::where('is_published', true)->count(),
            'draft_count' => Activity::where('is_published', false)->count(),
            'ongoing_count' => Activity::where('status', 'ongoing')->count(),
            'upcoming_count' => Activity::where('status', 'upcoming')->count(),
            'completed_count' => Activity::where('status', 'completed')->count(),
            'total_views' => Activity::sum('views_count'),
        ];

        $recentActivities = Activity::orderBy('created_at', 'desc')->take(6)->get();
        $upcomingActivities = Activity::where('status', 'upcoming')->orderBy('date', 'asc')->take(4)->get();

        return view('admin.dashboard', compact('stats', 'recentActivities', 'upcomingActivities'));
    }
}

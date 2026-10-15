<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'active_users' => User::where('status', 'active')->count(),
            'inactive_users' => User::where('status', 'inactive')->count(),
            'departments' => Department::count(),
        ];

        return view('dashboard', compact('stats'));
    }
}
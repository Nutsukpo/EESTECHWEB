<?php

namespace App\Http\Controllers;

use App\Models\AboutPage;
use App\Models\TeamMember;

class AboutController extends Controller
{
    public function index()
    {
        $about = AboutPage::where('is_active', true)->first();

        $teamMembers = TeamMember::where('is_active', true)
            ->orderBy('display_order')
            ->orderBy('name')
            ->get();

        return view('public.about', compact(
            'about',
            'teamMembers'
        ));
    }
}
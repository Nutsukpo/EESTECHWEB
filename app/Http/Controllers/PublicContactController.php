<?php

namespace App\Http\Controllers;

use App\Models\CompanyContact;
use Illuminate\View\View;

class PublicContactController extends Controller
{
    /**
     * Display the public contact page.
     */
    public function index(): View
    {
        $contact = CompanyContact::published()
            ->latest()
            ->first();

        return view('public.contact', compact('contact'));
    }
}

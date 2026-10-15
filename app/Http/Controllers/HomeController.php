<?php

namespace App\Http\Controllers;

use App\Models\HeroSlide;
use App\Models\WebsiteSetting;

class HomeController extends Controller
{
    /**
     * Display the public EES-Tech website.
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Website Settings
        |--------------------------------------------------------------------------
        */

        $settings = WebsiteSetting::first();

        /*
        |--------------------------------------------------------------------------
        | Company Information
        |--------------------------------------------------------------------------
        */

        $companyName = $settings?->company_name
            ?? 'EES Technologies Ghana';

        $tagline = $settings?->tagline
            ?? 'INNOVATE • INTEGRATE • ELEVATE';

        $companyDescription = $settings?->description
            ?? 'EES Technologies Ghana provides innovative and reliable technology solutions that help organisations improve efficiency, strengthen security and accelerate digital transformation.';

        $email = $settings?->email
            ?? 'info@eestechnologies.com';

        $phone = $settings?->phone
            ?? '+233 542 013 350';

        $address = $settings?->address
            ?? 'Ghana';

        /*
        |--------------------------------------------------------------------------
        | Social Media
        |--------------------------------------------------------------------------
        */

        $socialLinks = [
            'linkedin' => $settings?->linkedin_url,
            'facebook' => $settings?->facebook_url,
            'instagram' => $settings?->instagram_url,
            'twitter' => $settings?->twitter_url,
        ];

        /*
        |--------------------------------------------------------------------------
        | Website Logo
        |--------------------------------------------------------------------------
        |
        | If a logo has been uploaded through WebsiteSetting, use it.
        | Otherwise fall back to public/img/logo.png.
        |
        */

        $logo = $settings?->logo;

        $logoUrl = $logo
            ? asset('storage/' . $logo)
            : asset('img/logo.png');

        /*
        |--------------------------------------------------------------------------
        | Website Favicon
        |--------------------------------------------------------------------------
        |
        | If a favicon has been uploaded, use it.
        | Otherwise fall back to public/favicon.ico.
        |
        */

        $favicon = $settings?->favicon;

        $faviconUrl = $favicon
            ? asset('storage/' . $favicon)
            : asset('favicon.ico');

        /*
        |--------------------------------------------------------------------------
        | Hero Slides
        |--------------------------------------------------------------------------
        */

        $heroSlides = HeroSlide::where('is_active', true)
            ->orderBy('display_order')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Public Website
        |--------------------------------------------------------------------------
        */

        return view('home', [
            'settings' => $settings,

            'companyName' => $companyName,
            'tagline' => $tagline,
            'companyDescription' => $companyDescription,

            'email' => $email,
            'phone' => $phone,
            'address' => $address,

            'socialLinks' => $socialLinks,

            'logoUrl' => $logoUrl,
            'faviconUrl' => $faviconUrl,

            'heroSlides' => $heroSlides,
        ]);
    }
}
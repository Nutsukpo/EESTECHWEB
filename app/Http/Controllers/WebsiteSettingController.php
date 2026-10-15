<?php

namespace App\Http\Controllers;

use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebsiteSettingController extends Controller
{
    public function edit()
    {
        $settings = WebsiteSetting::first();

        if (!$settings) {
            $settings = WebsiteSetting::create([
                'company_name' => 'EES Technologies Ghana',
                'tagline' => 'INNOVATE • INTEGRATE • ELEVATE',
                'email' => 'info@eestechnologies.com',
                'phone' => '+233 542 013 350',
                'address' => 'Ghana',
                'status' => 'active',
            ]);
        }

        return view('admin.website.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'company_name' => [
                'required',
                'string',
                'max:255',
            ],

            'tagline' => [
                'nullable',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:50',
            ],

            'address' => [
                'nullable',
                'string',
                'max:255',
            ],

            'logo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp,svg',
                'max:2048',
            ],

            'favicon' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,ico,webp',
                'max:1024',
            ],

            'facebook_url' => [
                'nullable',
                'url',
                'max:255',
            ],

            'instagram_url' => [
                'nullable',
                'url',
                'max:255',
            ],

            'linkedin_url' => [
                'nullable',
                'url',
                'max:255',
            ],

            'twitter_url' => [
                'nullable',
                'url',
                'max:255',
            ],

            'status' => [
                'required',
                'in:active,inactive',
            ],
        ]);

        $settings = WebsiteSetting::first();

        if (!$settings) {
            $settings = new WebsiteSetting();
        }

        /*
        |--------------------------------------------------------------------------
        | Logo
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('logo')) {

            if (
                $settings->logo &&
                Storage::disk('public')->exists($settings->logo)
            ) {
                Storage::disk('public')->delete($settings->logo);
            }

            $validated['logo'] = $request
                ->file('logo')
                ->store('website', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Favicon
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('favicon')) {

            if (
                $settings->favicon &&
                Storage::disk('public')->exists($settings->favicon)
            ) {
                Storage::disk('public')->delete($settings->favicon);
            }

            $validated['favicon'] = $request
                ->file('favicon')
                ->store('website', 'public');
        }

        $settings->fill($validated);
        $settings->save();

        return back()->with(
            'success',
            'Website settings updated successfully.'
        );
    }
}
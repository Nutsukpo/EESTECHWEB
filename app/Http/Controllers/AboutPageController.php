<?php

namespace App\Http\Controllers;

use App\Models\AboutPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutPageController extends Controller
{
    /**
     * Display the About Us settings.
     */
    public function edit()
    {
        $about = AboutPage::first();

        /*
        |--------------------------------------------------------------------------
        | Create a default record if none exists
        |--------------------------------------------------------------------------
        */

        if (!$about) {
            $about = AboutPage::create([
                'title' => 'Pioneering the next wave of digital innovation.',
                'subtitle' => 'ABOUT EES TECHNOLOGIES GHANA',

                'description' =>
                    'EES Technologies Ghana is a technology company focused on delivering reliable, secure and practical digital solutions that help organisations improve efficiency, strengthen operations and embrace digital transformation.',

                'description_two' =>
                    'Our services span software development, cloud solutions, IT security, IT consulting, infrastructure and other technology solutions designed around the needs of our clients.',

                'mission_title' => 'Our Mission',

                'mission' =>
                    'To deliver reliable, innovative and secure technology solutions that empower organisations through practical digital systems, intelligent infrastructure and modern cybersecurity practices.',

                'vision_title' => 'Our Vision',

                'vision' =>
                    'To become a trusted technology solutions provider in Africa, recognised for innovation, reliability, security and meaningful digital transformation.',

                'is_active' => true,
            ]);
        }

        return view(
            'admin.website.about.edit',
            compact('about')
        );
    }


    /**
     * Update the About Us page.
     */
    public function update(Request $request)
    {
        $about = AboutPage::first();

        if (!$about) {
            $about = new AboutPage();
        }

        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'subtitle' => [
                'nullable',
                'string',
                'max:255',
            ],

            'description' => [
                'required',
                'string',
            ],

            'description_two' => [
                'nullable',
                'string',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'mission_title' => [
                'required',
                'string',
                'max:255',
            ],

            'mission' => [
                'required',
                'string',
            ],

            'vision_title' => [
                'required',
                'string',
                'max:255',
            ],

            'vision' => [
                'required',
                'string',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Handle About Image
        |--------------------------------------------------------------------------
        */

        $imagePath = $about->image;

        if ($request->hasFile('image')) {

            if (
                $about->image &&
                Storage::disk('public')->exists($about->image)
            ) {
                Storage::disk('public')->delete(
                    $about->image
                );
            }

            $imagePath = $request
                ->file('image')
                ->store('about', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Update About Page
        |--------------------------------------------------------------------------
        */

        $about->fill([
            'title' => $validated['title'],

            'subtitle' =>
                $validated['subtitle'] ?? null,

            'description' =>
                $validated['description'],

            'description_two' =>
                $validated['description_two'] ?? null,

            'image' =>
                $imagePath,

            'mission_title' =>
                $validated['mission_title'],

            'mission' =>
                $validated['mission'],

            'vision_title' =>
                $validated['vision_title'],

            'vision' =>
                $validated['vision'],

            'is_active' =>
                $request->boolean('is_active'),
        ]);

        $about->save();


        return redirect()
            ->route('admin.about.edit')
            ->with(
                'success',
                'About Us content updated successfully.'
            );
    }
}
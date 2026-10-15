<?php

namespace App\Http\Controllers;

use App\Models\HeroSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class HeroSlideController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Index
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $slides = HeroSlide::orderBy('display_order')
            ->latest()
            ->get();

        return view(
            'admin.website.hero.index',
            compact('slides')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Create
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view(
            'admin.website.hero.create'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([

            'badge' => [
                'nullable',
                'string',
                'max:255',
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'highlight' => [
                'nullable',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'primary_button_text' => [
                'nullable',
                'string',
                'max:100',
            ],

            'primary_button_url' => [
                'nullable',
                'string',
                'max:500',
            ],

            'secondary_button_text' => [
                'nullable',
                'string',
                'max:100',
            ],

            'secondary_button_url' => [
                'nullable',
                'string',
                'max:500',
            ],

            'display_order' => [
                'required',
                'integer',
                'min:0',
            ],

            'duration' => [
                'required',
                'integer',
                'min:1000',
                'max:30000',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Upload Image
        |--------------------------------------------------------------------------
        */

        $imagePath = $request
            ->file('image')
            ->store('hero-slides', 'public');


        /*
        |--------------------------------------------------------------------------
        | Create Slide
        |--------------------------------------------------------------------------
        */

        HeroSlide::create([

            'badge' => $validated['badge'] ?? null,

            'title' => $validated['title'],

            'highlight' => $validated['highlight'] ?? null,

            'description' => $validated['description'] ?? null,

            'image' => $imagePath,

            'primary_button_text' =>
                $validated['primary_button_text'] ?? null,

            'primary_button_url' =>
                $validated['primary_button_url'] ?? null,

            'secondary_button_text' =>
                $validated['secondary_button_text'] ?? null,

            'secondary_button_url' =>
                $validated['secondary_button_url'] ?? null,

            'display_order' =>
                $validated['display_order'],

            'duration' =>
                $validated['duration'],

            'is_active' =>
                $request->boolean('is_active'),

        ]);


        return redirect()
            ->route('admin.hero-slides.index')
            ->with(
                'success',
                'Hero slide created successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Edit
    |--------------------------------------------------------------------------
    */

    public function edit(HeroSlide $heroSlide)
    {
        return view(
            'admin.website.hero.edit',
            compact('heroSlide')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        HeroSlide $heroSlide
    ) {

        $validated = $request->validate([

            'badge' => [
                'nullable',
                'string',
                'max:255',
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'highlight' => [
                'nullable',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'primary_button_text' => [
                'nullable',
                'string',
                'max:100',
            ],

            'primary_button_url' => [
                'nullable',
                'string',
                'max:500',
            ],

            'secondary_button_text' => [
                'nullable',
                'string',
                'max:100',
            ],

            'secondary_button_url' => [
                'nullable',
                'string',
                'max:500',
            ],

            'display_order' => [
                'required',
                'integer',
                'min:0',
            ],

            'duration' => [
                'required',
                'integer',
                'min:1000',
                'max:30000',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

        ]);


        $imagePath = $heroSlide->image;


        /*
        |--------------------------------------------------------------------------
        | Replace Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            if (
                $heroSlide->image &&
                Storage::disk('public')
                    ->exists($heroSlide->image)
            ) {

                Storage::disk('public')
                    ->delete($heroSlide->image);
            }


            $imagePath = $request
                ->file('image')
                ->store('hero-slides', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Update
        |--------------------------------------------------------------------------
        */

        $heroSlide->update([

            'badge' =>
                $validated['badge'] ?? null,

            'title' =>
                $validated['title'],

            'highlight' =>
                $validated['highlight'] ?? null,

            'description' =>
                $validated['description'] ?? null,

            'image' =>
                $imagePath,

            'primary_button_text' =>
                $validated['primary_button_text'] ?? null,

            'primary_button_url' =>
                $validated['primary_button_url'] ?? null,

            'secondary_button_text' =>
                $validated['secondary_button_text'] ?? null,

            'secondary_button_url' =>
                $validated['secondary_button_url'] ?? null,

            'display_order' =>
                $validated['display_order'],

            'duration' =>
                $validated['duration'],

            'is_active' =>
                $request->boolean('is_active'),

        ]);


        return redirect()
            ->route('admin.hero-slides.index')
            ->with(
                'success',
                'Hero slide updated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Toggle Status
    |--------------------------------------------------------------------------
    */

    public function toggleStatus(
        HeroSlide $heroSlide
    ) {

        $heroSlide->update([

            'is_active' =>
                !$heroSlide->is_active,

        ]);


        return back()->with(
            'success',
            'Hero slide status updated successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */

    public function destroy(
        HeroSlide $heroSlide
    ) {

        if (
            $heroSlide->image &&
            Storage::disk('public')
                ->exists($heroSlide->image)
        ) {

            Storage::disk('public')
                ->delete($heroSlide->image);
        }


        $heroSlide->delete();


        return back()->with(
            'success',
            'Hero slide deleted successfully.'
        );
    }
}
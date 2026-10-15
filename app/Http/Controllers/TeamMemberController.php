<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class TeamMemberController extends Controller
{
    /**
     * Display team members.
     */
    public function index()
    {
        $teamMembers = TeamMember::orderBy('display_order')
            ->orderBy('name')
            ->get();

        return view(
            'admin.website.team.index',
            compact('teamMembers')
        );
    }


    /**
     * Show create form.
     */
    public function create()
    {
        return view(
            'admin.website.team.create'
        );
    }


    /**
     * Store a team member.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'position' => [
                'required',
                'string',
                'max:255',
            ],

            'department' => [
                'nullable',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
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

            'linkedin_url' => [
                'nullable',
                'url',
                'max:500',
            ],

            'facebook_url' => [
                'nullable',
                'url',
                'max:500',
            ],

            'instagram_url' => [
                'nullable',
                'url',
                'max:500',
            ],

            'display_order' => [
                'required',
                'integer',
                'min:0',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Upload Photo
        |--------------------------------------------------------------------------
        */

        $photoPath = null;

        if ($request->hasFile('photo')) {

            $photoPath = $request
                ->file('photo')
                ->store('team-members', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Create Team Member
        |--------------------------------------------------------------------------
        */

        TeamMember::create([

            'name' =>
                $validated['name'],

            'position' =>
                $validated['position'],

            'department' =>
                $validated['department'] ?? null,

            'description' =>
                $validated['description'] ?? null,

            'photo' =>
                $photoPath,

            'email' =>
                $validated['email'] ?? null,

            'phone' =>
                $validated['phone'] ?? null,

            'linkedin_url' =>
                $validated['linkedin_url'] ?? null,

            'facebook_url' =>
                $validated['facebook_url'] ?? null,

            'instagram_url' =>
                $validated['instagram_url'] ?? null,

            'display_order' =>
                $validated['display_order'],

            'is_active' =>
                $request->boolean('is_active'),
        ]);


        return redirect()
            ->route('admin.team.index')
            ->with(
                'success',
                'Team member added successfully.'
            );
    }


    /**
     * Display a team member.
     */
    public function show(TeamMember $teamMember)
    {
        return view(
            'admin.website.team.show',
            compact('teamMember')
        );
    }


    /**
     * Show edit form.
     */
    public function edit(TeamMember $teamMember)
    {
        return view(
            'admin.website.team.edit',
            compact('teamMember')
        );
    }


    /**
     * Update team member.
     */
    public function update(
        Request $request,
        TeamMember $teamMember
    ) {

        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'position' => [
                'required',
                'string',
                'max:255',
            ],

            'department' => [
                'nullable',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
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

            'linkedin_url' => [
                'nullable',
                'url',
                'max:500',
            ],

            'facebook_url' => [
                'nullable',
                'url',
                'max:500',
            ],

            'instagram_url' => [
                'nullable',
                'url',
                'max:500',
            ],

            'display_order' => [
                'required',
                'integer',
                'min:0',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Existing Photo
        |--------------------------------------------------------------------------
        */

        $photoPath = $teamMember->photo;


        /*
        |--------------------------------------------------------------------------
        | Replace Photo
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photo')) {

            if (
                $teamMember->photo &&
                Storage::disk('public')
                    ->exists($teamMember->photo)
            ) {

                Storage::disk('public')
                    ->delete($teamMember->photo);
            }


            $photoPath = $request
                ->file('photo')
                ->store('team-members', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Update
        |--------------------------------------------------------------------------
        */

        $teamMember->update([

            'name' =>
                $validated['name'],

            'position' =>
                $validated['position'],

            'department' =>
                $validated['department'] ?? null,

            'description' =>
                $validated['description'] ?? null,

            'photo' =>
                $photoPath,

            'email' =>
                $validated['email'] ?? null,

            'phone' =>
                $validated['phone'] ?? null,

            'linkedin_url' =>
                $validated['linkedin_url'] ?? null,

            'facebook_url' =>
                $validated['facebook_url'] ?? null,

            'instagram_url' =>
                $validated['instagram_url'] ?? null,

            'display_order' =>
                $validated['display_order'],

            'is_active' =>
                $request->boolean('is_active'),
        ]);


        return redirect()
            ->route('admin.team.index')
            ->with(
                'success',
                'Team member updated successfully.'
            );
    }


    /**
     * Toggle active status.
     */
    public function toggleStatus(
        TeamMember $teamMember
    ) {

        $teamMember->update([
            'is_active' => !$teamMember->is_active,
        ]);


        return back()->with(
            'success',
            'Team member status updated successfully.'
        );
    }


    /**
     * Delete team member.
     */
    public function destroy(
        TeamMember $teamMember
    ) {

        if (
            $teamMember->photo &&
            Storage::disk('public')
                ->exists($teamMember->photo)
        ) {

            Storage::disk('public')
                ->delete($teamMember->photo);
        }


        $teamMember->delete();


        return back()->with(
            'success',
            'Team member deleted successfully.'
        );
    }
}
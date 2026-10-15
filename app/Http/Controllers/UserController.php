<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display all users.
     */
    public function index()
    {
        $users = User::with([
            'roles',
            'department',
        ])
        ->latest()
        ->paginate(15);

        return view('users.index', compact('users'));
    }

    /**
     * Show create user form.
     */
    public function create()
    {
        $roles = Role::where('guard_name', 'web')
            ->orderBy('name')
            ->get();

        $departments = \App\Models\Department::where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('users.create', compact(
            'roles',
            'departments'
        ));
    }

    /**
     * Store a new user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:50',
            ],

            'department_id' => [
                'nullable',
                'exists:departments,id',
            ],

            'role' => [
                'required',
                'exists:roles,name',
            ],

            'status' => [
                'required',
                Rule::in([
                    'active',
                    'inactive',
                ]),
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],

            'profile_photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Profile Photo
        |--------------------------------------------------------------------------
        */

        $imagePath = null;

        if ($request->hasFile('profile_photo')) {
            $imagePath = $request
                ->file('profile_photo')
                ->store('profiles', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Create User
        |--------------------------------------------------------------------------
        */

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'department_id' => $validated['department_id'] ?? null,
            'status' => $validated['status'],
            'profile_photo' => $imagePath,
            'password' => $validated['password'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Assign Spatie Role
        |--------------------------------------------------------------------------
        */

        $user->assignRole($validated['role']);

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display a user.
     */
    public function show(User $user)
    {
        $user->load([
            'roles',
            'permissions',
            'department',
        ]);

        return view('users.show', compact('user'));
    }

    /**
     * Show edit form.
     */
    public function edit(User $user)
    {
        $user->load('roles');

        $roles = Role::where('guard_name', 'web')
            ->orderBy('name')
            ->get();

        $departments = \App\Models\Department::where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('users.edit', compact(
            'user',
            'roles',
            'departments'
        ));
    }

    /**
     * Update user.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')
                    ->ignore($user->id),
            ],

            'phone' => [
                'nullable',
                'string',
                'max:50',
            ],

            'department_id' => [
                'nullable',
                'exists:departments,id',
            ],

            'role' => [
                'required',
                'exists:roles,name',
            ],

            'status' => [
                'required',
                Rule::in([
                    'active',
                    'inactive',
                ]),
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],

            'profile_photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Profile Photo
        |--------------------------------------------------------------------------
        */

        $imagePath = $user->profile_photo;

        if ($request->hasFile('profile_photo')) {

            if (
                $user->profile_photo &&
                Storage::disk('public')->exists($user->profile_photo)
            ) {
                Storage::disk('public')
                    ->delete($user->profile_photo);
            }

            $imagePath = $request
                ->file('profile_photo')
                ->store('profiles', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Update User
        |--------------------------------------------------------------------------
        */

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'department_id' => $validated['department_id'] ?? null,
            'status' => $validated['status'],
            'profile_photo' => $imagePath,
        ];

        /*
        |--------------------------------------------------------------------------
        | Update Password Only If Supplied
        |--------------------------------------------------------------------------
        */

        if (!empty($validated['password'])) {
            $data['password'] = $validated['password'];
        }

        $user->update($data);

        /*
        |--------------------------------------------------------------------------
        | Sync Spatie Role
        |--------------------------------------------------------------------------
        */

        $user->syncRoles([
            $validated['role'],
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Delete user.
     */
    public function destroy(User $user)
    {
        /*
        |--------------------------------------------------------------------------
        | Protect Last Super Admin
        |--------------------------------------------------------------------------
        */

        if (
            $user->hasRole('Super Admin') &&
            User::role('Super Admin')->count() <= 1
        ) {
            return back()->with(
                'error',
                'The last Super Admin cannot be deleted.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Delete Profile Photo
        |--------------------------------------------------------------------------
        */

        if (
            $user->profile_photo &&
            Storage::disk('public')->exists($user->profile_photo)
        ) {
            Storage::disk('public')
                ->delete($user->profile_photo);
        }

        /*
        |--------------------------------------------------------------------------
        | Soft Delete
        |--------------------------------------------------------------------------
        */

        $user->delete();

        return back()->with(
            'success',
            'User deleted successfully.'
        );
    }

    /**
     * Toggle user status.
     */
    public function toggleStatus(User $user)
    {
        /*
        |--------------------------------------------------------------------------
        | Prevent disabling the final active Super Admin
        |--------------------------------------------------------------------------
        */

        if (
            $user->hasRole('Super Admin') &&
            $user->status === 'active' &&
            User::role('Super Admin')
                ->where('status', 'active')
                ->count() <= 1
        ) {
            return back()->with(
                'error',
                'The last active Super Admin cannot be deactivated.'
            );
        }

        $user->update([
            'status' => $user->status === 'active'
                ? 'inactive'
                : 'active',
        ]);

        return back()->with(
            'success',
            'User status updated successfully.'
        );
    }
}
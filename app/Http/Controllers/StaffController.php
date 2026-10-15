<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class StaffController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Staff List
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = Staff::with('department')
            ->latest();


        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('staff_id', 'like', "%{$search}%")
                    ->orWhere('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('other_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('position', 'like', "%{$search}%");

            });
        }


        /*
        |--------------------------------------------------------------------------
        | Department Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('department_id')) {

            $query->where(
                'department_id',
                $request->department_id
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Status Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }


        $staff = $query
            ->paginate(15)
            ->withQueryString();


        $departments = Department::where('status', 'active')
            ->orderBy('name')
            ->get();


        return view(
            'staff.index',
            compact(
                'staff',
                'departments'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Create
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $departments = Department::where('status', 'active')
            ->orderBy('name')
            ->get();


        return view(
            'staff.create',
            compact('departments')
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

            'first_name' => [
                'required',
                'string',
                'max:100',
            ],

            'last_name' => [
                'required',
                'string',
                'max:100',
            ],

            'other_name' => [
                'nullable',
                'string',
                'max:100',
            ],

            'gender' => [
                'nullable',
                'string',
                'max:30',
            ],

            'date_of_birth' => [
                'nullable',
                'date',
            ],

            'address' => [
                'nullable',
                'string',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:staff,email',
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

            'position' => [
                'required',
                'string',
                'max:150',
            ],

            'salary' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'employment_date' => [
                'nullable',
                'date',
            ],

            'status' => [
                'required',
                Rule::in([
                    'active',
                    'inactive',
                ]),
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
        | Generate Staff ID
        |--------------------------------------------------------------------------
        */

        $lastStaff = Staff::withTrashed()
            ->latest('id')
            ->first();


        $nextNumber = $lastStaff
            ? $lastStaff->id + 1
            : 1;


        $staffId = 'EES-STF-' . str_pad(
            $nextNumber,
            4,
            '0',
            STR_PAD_LEFT
        );


        /*
        |--------------------------------------------------------------------------
        | Profile Photo
        |--------------------------------------------------------------------------
        */

        $imagePath = null;

        if ($request->hasFile('profile_photo')) {

            $imagePath = $request
                ->file('profile_photo')
                ->store('staff', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Create Staff
        |--------------------------------------------------------------------------
        */

        Staff::create([

            'staff_id' => $staffId,

            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'other_name' => $validated['other_name'] ?? null,

            'gender' => $validated['gender'] ?? null,
            'date_of_birth' => $validated['date_of_birth'] ?? null,
            'address' => $validated['address'] ?? null,

            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,

            'department_id' => $validated['department_id'] ?? null,

            'position' => $validated['position'],

            'salary' => $validated['salary'] ?? null,

            'employment_date' =>
                $validated['employment_date'] ?? null,

            'status' => $validated['status'],

            'profile_photo' => $imagePath,
        ]);


        return redirect()
            ->route('staff.index')
            ->with(
                'success',
                'Staff member created successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Show
    |--------------------------------------------------------------------------
    */

    public function show(Staff $staff)
    {
        $staff->load([
            'department',
            'user',
        ]);


        return view(
            'staff.show',
            compact('staff')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Edit
    |--------------------------------------------------------------------------
    */

    public function edit(Staff $staff)
    {
        $departments = Department::where('status', 'active')
            ->orderBy('name')
            ->get();


        return view(
            'staff.edit',
            compact(
                'staff',
                'departments'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Staff $staff
    ) {

        $validated = $request->validate([

            'first_name' => [
                'required',
                'string',
                'max:100',
            ],

            'last_name' => [
                'required',
                'string',
                'max:100',
            ],

            'other_name' => [
                'nullable',
                'string',
                'max:100',
            ],

            'gender' => [
                'nullable',
                'string',
                'max:30',
            ],

            'date_of_birth' => [
                'nullable',
                'date',
            ],

            'address' => [
                'nullable',
                'string',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('staff', 'email')
                    ->ignore($staff->id),
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

            'position' => [
                'required',
                'string',
                'max:150',
            ],

            'salary' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'employment_date' => [
                'nullable',
                'date',
            ],

            'status' => [
                'required',
                Rule::in([
                    'active',
                    'inactive',
                ]),
            ],

            'profile_photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);


        $imagePath = $staff->profile_photo;


        if ($request->hasFile('profile_photo')) {

            if (
                $staff->profile_photo &&
                Storage::disk('public')
                    ->exists($staff->profile_photo)
            ) {

                Storage::disk('public')
                    ->delete($staff->profile_photo);
            }


            $imagePath = $request
                ->file('profile_photo')
                ->store('staff', 'public');
        }


        $staff->update([

            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'other_name' => $validated['other_name'] ?? null,

            'gender' => $validated['gender'] ?? null,
            'date_of_birth' => $validated['date_of_birth'] ?? null,
            'address' => $validated['address'] ?? null,

            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,

            'department_id' => $validated['department_id'] ?? null,

            'position' => $validated['position'],

            'salary' => $validated['salary'] ?? null,

            'employment_date' =>
                $validated['employment_date'] ?? null,

            'status' => $validated['status'],

            'profile_photo' => $imagePath,
        ]);


        return redirect()
            ->route('staff.index')
            ->with(
                'success',
                'Staff member updated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */

    public function destroy(Staff $staff)
    {
        if (
            $staff->profile_photo &&
            Storage::disk('public')
                ->exists($staff->profile_photo)
        ) {

            Storage::disk('public')
                ->delete($staff->profile_photo);
        }


        $staff->delete();


        return back()->with(
            'success',
            'Staff member deleted successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Toggle Status
    |--------------------------------------------------------------------------
    */

    public function toggleStatus(Staff $staff)
    {
        $staff->update([

            'status' =>
                $staff->status === 'active'
                    ? 'inactive'
                    : 'active',

        ]);


        return back()->with(
            'success',
            'Staff status updated successfully.'
        );
    }
}
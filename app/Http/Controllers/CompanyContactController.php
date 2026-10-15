<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CompanyContact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CompanyContactController extends Controller
{
    /**
     * Display the registered company contact details.
     */
    public function index(): View
    {
        $contacts = CompanyContact::latest()->paginate(10);

        return view('admin.company-contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating company contact details.
     */
    public function create(): View
    {
        return view('admin.company-contacts.create');
    }

    /**
     * Store company contact details.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateContact($request);

        $data['is_published'] = $request->boolean('is_published');

        CompanyContact::create($data);

        return redirect()
            ->route('company-contacts.index')
            ->with('success', 'Company contact details have been saved successfully.');
    }

    /**
     * Display one company contact record.
     */
    public function show(CompanyContact $companyContact): View
    {
        return view('admin.company-contacts.show', compact('companyContact'));
    }

    /**
     * Show the form for editing company contact details.
     */
    public function edit(CompanyContact $companyContact): View
    {
        return view('admin.company-contacts.edit', compact('companyContact'));
    }

    /**
     * Update company contact details.
     */
    public function update(
        Request $request,
        CompanyContact $companyContact
    ): RedirectResponse {
        $data = $this->validateContact($request);

        $data['is_published'] = $request->boolean('is_published');

        $companyContact->update($data);

        return redirect()
            ->route('company-contacts.index')
            ->with('success', 'Company contact details have been updated successfully.');
    }

    /**
     * Publish or unpublish the contact details.
     */
    public function togglePublication(
        CompanyContact $companyContact
    ): RedirectResponse {
        $companyContact->update([
            'is_published' => ! $companyContact->is_published,
        ]);

        return back()->with(
            'success',
            $companyContact->is_published
                ? 'Company contact details are now published.'
                : 'Company contact details have been unpublished.'
        );
    }

    /**
     * Validate contact information.
     */
    private function validateContact(Request $request): array
    {
        return $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'primary_phone' => ['nullable', 'string', 'max:50'],
            'secondary_phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'secondary_email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:1000'],
            'city' => ['nullable', 'string', 'max:150'],
            'region' => ['nullable', 'string', 'max:150'],
            'country' => ['nullable', 'string', 'max:150'],
            'google_maps_embed' => ['nullable', 'string', 'max:10000'],
            'google_maps_url' => ['nullable', 'url', 'max:2048'],
            'weekday_hours' => ['nullable', 'string', 'max:255'],
            'saturday_hours' => ['nullable', 'string', 'max:255'],
            'sunday_hours' => ['nullable', 'string', 'max:255'],
            'linkedin_url' => ['nullable', 'url', 'max:2048'],
            'facebook_url' => ['nullable', 'url', 'max:2048'],
            'instagram_url' => ['nullable', 'url', 'max:2048'],
            'x_url' => ['nullable', 'url', 'max:2048'],
            'is_published' => ['sometimes', 'boolean'],
        ]);
    }
}

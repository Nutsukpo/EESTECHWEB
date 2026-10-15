<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactEnquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactEnquiry1Controller extends Controller
{
    /**
     * Display and filter submitted enquiries.
     */
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:150'],
            'status' => ['nullable', 'in:new,read,resolved'],
        ]);

        $query = ContactEnquiry::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];

            $query->where(function ($builder) use ($search) {
                $builder->where('contact_name', 'like', "%{$search}%")
                    ->orWhere('company_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%");
            });
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        $enquiries = $query->latest()->paginate(15)->withQueryString();

        $counts = [
            'total' => ContactEnquiry::count(),
            'new' => ContactEnquiry::where('status', 'new')->count(),
            'read' => ContactEnquiry::where('status', 'read')->count(),
            'resolved' => ContactEnquiry::where('status', 'resolved')->count(),
        ];

        return view('admin.contact-enquiries.index', compact(
            'enquiries',
            'counts',
            'filters'
        ));
    }

    /**
     * Display an enquiry and mark it as read.
     */
    public function show(ContactEnquiry $contactEnquiry): View
    {
        if ($contactEnquiry->status === 'new') {
            $contactEnquiry->update([
                'status' => 'read',
                'read_at' => now(),
            ]);
        }

        return view('admin.contact-enquiries.show', compact('contactEnquiry'));
    }

    /**
     * Update an enquiry's status.
     */
    public function updateStatus(
        Request $request,
        ContactEnquiry $contactEnquiry
    ): RedirectResponse {
        $data = $request->validate([
            'status' => ['required', 'in:new,read,resolved'],
        ]);

        $contactEnquiry->update([
            'status' => $data['status'],
            'read_at' => $data['status'] === 'new'
                ? null
                : ($contactEnquiry->read_at ?? now()),
        ]);

        return back()->with('success', 'Enquiry status updated successfully.');
    }

    /**
     * Delete an enquiry.
     */
    public function destroy(ContactEnquiry $contactEnquiry): RedirectResponse
    {
        $contactEnquiry->delete();

        return redirect()
            ->route('admin.contact-enquiries.index')
            ->with('success', 'Enquiry deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ContactEnquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class ContactEnquiryController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $key = 'contact-enquiry:' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            throw ValidationException::withMessages([
                'contact_form' => 'Too many enquiries have been submitted. Please try again later.',
            ]);
        }

        RateLimiter::hit($key, 60);

        $data = $request->validate([
            'company_name' => ['nullable', 'string', 'max:255'],
            'contact_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        ContactEnquiry::create($data);

        return redirect()
            ->route('contact.index')
            ->with('enquiry_success', 'Thank you for contacting EES Technologies. Your enquiry has been received.');
    }
}

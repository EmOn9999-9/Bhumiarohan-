<?php

namespace App\Http\Controllers;

use App\Mail\NewInquiryMail;
use App\Models\Inquiry;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show(Request $request)
    {
        return view('pages.contact', [
            'services' => Service::active()->pluck('title'),
            'selected' => $request->query('service'),
        ]);
    }

    public function store(Request $request)
    {
        // Honeypot field: real visitors never fill it in.
        if ($request->filled('website')) {
            return back()->with('success', 'Thank you! We will get back to you soon.');
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:30', 'regex:/^[0-9+\-\s()]{7,30}$/'],
            'email' => ['nullable', 'email', 'max:150'],
            'service' => ['nullable', 'string', 'max:150'],
            'message' => ['required', 'string', 'max:3000'],
        ], ['phone.regex' => 'Please enter a valid phone number.']);

        $inquiry = Inquiry::create($data);

        // The inquiry is always saved to the admin panel; the email is a notification on top.
        if ($recipient = config('company.inquiry_notify')) {
            try {
                Mail::to($recipient)->send(new NewInquiryMail($inquiry));
            } catch (\Throwable $e) {
                Log::warning('Inquiry email could not be sent: '.$e->getMessage(), ['inquiry_id' => $inquiry->id]);
            }
        }

        return redirect()->to(route('contact').'#contact-form')
            ->with('success', 'Thank you! Your message has been received. We will get back to you soon.');
    }
}

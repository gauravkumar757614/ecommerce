<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\Contact;
use App\Models\About;
use App\Models\EmailConfiguration;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    // About page
    public function index()
    {
        $about      =       About::first();
        return view('frontend.pages.about', compact('about'));
    }

    // Terms and conditions page
    public function termsAndConditions()
    {
        $terms      =       TermsAndCondition::first();
        return view('frontend.pages.terms-and-conditions', compact('terms'));
    }

    // Contact page
    public function contact()
    {
        return view('frontend.pages.contact');
    }

    // Handle contact form
    public function handleContactForm(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name'          =>      ['required', 'max:200'],
            'subject'       =>      ['required', 'max:200'],
            'message'       =>      ['required', 'max:1000'],
            'email'         =>      ['required', 'email']
        ]);

        $setting        =       EmailConfiguration::first();
        Mail::to($setting->email)->send(new Contact($request->subject, $request->message, $request->email));

        return response(['status' => 'success', 'message' => 'Mail send successfully!']);
    }
}

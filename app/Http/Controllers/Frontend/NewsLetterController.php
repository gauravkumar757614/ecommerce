<?php

namespace App\Http\Controllers\Frontend;

use App\Helper\MailHelper;
use App\Http\Controllers\Controller;
use App\Mail\SubscriptionVerification;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class NewsLetterController extends Controller
{
    // Subscribe to news letter
    public function newsLettersRequest(Request $request)
    {
        $request->validate([
            'email'     =>      ['required', 'email', 'max:200']
        ]);

        $existingSubscriber         =       NewsletterSubscriber::where('email', $request->email)->first();

        if (!empty($existingSubscriber)) {
            if ($existingSubscriber->is_verified == 0) {
                // send verification email
                $existingSubscriber->verified_token =       Str::random(25);
                $existingSubscriber->save();
                // Set mail configuration before sending mail
                MailHelper::setMailConfig();

                // send verification mail
                Mail::to($existingSubscriber->email)->send(new SubscriptionVerification($existingSubscriber));
                return response(['status' => 'success', 'message' => 'A verification link has been send to your email']);
            } else if ($existingSubscriber->is_verified == 1) {
                return response(['status' => 'error', 'message' => 'You have already subscribed with this email!']);
            }
        } else {
            $subscriber                 =       new NewsletterSubscriber();
            $subscriber->email          =       $request->email;
            $subscriber->verified_token =       Str::random(25);
            $subscriber->is_verified    =       0;
            $subscriber->save();
            // Set mail configuration before sending mail
            MailHelper::setMailConfig();

            // send verification mail
            Mail::to($subscriber->email)->send(new SubscriptionVerification($subscriber));
            return response(['status' => 'success', 'message' => 'A verification link has been send to your email']);
        }
    }

    /**
     * Verifying subscriber email
     */
    public function newsLettersEmailVerify(string $token)
    {
        $verify         =       NewsletterSubscriber::where('verified_token', $token)->first();
        if ($verify) {
            $verify->verified_token     =       'verified';
            $verify->is_verified        =       1;
            $verify->save();
            toastr("Email verified successfully!", 'success', 'success');
            return redirect()->route('home');
        } else {
            toastr("Invalid Token!", 'error', 'error');
            return redirect()->route('home');
        }
    }
}

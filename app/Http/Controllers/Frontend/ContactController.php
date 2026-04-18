<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Brian2694\Toastr\Facades\Toastr;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.pages.contact');
    }

    public function sendFooterInquiry(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        $name = $validated['name'];
        $email = $validated['email'];
        $messageText = $validated['message'];
        $supportEmail = config('mail.from.address');

        try {
            Mail::send('emails.footer-inquiry-notification', [
                'name' => $name,
                'email' => $email,
                'messageText' => $messageText,
                'submittedAt' => now(),
                'appName' => config('app.name', 'Property Management Portal'),
            ], function ($message) use ($email, $supportEmail) {
                $message->to($supportEmail)
                    ->replyTo($email)
                    ->subject('New Footer Inquiry Subscription');
            });

            Mail::send('emails.footer-inquiry-confirmation', [
                'name' => $name,
                'email' => $email,
                'messageText' => $messageText,
                'appName' => config('app.name', 'Property Management Portal'),
            ], function ($message) use ($email) {
                $message->to($email)
                    ->subject('We received your inquiry');
            });

            Toastr::success('Your inquiry was sent successfully. Please check your email.');
            return back();
        } catch (\Throwable $e) {
            Log::error('Footer inquiry email failed: ' . $e->getMessage(), [
                'name' => $name,
                'email' => $email,
            ]);

            Toastr::error('We could not send your inquiry right now. Please try again later.');
            return back()->withInput();
        }
    }
}

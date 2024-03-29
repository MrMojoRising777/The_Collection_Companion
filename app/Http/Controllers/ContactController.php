<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\UserConfirmation;
use App\Mail\AdminNotification;
use App\Mail\ContactFormSubmitted;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // get user's name
        $user = Auth::user()->name;
        $email = Auth::user()->email;

        $formData = array_merge($request->only(['subject', 'message']), ['name' => $user, 'email' => $email]);

        // send email to user
        Mail::to($email)->send(new UserConfirmation($formData));

        // send notification email to admin
        Mail::to('alexander.goyens@gmail.com')->send(new AdminNotification($formData));

        return redirect()->back()->with('success', 'Dankjewel! Wij hebben je email ontvangen en reageren zo snel mogelijk!');
    }
}

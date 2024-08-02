<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('home')->with('message', 'Email already verified!');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        $request->session()->regenerate();
        return redirect()->route('home')->with('message', 'Email verified successfully!');
    }

    public function authenticated(Request $request, $user){
        $user->last_login = now();
        $user->save();
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('home')->with('message', 'Email already verified!');
        }

        $request->user()->sendEmailVerificationNotification();

        return view('components.email-verification-sent')->with('message', 'Verification email sent!');
    }
}

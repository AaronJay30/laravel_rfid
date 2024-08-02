<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PasswordResetController extends Controller
{
    public function forgotPassword(){
        return view("User.forgot-password");
    }

    public function forgotPasswordPost(Request $request){
        $request->validate([
            'email' => ['required', 'email', Rule::exists('users','email')],
        ]);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            "email" => $request->email,
            "token" => $token,
            "created_at" => Carbon::now()
        ]);

        Mail::send("emails.forgot-password", ["token" => $token], function ($message) use ($request){
            $message->to($request->email);
            $message->subject("Reset Password");
        });

        return redirect()->to(route('forgot.password'))->with('message',"We have send an email to reset your password");
    }

    public function resetPassword($token){
        return view("user.reset-password", compact('token'));
    }

    public function resetPasswordPost(Request $request){
        $request->validate([
            "email" => ['required', 'email', Rule::exists('users','email')],
            "password" => "required|min:8|confirmed",
            "password_confirmation" => "required"
        ]);

        $updatePassword = DB::table('password_reset_tokens')
            ->where([
                "email" => $request->email,
                "token" => $request->token
            ])->first();

        if(!$updatePassword){
            return redirect()->to(route('reset.password'))->with('error', 'Error occured');
        }

        User::where("email", $request->email)
            ->update(["password" => bcrypt($request->password)]);

        DB::table('password_reset_tokens')->where(["email" => $request->email])->delete();

        return redirect()->to(route('login'))->with("message", "You've successfully changed your password");
    }
}

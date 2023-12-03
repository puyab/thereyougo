<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\Models\ResetPasswordRequest;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Mail;
use Toast;

class ResetPassswordLinkController extends Controller
{
    public function sendResetLink(Request $request)
    {
        $data = $request->validate(['email' => ['required', 'email']]);
        $user = User::query()->where('email', $data['email'])->first();

        if (!$user)
            return back()->withErrors(['email' => 'We did not found any user with this email']);

        $reset_password_request = ResetPasswordRequest::create([
            'user_id' => $user->id
        ]);

        Mail::to($user)->send(new ResetPassword($user->profile->first_name . ' ' . $user->profile->last_name, $reset_password_request->id));

        Toast::success('Reset email successfully sent');

        return back();
    }

    public function resetPassword(Request $request)
    {
        $data = $request->validate([
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $reset_password_request = ResetPasswordRequest::with('user')->find($request->id);

        if (!$reset_password_request) {
            Toast::danger('No password reset session exists with this id');
            return back();
        }

        if (now()->gt($reset_password_request->created_at->addHour())) {
            Toast::danger('This request expired');
            return back();
        }

        User::query()->where('id', $reset_password_request->user->id)->update(['password' => Hash::make($data['password'])]);

        $reset_password_request->delete();

        Toast::success('Password successfully updated');
        return redirect()->route('login');
    }
}

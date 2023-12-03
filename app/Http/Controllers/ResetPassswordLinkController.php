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

        $user = User::query()->where('email', $data['email'])->firstOrFail();

        $reset_password_request = ResetPasswordRequest::create([
            'user_id' => $user->id
        ]);

        Mail::to($user)->queue(new ResetPassword($user->profile->first_name . ' ' . $user->profile->last_name, $reset_password_request->id));

        Toast::success('Reset email successfully sent');

        return back();
    }

    public function resetPassword(Request $request)
    {
        $data = $request->validate([
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $reset_password_request = ResetPasswordRequest::with('user')->findOrFail($request->id);

        if ($reset_password_request->created_at->addHour()->isPast()) {
            Toast::danger('This request expired');
            return back();
        }

        $reset_password_request->user->update(['password' => Hash::make($data['password'])]);

        $reset_password_request->delete();

        Toast::success('Password successfully updated');
        return redirect()->route('login');
    }
}

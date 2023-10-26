<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Profile;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use ProtoneMedia\Splade\Facades\Toast;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request)
    {
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Profile::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'linkedin' => $request->linkedin,
            'user_id' => $user->id,
            'referred_from' => $request->referred_from ?? null
        ]);

        if($request->referred_from)
          Profile::query()
            ->where('referral_code', $request->referred_from)
            ->increment('referral_count');

        event(new Registered($user));

        Auth::login($user);

        Toast::success('Your account created')->leftBottom();
        return redirect(route('profile'));
    }
}

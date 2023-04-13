<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Belief;
use App\Models\ReferralCode;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Cookie;
use App\Mail\ReferralApprovalReminder;
use Illuminate\Support\Facades\Mail;
use App\Events\NewUserReferred;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $beliefs = Belief::all();
        return view('auth.register', compact('beliefs'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $referrerCode = empty($request->ref_code) ? Cookie::get('ref_code') : $request->ref_code;
        if (empty($referrerCode)) {
            return redirect()->back()->with('error', 'Registration is strictly by invitation');
        }

        if (ReferralCode::isInValid($referrerCode)) {
            return redirect()->back()->with('error', 'Invalid Code');
        }

        if (!ReferralCode::isValid($referrerCode)) {
            return redirect()->back()->with('error', 'Referral link/code is expired or has been used');
        }

        $referrer = \Hashids::decode($referrerCode)[0];

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'referrer' => $referrer,
            'status' => 'pending'
        ]);

        // Get the selected beliefs from the form submission
        $beliefs = $request->input('believe', []);

        // Sync the beliefs on the user model
        $user->beliefs()->sync($beliefs);
        $user->save();

        //Redeem code
        ReferralCode::redeemCode($referrerCode, $user->id);
        session()->flash('success', 'Registration Successful');
        $referrer = User::find($referrer);
        event(new Registered($user));
        event(new NewUserReferred($user, $referrer));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}

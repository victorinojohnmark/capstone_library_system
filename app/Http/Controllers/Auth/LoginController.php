<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // protected function credentials(Request $request)
    // {
    //     return [
    //         $this->username() => $request->{$this->username()},
    //         'password' => $request->password,
    //         'email_verified_at' => null, // Only allow login if email is verified
    //     ];
    // }

    protected function authenticated(Request $request, $user)
    {
        if (!$user->hasVerifiedEmail()) {
            auth()->logout();
            return back()->with('warning', 'You need to confirm your account. Please check your email.');
        }

        return redirect()->intended($this->redirectPath());
    }
}

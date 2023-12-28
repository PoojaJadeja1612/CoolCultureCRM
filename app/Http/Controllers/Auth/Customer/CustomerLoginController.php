<?php

namespace App\Http\Controllers\Auth\Customer;

use App\Http\Controllers\Controller;
use App\Models\LoginLogoutLog;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest:customer')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.customer.login');
    }

    protected function guard()
    {
        return Auth::guard('customer');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('customer')->attempt($credentials)) {
            $user = Auth::guard('customer')->user();

            if ($user->userStatus == 1) {
                // Authentication success
                LoginLogoutLog::create([
                    'user_id' => $user->id,
                    'action' => 'Login',
                    'type' => 'customer',
                ]);
                return redirect()->intended(route('customer.dashboard'));
            } else {
                // User status is not 1
                Auth::guard('customer')->logout();
                return redirect()->route('customer.login')->withErrors(['email' => 'Your account is not active.']);
            }
        }

        // Authentication failed
        return redirect()->route('customer.login')->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        LoginLogoutLog::create([
            'user_id' => Auth::guard('customer')->user()->id,
            'action' => 'Logout',
            'type' => 'customer',
        ]);

        Auth::guard('customer')->logout();

        $request->session()->invalidate();

        return redirect()->route('customer.login');
    }
}

<?php

namespace App\Http\Controllers\Auth\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/customer/login'; // Customize the redirection after password reset

    public function __construct()
    {
        $this->middleware('guest:customer');
    }

    // Use the 'customer' guard
    protected function guard()
    {
        return Auth::guard('customer');
    }

    // Use the 'customers' password broker
    protected function broker()
    {
        return Password::broker('customers');
    }

    // Override the showResetForm method to use the custom view
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.Customer.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}

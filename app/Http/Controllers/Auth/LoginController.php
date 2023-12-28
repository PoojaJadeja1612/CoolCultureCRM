<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LoginLogoutLog;
use App\Models\Setting;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');

        $credentials['userStatus'] = "1";

        return $credentials;

    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->getRoleNames()[0] != 'Super Admin') {
            $companyCheck = Setting::where('id', $user->companyId)->first();
            if ($companyCheck == null) {
                Auth::logout();
                return redirect()->route('login')
                    ->with('success', 'Company is inactive. You cannot log in.');
            }
        }

        if ($user->last_login == '') {
            $time[0] = Carbon::now();
            $time[1] = Carbon::now();
            $user->last_login = implode(',', $time);
            $user->save();
        } else {
            $time[0] = explode(',', $user->last_login)[1];
            $time[1] = Carbon::now();
            $user->last_login = implode(',', $time);
            $user->save();
        }

        LoginLogoutLog::create([
            'user_id' => $user->id,
            'action' => 'Login',
            'type' => 'Admin',
        ]);
        return redirect()->intended(route('Dashboard'));
    }

    public function logout()
    {
        LoginLogoutLog::create([
            'user_id' => Auth::user()->id,
            'action' => 'Logout',
            'type' => 'Admin',
        ]);
        Auth::logout();
        return redirect('/Admin/login');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProxyLogin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProxyLoginController extends Controller
{
    public function loginAs($userId)
    {
        // Verify that the authenticated user has the necessary permissions to perform a proxy login
        if (!Auth::user()->getRoleNames()[0] == 'Super Admin') {
            abort(403, 'Unauthorized');
        }

        // Check if the target user exists
        $targetUser = User::find($userId);
        if (!$targetUser) {
            abort(404, 'User not found');
        }

        // Create a record in the proxy logins table
        $proxyLogin = ProxyLogin::create([
            'proxy_id' => Auth::id(),
            'user_id' => $targetUser->id,
        ]);

        $lastInsertedId = $proxyLogin->id;
        Session::put('proxy_last_id', $lastInsertedId);

        // Store the original user ID in the session
        Session::put('original_user_id', Auth::id());

        // Log in as the target user
        Auth::loginUsingId($targetUser->id);

        // Redirect to a route for the impersonated user
        return redirect()->route('Dashboard')->with('success', 'Proxy Login to ' . $targetUser->name . ' !');
    }

    public function exitProxyMode(Request $request)
    {
        // Check if the user is currently in proxy mode
        if (Session::has('original_user_id')) {

            $proxy = ProxyLogin::find(Session::pull('proxy_last_id'));
            $proxy->expires_at = Carbon::now('Asia/Kolkata');
            $proxy->update();
            // Get the original user ID and log back in as the original user
            $originalUserId = Session::pull('original_user_id');
            Auth::loginUsingId($originalUserId);

            // Redirect to a route for the original user (e.g., dashboard or homepage)
            return redirect()->route('Dashboard')->with('success', 'Welcome back to your account.');
        }

        // If the user is not in proxy mode, handle it according to your application logic
        // For example, redirect them to the homepage or show an error message.
        return redirect()->route('Dashboard');
    }
}

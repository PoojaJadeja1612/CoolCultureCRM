<?php

namespace App\Http\Middleware;

use App\Models\Logs;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LogRouteHits
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $route = $request->path();
        if (Auth::check()) {
            Logs::create([
                'user_id' => Auth::user()->id,
                'route' => $route,
            ]);
        } elseif (Auth::guard('customer')->check()) {
            Logs::create([
                'user_id' => Auth::guard('customer')->user()->id,
                'route' => $route,
            ]);
        } else {
            Logs::create([
                'route' => $route,
            ]);
        }

        Log::info("Route hit: {$route}");

        return $next($request);
    }
}

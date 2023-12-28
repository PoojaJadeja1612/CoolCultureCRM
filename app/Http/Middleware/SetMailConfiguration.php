<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Models\CompanyMailSetting;

class SetMailConfiguration
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
        if (Auth::check()) {
            $user = Auth::user();
            $company = CompanyMailSetting::where('companyId',Auth::user()->companyId)->first();
            if ($company) {
                Config::set('mail.mailers.smtp.host', $company->host);
                Config::set('mail.mailers.smtp.port', $company->port);
                Config::set('mail.mailers.smtp.encryption', $company->encryption);
                Config::set('mail.mailers.smtp.username', $company->userName);
                Config::set('mail.mailers.smtp.password', $company->password);
                Config::set('mail.from.name', $company->fromName);
                Config::set('mail.from.address', $company->fromAddress);
            }else{
                Config::set('mail.mailers.smtp.host', 'smtp.gmail.com');
                Config::set('mail.mailers.smtp.port', '587');
                Config::set('mail.mailers.smtp.encryption', 'tls');
                Config::set('mail.mailers.smtp.username','poojaiboom@gmail.com');
                Config::set('mail.mailers.smtp.password', 'mgyiajjyefsopdlj');
                Config::set('mail.from.name', 'iboon Technologies');
                Config::set('mail.from.address', 'info@iboon.io');
            }
        }else{
            Config::set('mail.mailers.smtp.host', 'smtp.gmail.com');
            Config::set('mail.mailers.smtp.port', '587');
            Config::set('mail.mailers.smtp.encryption', 'tls');
            Config::set('mail.mailers.smtp.username','poojaiboom@gmail.com');
            Config::set('mail.mailers.smtp.password', 'mgyiajjyefsopdlj');
            Config::set('mail.from.name', 'iboon Technologies');
            Config::set('mail.from.address', 'info@iboon.io');
        }

        return $next($request);
    }
}

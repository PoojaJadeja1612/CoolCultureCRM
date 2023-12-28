<?php

namespace App\Providers;

use App\Models\CompanyMailSetting;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Paginator::defaultView('vendor.pagination.custom');

        view()->composer('*', function ($view) {
            $setting = [
                'companyName' => 'Iboon',
                'companySmallLogo' => 'defualtSmallLogo.png',
                'companyLogo' => 'defualtLogo.png',
                'companyFavicon' => 'defualtFav.png',
                'primaryColor' => '#ed7f11',
                'secondaryColor' => '#cccccc',
                'primaryFont' => '#ffffff',
                'secondaryFont' => '#616161',
                'hovorColor' => '#ffffff',
            ];
            if (Auth::check() && Auth::user()->getRoleNames()[0] !== 'Super Admin') {
                $view->with('setting', Setting::where('id', Auth::user()->companyId)->first());
                $view->with('companyMailSetting', CompanyMailSetting::where('companyId', Auth::user()->companyId)->first());
            } else {
                $view->with('setting', (object) $setting);
            }
        });

    }
}

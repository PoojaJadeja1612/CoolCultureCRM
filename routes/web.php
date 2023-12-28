<?php

use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\CompanyMailSetting;
use App\Http\Controllers\Admin\CompanyMasterController;
use App\Http\Controllers\Admin\CustomerAdminController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\permissionController;
use App\Http\Controllers\Admin\ProxyLoginController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TechnicianController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WorkController;
use App\Http\Controllers\Auth\Customer\CustomerLoginController;
use App\Http\Controllers\Auth\Customer\CustomerRegisterController;
use App\Http\Controllers\Auth\Customer\ForgotPasswordController as CustomerForgotPasswordController;
use App\Http\Controllers\Auth\Customer\ResetPasswordController as CustomerResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Website\CustomerController;
use Illuminate\Support\Facades\Route;

Route::middleware('logHis')->group(function () {

    // Route::get('/', function () {
    //     return view('Website.Home');
    // });
    Route::get('/', function () {
        return view('auth.login');
    });

    Route::prefix('Admin')->middleware(['setMailConfiguration'])->group(function () {
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('redirect.if.logged.in:web');
        Route::post('login', [LoginController::class, 'login']);
        Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');;
        Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');;
        Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');;
        // Auth::routes([
        //     'register' => false,
        // ]);
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    });

        Route::prefix('customer')->middleware(['setMailConfiguration'])->group(function () {
        Route::get('register', [CustomerRegisterController::class, 'showRegistrationForm'])->name('customer.register');
        Route::post('register', [CustomerRegisterController::class, 'register']);
        Route::get('login', [CustomerLoginController::class, 'showLoginForm'])->name('customer.login')->middleware('redirect.if.logged.in:customer');
        Route::post('login', [CustomerLoginController::class, 'login']);
        Route::post('logout', [CustomerLoginController::class, 'logout'])->name('customer.logout');
        Route::get('password/reset', [CustomerForgotPasswordController::class, 'showLinkRequestForm'])->name('customer.password.request');
        Route::post('password/email', [CustomerForgotPasswordController::class, 'sendResetLinkEmail'])->name('customer.password.email');
        Route::get('password/reset/{token}', [CustomerResetPasswordController::class, 'showResetForm'])->name('customer.password.reset');
        Route::post('password/reset', [CustomerResetPasswordController::class, 'reset'])->name('customer.password.update');
        Route::get('password/{id}', [CustomerAdminController::class, 'customerPasswordReset']);
    });
});

//Customer Routes
Route::prefix('customer')->middleware(['auth.customer', 'logHis','setMailConfiguration'])->group(function () {
    Route::get('dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
});

//Admin Routes
Route::group(['middleware' => ['auth', 'logHis', 'setMailConfiguration']], function () {
    Route::prefix('Admin')->group(function () {
        Route::get('Dashboard', [HomeController::class, 'index'])->name('Dashboard');
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
        Route::resource('permission', permissionController::class);
        Route::resource('company', CompanyMasterController::class);
        Route::resource('customer', CustomerAdminController::class);
        Route::resource('technician', TechnicianController::class);
        Route::resource('work', WorkController::class);
        Route::resource('activity', ActivityController::class);
        Route::get('/getaddress', [ActivityController::class, 'getaddress'])->name('getaddress');
        Route::get('emailSetting', [CompanyMailSetting::class, 'emailSetting'])->name('emailSetting');
        Route::post('emailSettingUpdate', [CompanyMailSetting::class, 'emailSettingUpdate'])->name('emailSettingUpdate');
        Route::get('Profile', [UserController::class, 'Profile'])->name('Profile');
        Route::post('profileUpdate', [UserController::class, 'profileUpdate']);
        Route::get('password/{id}', [UserController::class, 'password']);
        Route::post('updatePassword/{id}', [UserController::class, 'updatePassword']);
        Route::get('Setting', [HomeController::class, 'setting'])->name('Setting');
        Route::post('updateSetting', [HomeController::class, 'updateSetting'])->name('updateSetting');
        Route::get('/proxy-login/{user_id}', [ProxyLoginController::class, 'loginAs'])->name('proxy.login');
        Route::get('/exit-proxy', [ProxyLoginController::class, 'exitProxyMode'])->name('proxy.exit');
        Route::get('deletedCompany', [CompanyMasterController::class, 'deletedCompany'])->name('deletedCompany');
        Route::get('companyRestore/{id}', [CompanyMasterController::class, 'companyRestore'])->name('companyRestore');

    });
});

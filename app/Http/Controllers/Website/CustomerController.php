<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function dashboard()
    {
        return view('Website.dashboard');
    }
}

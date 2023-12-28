<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:company-setting', ['only' => ['setting', 'updateSetting']]);

    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('Admin.home');
    }

    public function setting()
    {
        return view('Admin.setting');
    }

    public function updateSetting(Request $request)
    {
        $this->validate($request, [
            'companyName' => 'required',
            'contactPerson' => 'required',
            'companyEmail' => 'required',
            'companyPhone' => 'required',
            'addressLine1' => 'required',
            'addressLine2' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required',
        ]);

        $data = $request->all();
        $setting = Setting::where('id', Auth::user()->companyId)->first();
        $setting->companyName = $data['companyName'];
        $setting->gst = $data['gst'];
        $setting->pan = $data['pan'];
        $setting->contact_person = $data['contactPerson'];
        $setting->companyEmail = $data['companyEmail'];
        $setting->companyPhone = $data['companyPhone'];
        $setting->addressLine1 = $data['addressLine1'];
        $setting->addressLine2 = $data['addressLine2'];
        $setting->country = $data['country'];
        $setting->state = $data['state'];
        $setting->city = $data['city'];
        $setting->pincode = $data['pincode'];
        if ($request->companySmallLogo) {
            $name = $request->file('companySmallLogo')->getClientOriginalName();
            $request->file('companySmallLogo')->move('Logo/', $name);
            $setting->companySmallLogo = $name;
        }
        if ($request->companyLogo) {
            $name = $request->file('companyLogo')->getClientOriginalName();
            $request->file('companyLogo')->move('Logo/', $name);
            $setting->companyLogo = $name;
        }
        if ($request->companyFavicon) {
            $name = $request->file('companyFavicon')->getClientOriginalName();
            $request->file('companyFavicon')->move('Logo/', $name);
            $setting->companyFavicon = $name;
        }
        $setting->primaryColor = $data['primaryColor'];
        $setting->primaryFont = $data['primaryFont'];
        $setting->secondaryColor = $data['secondaryColor'];
        $setting->secondaryFont = $data['secondaryFont'];
        $setting->hovorColor = $data['hovorColor'];
        $setting->updateBy = Auth::user()->id;
        $setting->update();
        return redirect()->route('Setting')->with('success', 'Setting update successfully');
    }
}

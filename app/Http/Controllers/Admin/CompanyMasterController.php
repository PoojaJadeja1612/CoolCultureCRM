<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyMailSetting;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CompanyMasterController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:company-list|company-create|company-edit|company-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:company-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:company-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:company-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Setting::orderby('id', 'DESC')->get();
        return view('Admin.company.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        $setting = new Setting;
        $setting->companyName = $data['companyName'];
        $setting->gst = $data['gst'];
        $setting->pan = $data['pan'];
        $setting->companyEmail = $data['companyEmail'];
        $setting->contact_person = $data['contactPerson'];
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
        $setting->save();

        $input['password'] = Hash::make($data['companyPhone']);
        $input['email'] = $data['companyEmail'];
        $input['name'] = $data['contactPerson'];
        $input['createBy'] = Auth::user()->id;
        $input['companyId'] = $setting->id;
        $user = User::create($input);
        $user->assignRole('Admin');

        $email = new CompanyMailSetting;
        $email->companyId = $setting->id;
        $email->mailer = "None";
        $email->save();

        return redirect()->route('company.index')->with('success', 'Company craeted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Setting::find($id);
        return view('Admin.company.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Setting::find($id);
        return view('Admin.company.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'companyName' => 'required',
            'companyEmail' => 'required',
            'contactPerson' => 'required',
            'companyPhone' => 'required',
            'addressLine1' => 'required',
            'addressLine2' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pincode' => 'required',
        ]);

        $data = $request->all();
        $setting = Setting::find($id);
        $setting->companyName = $data['companyName'];
        $setting->gst = $data['gst'];
        $setting->pan = $data['pan'];
        $setting->companyEmail = $data['companyEmail'];
        $setting->contact_person = $data['contactPerson'];
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
        return redirect()->route('company.index')->with('success', 'Company details update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Setting::find($id)->delete();
        return redirect()->route('company.index')
            ->with('success', 'Company delete Successfully');
    }

    public function deletedCompany()
    {
        $data = Setting::onlyTrashed()->get();
        return view('Admin.company.delete', compact('data'));
    }

    public function companyRestore($id)
    {
        $data = Setting::withTrashed()->find($id)->restore();
        return redirect()->route('company.index')->with('success', 'Company restore successfully');
    }
}

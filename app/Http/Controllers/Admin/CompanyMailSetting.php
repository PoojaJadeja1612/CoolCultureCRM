<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyMailSetting as ModelsCompanyMailSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyMailSetting extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:email-setting', ['only' => ['emailSetting', 'emailSettingUpdate']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function emailSetting()
    {
        return view('Admin.companyEmailSetting');
    }

    public function emailSettingUpdate(Request $request)
    {
        if ($request->mailer) {
            $this->validate($request, [
                'host' => 'required',
                'port' => 'required',
                'encryption' => 'required',
                'userName' => 'required',
                'password' => 'required',
                'fromAddress' => 'required',
                'fromName' => 'required',
            ]);

            $data = ModelsCompanyMailSetting::where('companyId', Auth::user()->companyId)->first();
            $data->mailer = $request->mailer;
            $data->host = $request->host;
            $data->port = $request->port;
            $data->encryption = $request->encryption;
            $data->userName = $request->userName;
            $data->password = $request->password;
            $data->fromAddress = $request->fromAddress;
            $data->fromName = $request->fromName;
            $data->updateBy = Auth::user()->id;
            $data->update();
        }

        return redirect()->route('emailSetting')
            ->with('success', 'Email Setting Update Successfully');
    }

}

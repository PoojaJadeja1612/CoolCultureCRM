<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TechnicianController extends Controller
{
    public function index(){
        $technician = Technician::orderby('id', 'DESC')->get();
        return view('Admin.technician.index')->with('technician', $technician);
    }

    public function create(){
        return view('Admin.technician.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $userLoginId = $user->id;
        $technician = new Technician;
        $technician->technician_name = $request->technician_name;
        $technician->technician_email = $request->technician_email;
        $technician->technician_number = $request->technician_number;
        $technician->technician_address1 = $request->technician_address1;
        $technician->technician_address2 = $request->technician_address2;
        $technician->technician_pincode = $request->technician_pincode;
        $technician->technician_city = $request->technician_city;
        $technician->technician_state = $request->technician_state;
        $technician->technician_contry = $request->technician_contry;
        $technician->technician_status = "1";
        $technician->createdBy = $userLoginId;
        $technician->save();

        return redirect()->route('technician.index')->with('success', 'Technician created successfully');;
    }

    public function show($id){
        $technician = Technician::Find($id);
        return view('Admin.technician.show')->with('technician', $technician);
    }

    public function edit($id){
        $technician = Technician::Find($id);
        return view('Admin.technician.edit')->with('technician', $technician);
    }

    public function update(Request $request, $id){
        $user = Auth::user();
        $userLoginId = $user->id;
        $technician = Technician::Find($id);
        $technician->technician_name = $request->technician_name;
        $technician->technician_email = $request->technician_email;
        $technician->technician_number = $request->technician_number;
        $technician->technician_address1 = $request->technician_address1;
        $technician->technician_address2 = $request->technician_address2;
        $technician->technician_pincode = $request->technician_pincode;
        $technician->technician_city = $request->technician_city;
        $technician->technician_state = $request->technician_state;
        $technician->technician_contry = $request->technician_contry;
        $technician->technician_status = $request->technician_status;
        $technician->updatedBy = $userLoginId;
        $technician->update();

        return redirect()->route('technician.index')->with('success', 'Technician update successfully');;
    }

    public function destroy($id){
        $technician = Technician::Find($id);
        $technician->delete();

        return redirect()->route('technician.index')->with('success', 'Technician deleted successfully');
    }
}

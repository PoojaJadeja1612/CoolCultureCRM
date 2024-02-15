<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerReportController extends Controller
{
    public function index() {
        $data = array();
        $customers = Customer::orderby('name', 'ASC')->get();    
        return view('Admin.customerReport.index')->with('customers', $customers)->with('data', $data);
    }

    public function create(Request $request){
        $name = $request->name;
        $todate = $request->todate;
        $fromdate = $request->fromdate;

        $fromdate = Carbon::parse($fromdate)->startOfDay();
        $todate = Carbon::parse($todate)->endOfDay();

        if ($name != null && $todate != null && $fromdate != null) {
            $data = Activity::select('activity_master.*', 'technician_master.technician_name', 'customers.name')
                ->leftjoin('technician_master', 'activity_master.technician', '=', 'technician_master.id')
                ->leftjoin('customers', 'activity_master.name', '=', 'customers.id')
                ->where('activity_master.name', $name)
                ->where('activity_master.date', '>=', $fromdate)
                ->where('activity_master.date', '<=', $todate)
                ->get();
        } else {
            $data = array();
        }
        $customers = Customer::orderby('name', 'ASC')->get();
        return view('Admin.customerReport.index')->with('customers', $customers)->with('data', $data);
    }
}

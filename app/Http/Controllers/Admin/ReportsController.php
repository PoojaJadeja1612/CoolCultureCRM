<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityWorkDetails;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportsController extends Controller
{
    public function index(){
        $data = array();
        return view('Admin.Reports.index')->with('data', $data);
    }

    public function create(Request $request){
        $todate = $request->todate;
        $fromdate = $request->fromdate;

        $fromdate = Carbon::parse($fromdate)->startOfDay();
        $todate = Carbon::parse($todate)->endOfDay();

        if ($todate != null && $fromdate != null) {
            $data = ActivityWorkDetails::select('activity_work_master.*', 'technician_master.technician_name', 'customers.name as customer_name', 'customers.address1', 'work_master.name as work_name')
            ->join('activity_master', 'activity_work_master.activity_id', '=', 'activity_master.id')
            ->leftjoin('technician_master', 'activity_master.technician', '=', 'technician_master.id')
            ->leftjoin('customers', 'activity_master.name', '=', 'customers.id')
            ->leftjoin('work_master', 'activity_work_master.work', '=', 'work_master.id')
            ->where('activity_master.date', '>=', $fromdate)
            ->where('activity_master.date', '<=', $todate)
            ->get();
       } else {
           $data = array();
       }
       return view('Admin.Reports.index')->with('data', $data);
    }
}

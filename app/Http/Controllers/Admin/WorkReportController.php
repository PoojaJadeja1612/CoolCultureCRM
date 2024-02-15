<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityWorkDetails;
use App\Models\Work;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WorkReportController extends Controller
{
    public function index(){
        $data = array();
        $work = Work::orderby('name', 'ASC')->get();
        return view('Admin.workReport.index')->with('work', $work)->with('data', $data);
    }

    public function create(Request $request){
        $name = $request->name;
        $todate = $request->todate;
        $fromdate = $request->fromdate;

        $fromdate = Carbon::parse($fromdate)->startOfDay();
        $todate = Carbon::parse($todate)->endOfDay();

        if ($name != null && $todate != null && $fromdate != null) {
             $data = ActivityWorkDetails::select('activity_work_master.*', 'technician_master.technician_name', 'customers.name as customer_name', 'customers.address1', 'work_master.name as work_name')
             ->rightjoin('activity_master', 'activity_work_master.activity_id', '=', 'activity_master.id')
             ->leftjoin('technician_master', 'activity_master.technician', '=', 'technician_master.id')
             ->leftjoin('customers', 'activity_master.name', '=', 'customers.id')
             ->leftjoin('work_master', 'activity_work_master.work', '=', 'work_master.id')
             ->where('activity_work_master.work', $name)
             ->where('activity_master.date', '>=', $fromdate)
             ->where('activity_master.date', '<=', $todate)
             ->get();
        } else {
            $data = array();
        }
        $work = Work::orderby('name', 'ASC')->get();
        return view('Admin.workReport.index')->with('work', $work)->with('data', $data);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Technician;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TechnicianReportController extends Controller
{
    public function index()
    {
        $data = array();
        $techActivity = Technician::all();
        return view('Admin.technicianReport.index')->with('data', $data)->with('techActivity', $techActivity);
    }
    public function create(Request $request)
    {
        $todate = $request->todate;
        $fromdate = $request->fromdate;

        $fromdate = Carbon::parse($fromdate)->startOfDay();
        $todate = Carbon::parse($todate)->endOfDay();

        if ($todate != null && $fromdate != null) {
            // $data = Activity::select('activity_master.*', 'technician_master.technician_name', 'customers.name', 'activity_work_master.remark')
            //     ->leftjoin('activity_work_master.*', 'activity_master.id', '=', 'activity_work_master.activity_id')
            //     ->leftjoin('technician_master', 'activity_master.technician', '=', 'technician_master.id')
            //     ->leftjoin('customers', 'activity_master.name', '=', 'customers.id')
            //     ->where('activity_master.technician', $name)
            //     ->where('activity_master.date', '>=', $fromdate)
            //     ->where('activity_master.date', '<=', $todate)
            //     ->get();
            $data = Activity::select('activity_master.*', 'technician_master.technician_name', 'customers.name', 'activity_work_master.remark' , 'activity_work_master.quantity', 'work_master.name as work_name')
            ->leftJoin('activity_work_master', 'activity_master.id', '=', 'activity_work_master.activity_id')
            ->leftJoin('work_master', 'activity_work_master.work', '=', 'work_master.id')
            ->leftJoin('technician_master', 'activity_master.technician', '=', 'technician_master.id')
            ->leftJoin('customers', 'activity_master.name', '=', 'customers.id')
            ->where('activity_master.date', '>=', $fromdate)
            ->where('activity_master.date', '<=', $todate)
            ->whereNull('activity_master.deleted_at')
            ->whereNull('activity_work_master.deleted_at')
            ->get();


        } else {
            $data = array();
        }
        $techActivity = Technician::all();
        return view('Admin.technicianReport.index')->with('data', $data)->with('techActivity', $techActivity);
    }
}

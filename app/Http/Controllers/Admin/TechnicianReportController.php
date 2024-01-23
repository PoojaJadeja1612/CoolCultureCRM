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
        $name = $request->name;
        $todate = $request->todate;
        $fromdate = $request->fromdate;

        $fromdate = Carbon::parse($fromdate)->startOfDay();
        $todate = Carbon::parse($todate)->endOfDay();

        if ($name != null && $todate != null && $fromdate != null) {
            $data = Activity::select('activity_master.*', 'technician_master.technician_name', 'customers.name')
                ->leftjoin('technician_master', 'activity_master.technician', '=', 'technician_master.id')
                ->leftjoin('customers', 'activity_master.name', '=', 'customers.id')
                ->where('activity_master.technician', $name)
                ->where('activity_master.created_at', '>=', $fromdate)
                ->where('activity_master.created_at', '<=', $todate)
                ->get();
        } else {
            $data = array();
        }
        $techActivity = Technician::all();
        return view('Admin.technicianReport.index')->with('data', $data)->with('techActivity', $techActivity);
    }
}

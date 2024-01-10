<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Technician;
use Illuminate\Http\Request;

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
        $date = $request->date;
        $status = $request->status;

        if ($name != null && $date != null && $status != null) {
            $data = Activity::select('activity_master.*', 'technician_master.technician_name', 'customers.name')
                ->leftjoin('technician_master', 'activity_master.technician', '=', 'technician_master.id')
                ->leftjoin('customers', 'activity_master.name', '=', 'customers.id')
                ->where('activity_master.technician', $name)
                ->where('activity_master.created_at', 'LIKE', '%' . $date . '%')
                ->where('activity_master.status', $status)
                ->get();
        } elseif ($name != null && $date != null && $status == null) {
            $data = Activity::select('activity_master.*', 'technician_master.technician_name', 'customers.name')
                ->leftjoin('technician_master', 'activity_master.technician', '=', 'technician_master.id')
                ->leftjoin('customers', 'activity_master.name', '=', 'customers.id')
                ->where('activity_master.technician', $name)
                ->where('activity_master.created_at', 'LIKE', '%' . $date . '%')
                ->get();
        } elseif ($name != null && $date == null && $status == null) {
            $data = Activity::select('activity_master.*', 'technician_master.technician_name', 'customers.name')
                ->leftjoin('technician_master', 'activity_master.technician', '=', 'technician_master.id')
                ->leftjoin('customers', 'activity_master.name', '=', 'customers.id')
                ->where('activity_master.technician', $name)
                ->get();
        } else {
            $data = array();
        }
        $techActivity = Technician::all();
        return view('Admin.technicianReport.index')->with('data', $data)->with('techActivity', $techActivity);
    }
}

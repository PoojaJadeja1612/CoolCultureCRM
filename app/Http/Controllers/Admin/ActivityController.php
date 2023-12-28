<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityWorkDetails;
use App\Models\Customer;
use App\Models\Technician;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;

class ActivityController extends Controller
{
    public function index()
    {
        // $activitys = Activity::where('status', '1')->get();
        $activitys = DB::table('activity_master')
            ->select('activity_master.*', 'technician_master.technician_name', 'customers.name')
            ->leftJoin('technician_master', 'activity_master.technician', '=', 'technician_master.id')
            ->leftJoin('customers', 'activity_master.name', '=', 'customers.id')->where('activity_master.deleted_at', NULL)->orderby('activity_master.id', 'DESC')->get();
        // dd($activitys);
        return view('Admin.activity.index')->with('activitys', $activitys);
    }

    public function create()
    {
        $work = Work::orderby('name', 'ASC')->get();
        $customer = Customer::where('userStatus', '1')->orderby('name', 'ASC')->get();
        $technician = Technician::where('technician_status', '1')->orderby('technician_name', 'ASC')->get();
        return view('Admin.activity.create')->with('customer', $customer)->with('technician', $technician)->with('work', $work);
    }

    public function store(Request $request)
    {
        $user = "";
        $user = Auth::user();
        $userLoginId = $user->id;
        $activity = new Activity;
        $activity->name = $request->get('name');
        $activity->Address = $request->get('Address');
        $activity->technician = $request->get('technician');
        $activity->date = $request->get('date');
        $activity->status = $request->get('status');
        $activity->createdBy = $userLoginId;
        $activity->save();

        $work = $request->get('work');
        $remark = $request->get('remark');

        for ($i = 0; $i <  count($request->get('work')); $i++) {
            $activityWork = new ActivityWorkDetails;
            $activityWork->activity_id = $activity->id;
            $activityWork->work = $work[$i];
            $activityWork->remark = $remark[$i];
            $activityWork->save();
        }


        return redirect()->route('activity.index')
            ->with('success', 'Activity created successfully');
    }

    public function edit($id)
    {
        $work = Work::all();
        $customer = Customer::where('userStatus', '1')->get();
        $technician = Technician::where('technician_status', '1')->get();
        $activity = Activity::Find($id);
        $activityWork = ActivityWorkDetails::where('activity_id', $id)->get();
        // dd($activityWork);
        $jsonActivityWork = json_encode($activityWork);
        return view('Admin.activity.edit')->with('work', $work)->with('customer', $customer)->with('technician', $technician)->with('activity', $activity)->with('jsonActivityWork', $jsonActivityWork)->with('activityWork', $activityWork);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $userLoginId = $user->id;
        $activity = Activity::find($id);
        $activity->name = $request->get('name');
        $activity->Address = $request->get('Address');
        $activity->technician = $request->get('technician');
        $activity->date = $request->get('date');
        $activity->status = $request->get('status');
        $activity->updatedBy = $userLoginId;
        $activity->save();

        $work = $request->get('work');
        $remark = $request->get('remark');

        $activityWork = ActivityWorkDetails::where('activity_id', $id)->get();

        if ($activityWork->count() > 0) {
            foreach ($activityWork as $index => $aw) {
                $aw->activity_id = $activity->id;
                $aw->work = $work[$index];
                $aw->remark = $remark[$index];
                $aw->update();
            }
        } else {
            for ($i = 0; $i < count($work); $i++) {
                $newActivityWork = new ActivityWorkDetails;
                $newActivityWork->activity_id = $activity->id;
                $newActivityWork->work = $work[$i];
                $newActivityWork->remark = $remark[$i];
                $newActivityWork->save();
            }
        }


        return redirect()->route('activity.index')
            ->with('success', 'Activity update successfully');
    }

    public function destroy($id){
        $activity = Activity::Find($id);
        $activity->delete(); 

        $newActivityWork = ActivityWorkDetails::where('activity_id', $id)->get();
        foreach ($newActivityWork as $activityWork) {
            $activityWork->delete();
        }

        return redirect()->route('activity.index')
            ->with('success', 'Activity delete successfully');
    }

    public function getaddress(Request $request)
    {
        $customername = $request->customername;
        $selectAddress = Customer::where('id', $customername)->first();
        return $selectAddress;
    }
}

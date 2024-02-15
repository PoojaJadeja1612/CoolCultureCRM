<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Work;
use App\Rules\WorkName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class WorkController extends Controller
{
    public function index(){
        $work = Work::orderby('id', 'DESC')->get();
        return view('Admin.work.index')->with('work', $work);
    }

    public function create(){
        return view('Admin.work.create');
    }

    public function store(Request $request){

        $request->validate([
            'name' => ['required', 'max:50', new WorkName],
        ]);
        $user = Auth::user();
        $userLoginId = $user->id;
        $work = new Work;
        $work->name = $request->name;
        $work->createdBy =  $userLoginId;
        $work->save();

        return redirect()->route('work.index')->with("success", "Work created successfully");
    }

    public function show($id){
        $work = Work::Find($id);
        return view('Admin.work.show')->with('work', $work);
    }

    public function edit($id){
        $work = Work::Find($id);
        return view('Admin.work.edit')->with('work', $work);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => [
                'required',
                Rule::unique('work_master')->ignore($id),
            ],
        ];
        
        $this->validate($request, $rules);

        $user = Auth::user();
        $userLoginId = $user->id;
        $work = Work::Find($id);
        $work->name = $request->name;
        $work->updatedBy =  $userLoginId;
        $work->update();

        return redirect()->route('work.index')->with("success", "Work updated successfully");
    }

    public function destroy($id){
        $work = Work::Find($id);
        $work->delete();

        return redirect()->route('work.index')->with("success", "Work deleted successfully");
    }
}

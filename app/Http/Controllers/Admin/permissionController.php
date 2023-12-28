<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class permissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:permission-list|permission-create|permission-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:permission-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:permission-delete', ['only' => ['destroy']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::orderby('id', 'DESC')->get();
        return view('Admin.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'customName' => 'required',
        ]);

        if ($request->input('List-Create-edit-Delete-Permission')) {
            for ($i = 0; $i < count($request->permissionName); $i++) {
                $data = new Permission;
                $data->name = $request->permissionName[$i];
                $data->guard_name = 'web';
                $data->createBy = Auth::user()->id;
                $data->save();
            }
        } else {
            $data = new Permission;
            $data->name = $request->customName;
            $data->guard_name = 'web';
            $data->createBy = Auth::user()->id;
            $data->save();
        }
        return redirect()->route('permission.index')
            ->with('success', 'Permission created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Permission::find($id);
        $data->delete();
        return redirect()->route('permission.index')
            ->with('success', 'Permission deleted successfully');
    }
}
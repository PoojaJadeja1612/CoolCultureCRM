<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
        $this->middleware('permission:password-reset', ['only' => ['updatePassword', 'password']]);
    }

    public function index(Request $request)
    {
        if (Auth::user()->getRoleNames()[0] == "Super Admin") {
            $data = User::join('settings', 'users.companyId', '=', 'settings.id')->select('users.*', 'settings.companyName')->whereNull('settings.deleted_at')->orderby('id', 'DESC')->get();
        } else {
            $data = User::where('companyId', Auth::user()->companyId)->orderby('id', 'DESC')->get();
        }
        return view('Admin.users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('name', '!=', 'Super Admin')->pluck('name', 'name')->all();
        return view('Admin.users.create', compact('roles'));
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            // 'number' => 'required|unique:users',
            'password' => 'required|same:confirmPassword',
            'roles' => 'required',
            'userStatus' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['name'] = ucfirst($input['name']);
        $input['createBy'] = Auth::user()->id;
        $input['companyId'] = Auth::user()->companyId;
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('Admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::where('name', '!=', 'Super Admin')->pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('Admin.users.edit', compact('user', 'roles', 'userRole'));
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required',
            'userStatus' => 'required',
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $input['updateBy'] = Auth::user()->id;
        $input['name'] = ucfirst($input['name']);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }

    public function profile()
    {
        $user = User::find(Auth::user()->id);
        return view('Admin.users.profile')->with('user', $user);
    }

    public function profileUpdate(Request $request)
    {
        $id = Auth::user()->id;
        $this->validate($request, [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($id),
            ],
            'number' => [
                'required',
                Rule::unique('users')->ignore($id),
            ],
            'password' => 'same:confirmPassword',
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }
        if ($request->profileImage) {
            $name = $request->file('profileImage')->getClientOriginalName();
            $request->file('profileImage')->move('ProfileImage/', $name);
            $input['profileImage'] = $name;
        }

        $user = User::find($id);
        $user->update($input);
        return redirect()->route('Dashboard')
            ->with('success', 'Profile updated successfully');
    }

    public function password($id)
    {
        $data = User::Find($id);
        return view('Admin.users.passwordChange', ['post' => $data]);
    }

    public function updatePassword(Request $request, $id)
    {
        $input = $request->all();
        $user = User::find($id);
        $input['password'] = Hash::make($input['password']);
        $user->update($input);
        return redirect()->route('users.index')
            ->with('success', 'User Password Update Successfully');
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\UserCredentialsEmail;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class CustomerAdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:customer-list|customer-create|customer-edit|customer-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:customer-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:customer-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:customer-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Customer::where('companyId', Auth::user()->companyId)->orderby('id', 'DESC')->get();
        return view('Admin.customer.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.customer.create');
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
            'address1' => 'required',
            // 'number' => 'required|unique:users',
            // 'userStatus' => 'required',
        ]);

        $input = $request->all();
        $bytes = openssl_random_pseudo_bytes(4);
        $pwd = bin2hex($bytes);
        if ($request->password) {
            $input['userStatus'] = "1";
        } else {
            $input['userStatus'] = "2";
        }
        $input['password'] = Hash::make($pwd);
        $input['name'] = ucfirst($input['name']);
        $input['createBy'] = Auth::user()->id;
        $input['companyId'] = Auth::user()->companyId;

        $Customer = Customer::create($input);
        if ($request->password) {
            $userId = $request->email;
            $password = $pwd;
            $this->sendCredentialsEmail($userId, $password);
        }
        return redirect()->route('customer.index')
            ->with('success', 'Customer created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Customer::find($id);
        return view('Admin.customer.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Customer::find($id);
        return view('Admin.customer.edit', compact('user'));
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
            'email' => 'required|email|unique:customers,email,' . $id,
            'userStatus' => 'required',
        ]);

        $input = $request->all();
        $user = Customer::find($id);
        $input['updateBy'] = Auth::user()->id;
        $input['name'] = ucfirst($input['name']);
        $user->update($input);
        return redirect()->route('customer.index')
            ->with('success', 'Customer updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = Customer::find($id);
        $table->delete();
        return redirect()->route('customer.index')
            ->with('success', 'Customer deleted successfully');
    }

    public function sendCredentialsEmail($userId, $password)
    {
        $emailData = [
            'userId' => $userId,
            'password' => $password,
        ];

        Mail::to($userId)->send(new UserCredentialsEmail($emailData));

        return "Credentials email sent successfully!";
    }

    public function customerPasswordReset($id)
    {
        $bytes = openssl_random_pseudo_bytes(4);
        $pwd = bin2hex($bytes);

        $customer = Customer::find($id);
        $customer->password = Hash::make($pwd);
        $customer->userStatus = "1";
        $customer->update();

        $userId = $customer->email;
        $password = $pwd;
        $this->sendCredentialsEmail($userId, $password);

        return redirect()->route('customer.index')
            ->with('success', 'Customer password send successfully');
    }
}

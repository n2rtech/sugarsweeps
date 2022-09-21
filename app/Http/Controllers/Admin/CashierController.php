<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cashier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CashierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter_box     = 'hide';
        $filter_name    = $request->name;
        $filter_email   = $request->email;
        $filter_phone   = $request->phone;
        $filter_status  = $request->status;

        if(isset($filter_name) || isset($filter_email) || isset($filter_phone) || isset($filter_status)){
            $filter_box = 'show';
        }
        $cashiers = Cashier::orderBy('id', 'desc');

        if(isset($filter_name)){
            $cashiers =  $cashiers->where(DB::raw("concat(firstname, ' ', lastname)"), 'LIKE', "%".$filter_name."%");
        }
        if(isset($filter_email)){
            $cashiers =  $cashiers->whereEmail($filter_email);
        }
        if(isset($filter_phone)){
            $cashiers =  $cashiers->where('phone', 'LIKE', "%".$filter_phone."%");
        }
        if(isset($filter_status)){
            $cashiers =  $cashiers->where('status', $filter_status);
        }

        $cashiers = $cashiers->paginate(20);

        return view('admin.cashiers.list', compact('cashiers', 'filter_box', 'filter_name', 'filter_email', 'filter_phone', 'filter_status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cashiers.create');
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
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:cashiers'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $customer               = new Cashier();
        $customer->firstname    = $request->firstname;
        $customer->lastname     = $request->lastname;
        $customer->email        = $request->email;
        $customer->phone        = $request->phone;
        $customer->password     = Hash::make($request->password);
        $customer->status       = isset($request->status) ? 'active' : 'inactive';
        $customer->save();

        return redirect()->route('admin.cashiers.index')->with('success', 'Cashier created successfully.');
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
        $cashier = Cashier::find($id);
        return view('admin.cashiers.edit', compact('cashier'));
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
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:cashiers,email,' . $id],
        ]);

        $customer               = Cashier::find($id);
        $customer->firstname    = $request->firstname;
        $customer->lastname     = $request->lastname;
        $customer->email        = $request->email;
        $customer->phone        = $request->phone;
        $customer->status       = isset($request->status) ? 'active' : 'inactive';
        $customer->save();

        return redirect()->route('admin.cashiers.index')->with('success', 'Cashier updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user     = Cashier::find($id)->delete();
        return redirect()->route('admin.cashiers.index')->with('success', 'Vendor deleted successfully.');
    }

    public function changePasswordForm($id){
        return view('admin.cashiers.change-password', compact('id'));
    }
    public function changePassword(Request $request){
        $this->validate($request,[
            'password' => 'required|confirmed|min:6'
        ]);

        $cashier  = Cashier::find($request->cashier_id);
        $cashier->password = Hash::make($request->password);
        $cashier->save();
        return redirect()->route('admin.cashiers.edit', $request->cashier_id)->with('success', 'Password changed successfully');
    }
}

<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Cashier;
use App\Models\GamingPlatform;
use App\Models\PaymentMethod;
use App\Models\TransactionHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:cashier');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $filter_box         = 'hide';
        $date               = $request->date;
        $name               = $request->name;
        $email              = $request->email;
        $phone              = $request->phone;
        $gaming_platform    = $request->platform;
        $payment_method     = $request->payment_method;
        $request_cashier    = $request->cashier;
        $request_status     = $request->status;
        $period             = $request->period;

        if(isset($date) || isset($name) || isset($email) || isset($phone) || isset($gaming_platform) || isset($amount) || isset($username)|| isset($request_cashier)|| isset($request_status) || isset($period)){
            $filter_box = 'show';
        }


        $histories = TransactionHistory::where('cashier_id', Auth::user()->id);

        if($request->has('id')){
            $histories->where('id', $request->id);
        }

        if(isset($name)){
            $histories->whereHas('user', function ($query) use ($name){
                $query->where(DB::raw("concat(firstname, ' ', lastname)"), 'LIKE', "%".$name."%");
            });
        }

        if(isset($email)){
            $histories->whereHas('user', function ($query) use ($email){
                $query->where('email', $email);
            });
        }

        if(isset($phone)){
            $histories->whereHas('user', function ($query) use ($phone){
                $query->where('phone', $phone);
            });
        }


        if(isset($payment_method)){
            $histories->where('mode', $payment_method);
        }

        if(isset($request_cashier)){
            $histories->where('cashier_id', $request_cashier);
        }

        if(isset($request_status)){
            $histories->where('type', $request_status);
        }

        if(isset($date)){
            $histories->whereDate('created_at', $date);
        }
        $histories  = $histories->latest()->paginate('20');
        $methods    = PaymentMethod::get(['id', 'method']);
        $cashiers   = Cashier::get(['id', 'name']);

        return view('cashier.transaction-history', compact('histories', 'cashiers', 'methods', 'date', 'name', 'email', 'phone', 'payment_method', 'request_cashier', 'request_status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}

<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Cashier;
use App\Models\GamingPlatform;
use App\Models\Notification;
use App\Models\PaymentMethod;
use App\Models\RedeemRequest;
use App\Models\TransactionHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class RedeemRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:cashier');
    }

    public function index(Request $request)
    {
        $filter_box         = 'hide';
        $date               = $request->date;
        $name               = $request->name;
        $email              = $request->email;
        $phone              = $request->phone;
        $gaming_platform    = $request->platform;
        $amount             = $request->amount;
        $username           = $request->username;
        $payment_method     = $request->payment_method;
        $request_cashier    = $request->cashier;
        $request_status     = $request->status;
        $period             = $request->period;

        if(isset($date) || isset($name) || isset($email) || isset($phone) || isset($gaming_platform) || isset($amount) || isset($username)|| isset($request_cashier)|| isset($request_status) || isset($period)){
            $filter_box = 'show';
        }


        $redeem_requests  = RedeemRequest::with('user', 'cashier', 'platform', 'paymentMethod');
        if($request->has('id')){
            $redeem_requests->where('id', $request->id);
        }

        if(isset($name)){
            $redeem_requests->whereHas('user', function ($query) use ($name){
                $query->where(DB::raw("concat(firstname, ' ', lastname)"), 'LIKE', "%".$name."%");
            });
        }

        if(isset($email)){
            $redeem_requests->whereHas('user', function ($query) use ($email){
                $query->where('email', $email);
            });
        }

        if(isset($phone)){
            $redeem_requests->whereHas('user', function ($query) use ($phone){
                $query->where('phone', $phone);
            });
        }

        if(isset($gaming_platform)){
            $redeem_requests->where('platform_id', $gaming_platform);
        }

        if(isset($username)){
            $redeem_requests->where('username', 'LIKE', "%".$username."%");
        }

        if(isset($payment_method)){
            $redeem_requests->where('payment_method_id', $payment_method);
        }

        if(isset($request_cashier)){
            $redeem_requests->where('cashier_id', $request_cashier);
        }

        if(isset($request_status)){
            $redeem_requests->where('status', $request_status);
        }

        if($request->period == 1){
            $redeem_requests->whereDate('action_taken_at', Carbon::today());
        }

        if($request->period == 2){
            $redeem_requests->whereDate('action_taken_at', Carbon::now()->addDay(-1));
        }

        if($request->period == 3){
            $redeem_requests->whereBetween('action_taken_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        }

        if($request->period == 4){
            $redeem_requests->whereMonth('action_taken_at', Carbon::now()->month);
        }

        if(isset($date)){
            $redeem_requests->whereDate('action_taken_at', Carbon::parse($date)->format('Y-m-d'));
        }

        $redeem_requests = $redeem_requests->orderBy('id', 'desc')->paginate(20);

        $platforms = GamingPlatform::get(['id', 'platform']);
        $methods = PaymentMethod::get(['id', 'method']);
        $cashiers = Cashier::get(['id', 'firstname', 'lastname']);
        return view('cashier.redeem-requests.list', compact('filter_box', 'redeem_requests', 'platforms', 'methods', 'date', 'name', 'email', 'phone', 'gaming_platform',  'period', 'username', 'payment_method', 'request_cashier', 'request_status', 'cashiers'));
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
        $request = RedeemRequest::find($id);

        // if($request->payment_method_id == 1){
        //     $response = Http::post('https://api.nowpayments.io/v1/auth', [
        //         'email'                => 'stakesdragon7@gmail.com',
        //         'password'             => 'Dragon@Stakes7'

        //     ]);

        //     $token = $response['token'];

            // $payment = Http::withHeaders([
            //     'x-api-key'                 => '9KCBP26-9XF4MG6-PJR8FXM-MY1XC19',
            //     'Content-Type'              => 'application/json',
            //     'Authorization'             => 'Bearer '.$token,
            // ])->post('https://api.nowpayments.io/v1/payout', [
            //     'address'                => $request->bitcoin_address,
            //     'currency'               => 'USD',
            //     'amount'                 =>  $request->amount,
            //     'ipn_callback_url'       => 'https://nowpayments.io'
            // ]);

            // return $payment;
        //     return view('cashier.redeem-requests.verify', compact('request', 'token'));
        // }

        $request->cashier_id            = Auth::user()->id;
        $request->status = '1';
        $request->save();

        // Generate Notification

        $notification                       = new Notification;
        $notification->type                 = 'redeem-done';
        $notification->sender               = 'cashier';
        $notification->sender_id            = Auth::user()->id;
        $notification->receiver_id          = $request->user_id;
        $notification->redeem_request_id    = $id;
        $notification->save();

        // Generate Transaction

        $transaction                       = new TransactionHistory;
        $transaction->type                 = 'redeemed';
        $transaction->user_id              = $request->user_id;
        $transaction->cashier_id           = $request->cashier_id;
        $transaction->amount               = $request->amount;
        $transaction->mode                 = PaymentMethod::find($request->payment_method_id)->method;
        $transaction->request_id           = $id;
        $transaction->save();

        return redirect()->back()->with('success', 'Redeem Request accepted successfully.');

    }

    public function verifyRequest(Request $request, $id){

        $this->validate($request, [
            'verification_code' => 'required',
        ]);

        // $verify = Http::withHeaders([
        //         'x-api-key'                 => '9KCBP26-9XF4MG6-PJR8FXM-MY1XC19',
        //         'Content-Type'              => 'application/json',
        //         'Authorization'             => 'Bearer '.$request->token,
        //     ])->post('https://api.nowpayments.io/v1/payout/'.$request->batch_withdrawal_id.'/verify', [
        //         'verification_code'                => $request->verification_code,
        //     ]);

        //     return $verify;

        $request = RedeemRequest::find($id);
        $request->cashier_id            = Auth::user()->id;
        $request->status = '1';
        $request->save();

        // Generate Notification

        $notification                       = new Notification;
        $notification->type                 = 'redeem-done';
        $notification->sender               = 'cashier';
        $notification->sender_id            = Auth::user()->id;
        $notification->receiver_id          = $request->user_id;
        $notification->redeem_request_id    = $id;
        $notification->save();

        // Generate Transaction

        $transaction                       = new TransactionHistory;
        $transaction->type                 = 'redeemed';
        $transaction->user_id              = $request->user_id;
        $transaction->cashier_id           = $request->cashier_id;
        $transaction->amount               = $request->amount;
        $transaction->mode                 = PaymentMethod::find($request->payment_method_id)->method;
        $transaction->request_id           = $id;
        $transaction->save();

        return redirect()->route('cashier.redeem-requests.index')->with('success', 'Redeem Request processed successfully.');
    }

    public function redeemFull(Request $request){
        $redeem_request = RedeemRequest::find($request->redeemid);
        $redeem_request->status = '1';
        $redeem_request->amount = $request->amount;
        $redeem_request->save();

        // Generate Notification

        $notification                       = new Notification;
        $notification->type                 = 'redeem-done';
        $notification->sender               = 'cashier';
        $notification->sender_id            = Auth::user()->id;
        $notification->receiver_id          = $redeem_request->user_id;
        $notification->redeem_request_id    = $request->redeemid;
        $notification->save();

        // Generate Transaction

        $transaction                       = new TransactionHistory;
        $transaction->type                 = 'redeemed';
        $transaction->user_id              = $redeem_request->user_id;
        $transaction->cashier_id           = $redeem_request->cashier_id;
        $transaction->amount               = $request->amount;
        $transaction->mode                 = PaymentMethod::find($redeem_request->payment_method_id)->method;
        $transaction->request_id           = $redeem_request->id;
        $transaction->save();
        return redirect()->back()->with('success', 'Redeem Request accepted successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $request = RedeemRequest::find($id);
        $request->cashier_id            = Auth::user()->id;
        $request->status = '2';
        $request->save();

        // Generate Notification

        $notification                       = new Notification;
        $notification->type                 = 'redeem-rejected';
        $notification->sender               = 'cashier';
        $notification->sender_id            = Auth::user()->id;
        $notification->receiver_id          = $request->user_id;
        $notification->redeem_request_id    = $id;
        $notification->save();

        return redirect()->back()->with('success', 'Redeem Request rejected successfully.');
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

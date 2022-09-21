<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Cashier;
use App\Models\CreditRequest;
use App\Models\GamingPlatform;
use App\Models\Notification;
use App\Models\PaymentMethod;
use App\Models\TransactionHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreditRequestController extends Controller
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
        $filter_name        = $request->filter_name;
        $filter_email       = $request->filter_email;
        $filter_phone       = $request->filter_phone;
        $filter_cashier     = $request->filter_cashier;
        $filter_platform    = $request->filter_platform;
        $filter_status      = $request->filter_status;
        $requests           = CreditRequest::with('user', 'cashier', 'platform')->orderBy('id', 'desc');
        if(isset($filter_name) || isset($filter_email) || isset($filter_phone) || isset($filter_cashier) || isset($filter_platform) || isset($filter_status)){
            $filter_box = 'show';
        }

        if (isset($filter_name)) {
            $requests = $requests->whereHas('user', function ($q) use ($filter_name) {
                $q->where(function ($q) use ($filter_name) {
                    $q->where(DB::raw("concat(firstname, ' ', lastname)"), 'LIKE', "%".$filter_name."%");
                });
            });
        }

        if (isset($filter_phone)) {
            $requests = $requests->whereHas('user', function ($q) use ($filter_phone) {
                $q->where(function ($q) use ($filter_phone) {
                    $q->where('phone', $filter_phone);
                });
            });
        }

        if(isset($filter_cashier)){
            $requests =  $requests->where('cashier_id', $filter_cashier);
        }

        if(isset($filter_platform)){
            $requests =  $requests->where('platform_id', $filter_platform);
        }

        if(isset($filter_status)){
            $requests =  $requests->where('status', $filter_status);
        }

        $requests           = $requests->paginate(20);
        $cashiers           = Cashier::get(['id', 'firstname', 'lastname']);
        $platforms          = GamingPlatform::get(['id', 'platform']);

        return view('cashier.deposit-requests.list', compact('requests', 'filter_name', 'filter_phone', 'filter_cashier', 'filter_platform', 'filter_status', 'filter_box', 'cashiers', 'platforms'));
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
        $request                        = CreditRequest::find($id);
        $request->cashier_id            = Auth::user()->id;
        $request->action_taken_at       = now();
        $request->status                = '1';
        $request->save();

        // Generate Notification

        $notification                       = new Notification();
        $notification->type                 = 'credit-added';
        $notification->sender               = 'cashier';
        $notification->sender_id            = Auth::user()->id;
        $notification->receiver_id          = $request->user_id;
        $notification->credit_request_id    = $id;
        $notification->save();

         //  Generate Transaction

         $transaction                       = new TransactionHistory();
         $transaction->type                 = 'purchased';
         $transaction->user_id              = $request->user_id;
         $transaction->cashier_id           = $request->cashier_id;
         $transaction->amount               = $request->amount;
         $transaction->mode                 = PaymentMethod::find($request->payment_method_id)->method;
         $transaction->request_id           = $id;
         $transaction->save();

        return redirect()->back()->with('success', 'Deposit Request accepted successfully.');
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

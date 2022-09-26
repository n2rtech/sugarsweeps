<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\CreditRequest;
use App\Models\GamingAccount;
use App\Models\GamingPlatform;
use App\Models\Notification;
use App\Models\RedeemRequest;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:cashier');
    }

    public function index()
    {
        Notification::where('seen', 'no')->update(['seen' => 'yes']);
        $notifications      = Notification::orderBy('id', 'desc')->where('receiver_id', 0)->orderBy('id', 'desc')->paginate(20);
        foreach($notifications as $notification){

            $notification->user = User::find($notification->sender_id);

            if($notification->type == 'request-account'){
                $notification->data = GamingAccount::find($notification->gaming_account_id)->load('platform');
            }

            if($notification->type == 'credit-requested'){
                $notification->data = CreditRequest::find($notification->credit_request_id)->load('platform');
            }

            if($notification->type == 'redeem-request'){
                $notification->data = RedeemRequest::find($notification->redeem_request_id)->load('platform');
            }

        }
        return view('cashier.notification-center.list', compact('notifications'));
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

    public function checkNotification(){

        $count      = Notification::where('seen', 'no')->count();

        return $count;

    }
}

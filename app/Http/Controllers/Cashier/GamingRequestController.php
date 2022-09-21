<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\GamingAccount;
use App\Models\GamingPlatform;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GamingRequestController extends Controller
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
        $filter_name        = $request->name;
        $filter_date        = $request->date;
        $filter_username    = $request->username;
        $filter_status      = $request->status;
        $filter_game        = $request->game;
        $requests           = GamingAccount::with('user', 'platform', 'cashier');

        if(isset($filter_name) || isset($filter_date) || isset($filter_username) || isset($filter_status) || isset($filter_game)){
            $filter_box = 'show';
        }

        if(isset($filter_name)){
            $requests->whereHas('user', function ($q) use ($filter_name) {
                $q->where(function ($q) use ($filter_name) {
                    $q->where(DB::raw("concat(firstname, ' ', lastname)"), 'LIKE', "%".$filter_name."%");
                });
            });
        }

        if(isset($filter_date)){
            $requests =  $requests->whereDate('created_at', $filter_date);
        }

        if(isset($filter_username)){
            $requests =  $requests->where('username', 'LIKE', "%".$filter_username."%");
        }

        if(isset($filter_game)){
            $requests =  $requests->where('platform_id', $filter_game);
        }

        if(isset($filter_status)){
            $requests =  $requests->where('status', $filter_status);
        }

        $platforms          = GamingPlatform::get(['id', 'platform']);
        $requests           = $requests->orderBy('id', 'desc')->paginate(20);

        return view('cashier.gaming-requests.list', compact('requests', 'filter_box', 'filter_name', 'filter_date', 'filter_username', 'filter_status', 'filter_game', 'platforms'));
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
        $request        = GamingAccount::where('id', $id)->with('user', 'platform', 'cashier')->first();
        $other_requests = GamingAccount::where('user_id', $request->user_id)->get()->except($id);
        return view('cashier.gaming-requests.edit', compact('request', 'other_requests'));
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
        $rules = [
            'username'          => 'required',
            'password'          => 'required',
        ];

        $messages = [
            'username.required'             => "Please enter game username.",
            'password.required'             => "Please enter game password.",
        ];


        $this->validate($request, $rules, $messages);

        $gaming_account_exists = GamingAccount::where('id', $id)->exists();

        if($gaming_account_exists){
            $account           = GamingAccount::find($id);

            $username_exists   = GamingAccount::where('platform_id', $account->platform_id)->where('username', $request->username)->exists();

            if($username_exists){
                return redirect()->back()->withInput()->with('error', 'This username is already taken.');
            }else{
                $account->username = $request->username;
                $account->password = $request->password;
                $account->status   = '1';
                $account->cashier_id = Auth::user()->id;
                $account->save();

                $notification_exists = Notification::where('type', 'account_created')->where('receiver_id', $account->user_id)->where('gaming_account_id', $id)->exists();

                if(!$notification_exists){
                    $notification                       = new Notification();
                    $notification->type                 = 'account-created';
                    $notification->sender               = 'cashier';
                    $notification->sender_id            = Auth::user()->id;
                    $notification->receiver_id          = $account->user_id;
                    $notification->gaming_account_id    = $id;
                    $notification->save();
                }

            }


            return redirect()->route('cashier.gaming-requests.index')->with('success', 'Player Account Created successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        GamingAccount::find($id)->delete();
        return redirect()->route('cashier.gaming-requests.index')->with('success', 'Request deleted successfully');
    }
}

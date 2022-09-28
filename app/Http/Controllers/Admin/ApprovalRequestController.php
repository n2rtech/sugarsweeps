<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GamingAccount;
use App\Models\GamingPackage;
use App\Models\GamingPlatform;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ApprovalRequestController extends Controller
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
        $filter_date    = $request->date;
        $filter_username = $request->username;

        if(isset($filter_name) || isset($filter_email) || isset($filter_phone) || isset($filter_date) || isset($filter_username)){
            $filter_box = 'show';
        }
        $players = User::whereIn('approved', ['0', '1'])->orderBy('id', 'desc');

        if(isset($filter_name)){
            $players =  $players->where('name', 'LIKE', "%".$filter_name."%");
        }
        if(isset($filter_email)){
            $players =  $players->whereEmail($filter_email);
        }
        if(isset($filter_phone)){
            $players =  $players->where('phone', 'LIKE', "%".$filter_phone."%");
        }
        if(isset($filter_date)){

            $players =  $players->whereDate('created_at', $filter_date);

        }
        if(isset($filter_username)){
            $players->whereHas('gamingAccount', function ($q) use ($filter_username) {
                $q->where(function ($q) use ($filter_username) {
                    $q->where('username', 'LIKE', '%' . $filter_username . '%');
                });
            });
        }

        $players = $players->paginate(20);

        return view('admin.approval-requests.list', compact('players', 'filter_box', 'filter_name', 'filter_email', 'filter_phone', 'filter_date', 'filter_username'));
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
        $player = User::find($id);
        $player->photo_id = isset($player->photo_id) ? asset('storage/uploads/users/'.$player->photo_id) : 'https://via.placeholder.com/260x160.png?text=260+x+160+px' ;

        return view('admin.approval-requests.show', compact('player'));
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

    public function approve($id)
    {
        $player              = User::find($id);
        $player->approved    = '2';
        $player->save();

        $notification                       = new Notification();
        $notification->type                 = 'account-approved';
        $notification->sender               = 'admin';
        $notification->sender_id            = Auth::guard('admin')->user()->id;
        $notification->receiver_id          = $id;
        $notification->save();

        $package                        = GamingPackage::where('status', 0)->whereNull('user_id')->first();
        GamingPackage::where('id', $package->id)->update(['status' => 1, 'user_id' => $id]);

        $platforms                      = GamingPlatform::get(['id', 'platform']);

        foreach($platforms as $platform){

            $account                    = new GamingAccount();
            $account->user_id           = $id;
            $account->platform_id       = $platform->id;
            $account->status            = '1';
            $account->username          = GamingPackage::where('id', $package->id)->value(Str::lower(str_replace(' ', '', $platform->platform)));
            $account->password          = $package->password;
            $account->action_taken_at   = now();
            $account->save();

            $notification_exists = Notification::where('type', 'account_created')->where('receiver_id', $id)->where('gaming_account_id', $account->id)->exists();

                if(!$notification_exists){
                    $notification                       = new Notification();
                    $notification->type                 = 'account-created';
                    $notification->sender               = 'admin';
                    $notification->sender_id            = Auth::guard('admin')->user()->id;
                    $notification->receiver_id          = $id;
                    $notification->gaming_account_id    = $account->id;
                    $notification->save();
                }

        }

        $to_name        =  $player->name;
        $to_email       =  $player->email;
        $data_email     =  array("name"=> $player->name);

        Mail::send("frontend.emails.approved", $data_email, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
            ->subject("Review Completed! Greetings from Sugarsweeps");
            $message->from("websales9999@gmail.com","Sugarsweeps");
        });


        return redirect()->route('admin.approval-requests.index')->with('success', 'Player Account has been approved successfully');
    }

    public function reject($id)
    {
        $player             = User::find($id);
        $player->approved   = '3';
        $player->save();

        $to_name        =  $player->name;
        $to_email       =  $player->email;
        $data_email     =  array("name"=> $player->name);

        Mail::send("frontend.emails.rejected", $data_email, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
            ->subject("Review Completed! Greetings from Sugarsweeps");
            $message->from("websales9999@gmail.com","Sugarsweeps");
        });

        return redirect()->route('admin.approval-requests.index')->with('error', 'Player Account has been rejected successfully');
    }
}

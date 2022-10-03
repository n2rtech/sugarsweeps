<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BulkEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BulkEmailController extends Controller
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
    public function index()
    {
        $emails = BulkEmail::orderBy('id', 'desc')->paginate(10);
        return view('admin.bulk-emails.list', compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $players = User::where('approved', '2')->get();
        return view('admin.bulk-emails.create', compact('players'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'message' => 'required',
        ]);

        $bulk_email             = new BulkEmail();
        $bulk_email->message    = $request->message;
        $bulk_email->value      = $request->player;
        $bulk_email->save();



        if(isset($request->player)){
            $player = User::where('id', $request->player)->first();

            $to_name    =  $player->name;
            $to_email   =  $player->email;
            $data_email = array("name"=> $player->name, "messag" => $request->message);

            Mail::send("frontend.emails.bulk-email", $data_email, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                ->subject("New Message from Sugarsweeps");
                $message->from("websales9999@gmail.com","Sugarsweeps");
            });

        }else{
            $players = User::where('approved', '2')->get();
            foreach($players as $player){
                $to_name    =  $player->name;
                $to_email   =  $player->email;
                $data_email = array("name"=> $player->name, "messag" => $request->message);

                Mail::send("frontend.emails.bulk-email", $data_email, function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)
                    ->subject("New Message from Sugarsweeps");
                    $message->from("stakesdragon7@gmail.com","Sugarsweeps");
                });
            }
        }
        return redirect()->route('admin.bulk-emails.index')->with('success', 'Email has been sent successfully!');
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

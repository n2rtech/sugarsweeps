<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PlayerController extends Controller
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
        $filter_username = $request->username;

        if(isset($filter_name) || isset($filter_email) || isset($filter_phone) || isset($filter_status) || isset($filter_username)){
            $filter_box = 'show';
        }
        $players = User::orderBy('id', 'desc');

        if(isset($filter_name)){
            $players =  $players->where('name', 'LIKE', "%".$filter_name."%");
        }
        if(isset($filter_email)){
            $players =  $players->whereEmail($filter_email);
        }
        if(isset($filter_phone)){
            $players =  $players->where('phone', 'LIKE', "%".$filter_phone."%");
        }
        if(isset($filter_status)){
            if($filter_status == '1' || $filter_status == '0'){
                $players =  $players->whereIn('approved', ['0', '1']);
            }else{
                $players =  $players->where('approved', $filter_status);
            }

        }
        if(isset($filter_username)){
            $players->whereHas('gamingAccount', function ($q) use ($filter_username) {
                $q->where(function ($q) use ($filter_username) {
                    $q->where('username', 'LIKE', '%' . $filter_username . '%');
                });
            });
        }

        $players = $players->paginate(20);

        return view('admin.players.list', compact('players', 'filter_box', 'filter_name', 'filter_email', 'filter_phone', 'filter_status', 'filter_username'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.players.create');
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
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $player               = new User;
        $player->name         = $request->name;
        $player->email        = $request->email;
        $player->phone        = $request->phone;
        $player->password     = Hash::make($request->password);
        $player->approved     = $request->approved;
        $player->save();

        return redirect()->route('admin.players.index')->with('success', 'Player created successfully.');
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
        $player = User::find($id);
        $player->photo_id = isset($player->photo_id) ? asset('storage/uploads/users/'.$player->photo_id) : 'https://via.placeholder.com/260x160.png?text=260+x+160+px' ;

        return view('admin.players.edit', compact('player'));
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
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
        ]);

        $player               = User::find($id);
        $player->name         = $request->name;
        $player->email        = $request->email;
        $player->phone        = $request->phone;
        $player->approved     = $request->approved;
        $player->save();

        return redirect()->route('admin.players.index')->with('success', 'Player updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user     = User::find($id)->delete();
        return redirect()->route('admin.players.index')->with('success', 'Player deleted successfully.');
    }

    public function changePasswordForm($id){
        return view('admin.players.change-password', compact('id'));
    }

    public function changePassword(Request $request){
        $this->validate($request,[
            'password' => 'required|confirmed'
        ]);

        $player           = User::find($request->player_id);
        $player->password = Hash::make($request->password);
        $player->save();
        return redirect()->route('admin.players.edit', $request->player_id)->with('success', 'Password changed successfully');
    }
}

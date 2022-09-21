<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PlayerController extends Controller
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
        $filter_box     = 'hide';
        $filter_name    = $request->name;
        $filter_email   = $request->email;
        $filter_phone   = $request->phone;
        $filter_status  = $request->status;
        $filter_username = $request->username;

        if(isset($filter_name) || isset($filter_email) || isset($filter_phone) || isset($filter_status)){
            $filter_box = 'show';
        }
        $players = User::orderBy('id', 'desc');

        if(isset($filter_name)){
            $players =  $players->where(DB::raw("concat(firstname, ' ', lastname)"), 'LIKE', "%".$filter_name."%");
        }
        if(isset($filter_email)){
            $players =  $players->whereEmail($filter_email);
        }
        if(isset($filter_phone)){
            $players =  $players->where('phone', 'LIKE', "%".$filter_phone."%");
        }
        if(isset($filter_status)){
            $players =  $players->where('status', $filter_status);
        }
        if(isset($filter_username)){
            $players->whereHas('gamingAccount', function ($q) use ($filter_username) {
                $q->where(function ($q) use ($filter_username) {
                    $q->where('username', 'LIKE', '%' . $filter_username . '%');
                });
            });
        }

        $players = $players->paginate(20);

        return view('cashier.players.list', compact('players', 'filter_box', 'filter_name', 'filter_email', 'filter_phone', 'filter_status', 'filter_username'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cashier.players.create');
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $player               = new User;
        $player->firstname    = $request->firstname;
        $player->lastname     = $request->lastname;
        $player->email        = $request->email;
        $player->phone        = $request->phone;
        $player->password     = Hash::make($request->password);
        $player->status       = isset($request->status) ? 'active' : 'inactive';
        $player->save();

        return redirect()->route('cashier.players.index')->with('success', 'Player created successfully.');
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
        return view('cashier.players.show', compact('player'));
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
        $this->validate($request, [
            'firstname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
        ]);

        $player               = User::find($id);
        $player->firstname    = $request->firstname;
        $player->lastname     = $request->lastname;
        $player->email        = $request->email;
        $player->phone        = $request->phone;
        $player->status       = isset($request->status) ? 'active' : 'inactive';
        $player->save();

        return redirect()->route('cashier.players.index')->with('success', 'Player updated successfully.');
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
        return redirect()->route('cashier.players.index')->with('success', 'Player deleted successfully.');
    }
}

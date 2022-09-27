<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApprovalRequestController extends Controller
{
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

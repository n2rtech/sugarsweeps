<?php

namespace App\Http\Controllers\Cashier\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cashier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class MyAccountController extends Controller
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
    public function index()
    {
        //
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
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Cashier $cashier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Cashier $cashier)
    {
        $id = Auth::guard('cashier')->id();
        $cashier = Cashier::find($id);
        $cashier->avatar = isset($cashier->avatar) ? asset('storage/uploads/cashier/'.$cashier->avatar) : URL::to('assets/img/profile-picture.jpg') ;
        return view('cashier.auth.my-account', compact('cashier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
        ]);

        $cashier = Cashier::find($id);
        $cashier->name = $request->name;
        $cashier->email = $request->email;
        $cashier->phone = $request->phone;

        if($request->hasfile('avatar')){

            $image = $request->file('avatar');

            $name = $image->getClientOriginalName();

            $image->storeAs('uploads/cashier/', $name, 'public');

            if(isset($cashier->avatar)){

                $path = 'public/uploads/cashier/'.$cashier->avatar;

                Storage::delete($path);

            }

            $cashier->avatar = $name;

        }

        $cashier->save();

        return redirect()->route('cashier.my-account.edit', $cashier->id)->with('success', 'Account updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cashier $cashier)
    {
        //
    }
}

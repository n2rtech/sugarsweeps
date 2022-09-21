<?php

namespace App\Http\Controllers\Cashier\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cashier;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:cashier');
    }

    public function showRegisterForm()
    {
        return view('cashier.auth.register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [

            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:vendors'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone'    => ['required', 'min:10', 'unique:vendors'],

        ]);

        $cashier = new Cashier();
        $cashier->name = $request->name;
        $cashier->email = $request->email;
        $cashier->phone = $request->phone;
        $cashier->password = Hash::make("password");
        $cashier->save();

        Auth::guard('cashier')->login($cashier);

        return redirect()->intended(route('cashier.dashboard'));


    }
}

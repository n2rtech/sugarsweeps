<?php

namespace App\Http\Controllers\Cashier\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Cashier;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:cashier');
    }

    public function changePasswordForm()
    {
        $id = Auth::guard('cashier')->id();
        $user = Cashier::find($id);
        return view('cashier.settings.change-password', compact('user'));
    }

    public function changePassword(Request $request)
    {
        $id = Auth::guard('cashier')->id();

        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',

        ]);

        $user = Cashier::find($id);

        if (Hash::check($request->get('current_password'), $user->password)) {

            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('cashier.password.form')->with('success', 'Password changed successfully!');

        } else {

            return redirect()->back()->with('error', 'Current password is incorrect');
        }

        return redirect()->route('cashier.password.form')->with('success', 'Password changed successfully');
    }

}

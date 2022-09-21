<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use App\Models\Admin;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function changePasswordForm()
    {
        $id = Auth::guard('admin')->id();
        $user = Admin::find($id);
        return view('admin.auth.change-password', compact('user'));
    }

    public function changePassword(Request $request)
    {
        $id = Auth::guard('admin')->id();

        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',

        ]);

        $user = Admin::find($id);

        if (Hash::check($request->get('current_password'), $user->password)) {

            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('admin.password.form')->with('success', 'Password changed successfully!');

        } else {

            return redirect()->back()->with('error', 'Current password is incorrect');
        }

        return redirect()->route('admin.password.form')->with('success', 'Password changed successfully');
    }

}

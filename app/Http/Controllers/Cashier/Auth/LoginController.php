<?php

namespace App\Http\Controllers\Cashier\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cashier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:cashier')->except('logout');
    }

    public function showLoginForm()
    {
        return view('cashier.auth.login');
    }

    public function login(Request $request)
    {
        // Validate form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $cashier = Cashier::where($this->username(), '=', $request->input($this->username()))->first();

        if ($cashier && $cashier->status == 'inactive') {
            throw ValidationException::withMessages([$this->username() => __('The account is Inactive. Please Contact Administrator')]);
        }

        // Attempt to log the user in
        if(Auth::guard('cashier')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember))
        {
            return redirect()->intended(route('cashier.dashboard'));

        }else{

         return $this->sendFailedLoginResponse($request);
     }

 }

    public function logout(Request $request)
    {

        Auth::guard('cashier')->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect()->route( 'cashier.login' );
    }
}

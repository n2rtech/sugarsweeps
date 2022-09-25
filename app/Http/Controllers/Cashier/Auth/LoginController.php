<?php

namespace App\Http\Controllers\Cashier\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cashier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

        // Attempt to log the user in
        if(Auth::guard('cashier')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember))
        {
            return redirect()->intended(route('cashier.dashboard'));

        }else{

           return $this->sendFailedLoginResponse($request);
       }

   }

   /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {

        if(Auth::guard('cashier')->check()) // this means that the admin was logged in.
        {
            Auth::guard('cashier')->logout();
            return redirect()->route('cashier.login');
        }
    }
}

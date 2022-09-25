<?php

namespace App\Http\Controllers\Cashier\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForgotPasswordController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /*
     * Only guests for "superadmin" guard are allowed except
     * for logout.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest:cashier');
    }

    public function showLinkRequestForm()
    {
        return view('cashier.auth.passwords.email');
    }

    protected function broker()
    {
        return Password::broker('cashiers');
    }

    public function guard()
    {
        return Auth::guard('cashier');
    }

}

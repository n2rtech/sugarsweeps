<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\CreditRequest;
use App\Models\RedeemRequest;
use App\Models\User;

class DashboardController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:cashier');
    }

    public function index()
    {
        $total_players              = User::count();
        $total_approval_requests    = User::whereIn('approved', ['0', '1'])->count();
        $total_credit_requests      = CreditRequest::count();
        $total_redeem_requests      = RedeemRequest::count();
        $players                    = User::orderBy('id', 'desc')->take(5)->get();
        $approval_requests          = User::whereIn('approved', ['0', '1'])->orderBy('id', 'desc')->take(5)->get();
        $deposit_requests           = CreditRequest::orderBy('id', 'desc')->take(5)->get();
        $redeem_requests            = RedeemRequest::orderBy('id', 'desc')->take(5)->get();
        return view('cashier.dashboard', compact('total_players', 'total_approval_requests', 'total_credit_requests','total_redeem_requests', 'players', 'approval_requests', 'deposit_requests', 'redeem_requests'));
    }
}

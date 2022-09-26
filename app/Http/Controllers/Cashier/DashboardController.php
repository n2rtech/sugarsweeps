<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Cashier;
use App\Models\CreditRequest;
use App\Models\GamingAccount;
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
        $total_cashiers             = Cashier::count();
        $total_gaming_requests      = GamingAccount::count();
        $total_redeem_requests      = RedeemRequest::count();
        $players                    = User::latest()->take(5)->get();
        $gaming_requests            = GamingAccount::latest()->take(5)->get();
        $total_deposit_requests     = CreditRequest::latest()->take(5)->get();
        $redeem_requests            = RedeemRequest::latest()->take(5)->get();
        return view('cashier.dashboard', compact('total_players', 'total_deposit_requests','total_cashiers', 'total_gaming_requests','total_redeem_requests', 'players', 'gaming_requests', 'redeem_requests'));
    }
}

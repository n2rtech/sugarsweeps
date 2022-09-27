<?php

namespace App\Http\Controllers;

use App\Models\GamingAccount;
use App\Models\GamingPlatform;
use App\Models\PaymentMethod;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware(['approved']);
    }

    public function index(){
        $platforms = GamingPlatform::get();
        foreach($platforms as $platform){
            $platform->image = isset($platform->image) ? asset('storage/uploads/gaming-platforms/' . $platform->image) : asset('assets/img/game-placeholder.jpg') ;
        }
        $cashapp = Setting::where('type', 'cashapp')->value('value');
        $methods = PaymentMethod::where('status', '1')->get();
        return view('frontend.home', compact('platforms', 'cashapp', 'methods'));
    }

    public function terms(){
        return view('frontend.terms-and-conditions');
    }

    public function privacyPolicy(){
        return view('frontend.privacy-policy');
    }

    public function settings(){
        $id     = Auth::user()->id;
        $user   = User::find($id);
        return view('frontend.settings', compact('user'));
    }

    public function transactions(){
        return view('frontend.transactions');
    }

    public function notifications(){
        return view('frontend.notifications');
    }

    public function populate(Request $request)
    {
        $id = Auth::user()->id;
        $username = GamingAccount::where('user_id', $id)->where('platform_id', $request->platform_id)->value('username');
        return response()->json(['success' => $username]);
    }
}

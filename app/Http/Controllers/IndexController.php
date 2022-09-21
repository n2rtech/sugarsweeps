<?php

namespace App\Http\Controllers;

use App\Models\GamingPlatform;
use App\Models\PaymentMethod;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        $platforms = GamingPlatform::get();
        foreach($platforms as $platform){
            $platform->image = isset($platform->image) ? asset('storage/uploads/gaming-platforms/' . $platform->image) : asset('assets/img/game-placeholder.jpg') ;
        }
        $cashapp = Setting::where('type', 'cashapp')->value('value');
        $methods = PaymentMethod::where('status', '1')->get();
        return view('frontend.welcome', compact('platforms', 'cashapp', 'methods'));
    }

    public function setting()
    {
        $user = User::find(Auth::user()->id);
        return view('frontend.setting', compact('user'));
    }

    public function privacyPolicy()
    {
        $privacy = Setting::where('type', 'privacy-policy')->value('value');
        return view('frontend.privacy-policy', compact('privacy'));
    }

    public function termsAndCondition()
    {
        $terms = Setting::where('type', 'terms-and-conditions')->value('value');
        return view('frontend.terms-and-condition', compact('terms'));
    }
}

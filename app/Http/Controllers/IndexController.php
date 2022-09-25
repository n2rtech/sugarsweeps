<?php

namespace App\Http\Controllers;

use App\Models\GamingPlatform;
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
        return view('frontend.home', compact('platforms'));
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
}

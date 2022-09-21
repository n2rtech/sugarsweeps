<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class CashAppController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function setting(){
        $cashapp = Setting::where('type', 'cashapp')->value('value');
        return view('admin.settings.cashapp', compact('cashapp'));
    }

    public function saveSetting(Request $request){
        $rules = [
            'cashapp'                   =>  'required',
        ];

        $messages = [
            'cashapp.required'          => 'Please enter Cash App Link',
        ];

        $this->validate($request, $rules, $messages);

        $setting_exists = Setting::where('type', 'cashapp')->exists();
        if($setting_exists){

            Setting::where('type', 'cashapp')->update(['value' => $request->all()]);

        }else{

            $setting = new Setting();
            $setting->type = 'cashapp';
            $setting->value = $request->all();
            $setting->save();

        }

        return redirect()->back()->with('success', 'Cash App Link updated successfully');
    }

    public function privacySetting(){
        $privacy = Setting::where('type', 'privacy-policy')->value('value');
        return view('admin.settings.privacy', compact('privacy'));
    }

    public function savePrivacySetting(Request $request){
        $rules = [
            'content'                   =>  'required',
        ];

        $messages = [
            'content.required'          => 'Please enter Page Content',
        ];

        $this->validate($request, $rules, $messages);

        $setting_exists = Setting::where('type', 'privacy-policy')->exists();
        if($setting_exists){

            Setting::where('type', 'privacy-policy')->update(['value' => $request->all()]);

        }else{

            $setting = new Setting();
            $setting->type = 'privacy-policy';
            $setting->value = $request->all();
            $setting->save();

        }

        return redirect()->back()->with('success', 'Page Content updated successfully');
    }

    public function termSetting(){
        $terms = Setting::where('type', 'terms-and-conditions')->value('value');
        return view('admin.settings.terms', compact('terms'));
    }

    public function saveTermSetting(Request $request){
        $rules = [
            'content'                   =>  'required',
        ];

        $messages = [
            'content.required'          => 'Please enter Page Content',
        ];

        $this->validate($request, $rules, $messages);

        $setting_exists = Setting::where('type', 'terms-and-conditions')->exists();
        if($setting_exists){

            Setting::where('type', 'terms-and-conditions')->update(['value' => $request->all()]);

        }else{

            $setting = new Setting();
            $setting->type = 'terms-and-conditions';
            $setting->value = $request->all();
            $setting->save();

        }

        return redirect()->back()->with('success', 'Page Content updated successfully');
    }
}

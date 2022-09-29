<?php

namespace App\Http\Controllers;

use App\Models\CreditRequest;
use App\Models\GamingAccount;
use App\Models\GamingPlatform;
use App\Models\Notification;
use App\Models\PaymentMethod;
use App\Models\RedeemRequest;
use App\Models\Setting;
use App\Models\TransactionHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

    public function createPayment(Request $request){

        $id = Auth::user()->id;


        $rules = [
            'platform'          => 'required',
            'bitcoin_username'  => 'required',
            'credit'            => 'required',
            'method'            => 'required',
            'currency'          => 'required',
        ];

        $messages = [
            'platform.required'             => "Please select your gaming platform.",
            'bitcoin_username.required'     => "Please enter your gaming platform username.",
            'credit.required'               => "Please enter the amount to buy.",
            'method.required'               => "Please select the payment method.",
            'currency.required'             => "Please select any one crypto currency.",
        ];

        $this->validate($request, $rules, $messages);

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.nowpayments.io/v1/payment',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
            "price_amount": '.$request->credit.',
            "price_currency": "usd",
            "pay_currency": "'.$request->currency.'",
            "ipn_callback_url": "https://nowpayments.io"
        }',
          CURLOPT_HTTPHEADER => array(
            'x-api-key: 9KCBP26-9XF4MG6-PJR8FXM-MY1XC19',
            'Content-Type: application/json'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $result = json_decode($response, true);

        $data = $request->all();

        if (array_key_exists("pay_address", $result))
        {
            return view('frontend.payment', compact('data', 'result'));
        }
        else
        {
            return redirect()->back()->withInput();
        }

    }

    public function requestCredits(Request $request){

        $id = Auth::user()->id;

        $account_exists = GamingAccount::where('user_id', $id)
                                       ->where('platform_id', $request->platform)
                                       ->where('status', '1')->exists();

        if($account_exists){

            $credit                     = new CreditRequest();
            $credit->user_id            = $id;
            $credit->platform_id        = $request->platform;
            $credit->amount             = $request->credit;
            $credit->payment_method_id  = $request->method;
            $credit->currency           = $request->currency;
            $credit->username           = $request->username;
            $credit->save();

            // Generate Notification
            $notification_exists =  Notification::where('type', 'credit-requested')->where('sender', 'player')->where('sender_id', $id)->where('credit_request_id', $credit->id)->exists();
            if(!$notification_exists){
                $notification                       = new Notification();
                $notification->type                 = 'credit-requested';
                $notification->sender               = 'player';
                $notification->sender_id            = $id;
                $notification->receiver_id          = 0;
                $notification->credit_request_id    = $credit->id;
                $notification->save();
            }

        }else{

            $platform = GamingPlatform::find($request->platform)->value('platform');
            return redirect()->back()->withInput()->with('error', 'Your Account for '. $platform .' does not exist on our platform. Please request account or wait for approval if already requested.');

        }

        return redirect()->route('index')->with('success', 'You have successfully purchased '.$request->credit.' credits');

    }

    public function linkExpired(){
        return redirect()->route('index')->with('error', 'Its too late. Your payment link has been expired. Please try again.');
    }

    public function redeemRequest(Request $request){

        $id = Auth::user()->id;

            $rules = [
                'redeem_platform'   => 'required',
                'redeem_username'   => 'required',
                'payment_method'    => 'required',
                'amount'            => 'required',
                'cashtag'           => $request->method == '2' ? 'required' : '',
                'bitcoin_address'   => $request->method == '1' ? 'required' : '',
            ];

            $messages = [
                'redeem_platform.required'      => "Please select your gaming platform.",
                'payment_method.required'       => "Please enter your gaming platform username.",
                'method.required'               => "Please select the payment method.",
                'amount.required'               => "Please enter Redeem amount.",
                'cashtag.required'              => "Please enter your Cash Tag for Cash App",
                'bitcoin_address.required'      => "Please enter Bitcoin Address for Cryptocurrency",
            ];



        $this->validate($request, $rules, $messages);

        $account_exists = GamingAccount::where('user_id', $id)
                                       ->where('platform_id', $request->redeem_platform)
                                       ->where('status', '1')->exists();

        if($account_exists){

            $redeem                     = new RedeemRequest();
            $redeem->user_id            = $id;
            $redeem->platform_id        = $request->redeem_platform;
            $redeem->username           = $request->redeem_username;
            $redeem->amount             = $request->amount;
            $redeem->redeem_full        = 'no';
            $redeem->payment_method_id  = $request->payment_method;
            $redeem->cashtag            = $request->cashtag;
            $redeem->bitcoin_address    = $request->bitcoin_address;
            $redeem->save();

            // Generate Notification

            $notification                       = new Notification;
            $notification->type                 = 'redeem-request';
            $notification->sender               = 'player';
            $notification->sender_id            = $id;
            $notification->receiver_id          = 0;
            $notification->redeem_request_id    = $redeem->id;
            $notification->save();

        }else{

            $platform = GamingPlatform::find($request->redeem_platform)->value('platform');
            return redirect()->back()->withInput()->with('error', 'Your Account for '. $platform .' does not exist on our platform. Please request account or wait for approval if already requested.');

        }

        return redirect()->route('index')->with('success', 'You have successfully requested for redeeming '.$request->amount.' credits');
    }

    public function terms(){
        $terms = Setting::where('type', 'terms-and-conditions')->value('value');
        return view('frontend.terms-and-conditions', compact('terms'));
    }

    public function privacyPolicy(){
        $privacy = Setting::where('type', 'privacy-policy')->value('value');
        return view('frontend.privacy-policy', compact('privacy'));
    }

    public function settings(){
        $id     = Auth::user()->id;
        $user   = User::find($id);
        return view('frontend.settings', compact('user'));
    }

    public function transactions(){
        $histories = TransactionHistory::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate('20');
        return view('frontend.transactions', compact('histories'));
    }

    public function notifications(){
        $notifications      = Notification::orderBy('id', 'desc')->where('receiver_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(20);
        foreach($notifications as $notification){

            $notification->user = User::find($notification->receiver_id);

            if($notification->type == 'account-created'){
                $notification->data = GamingAccount::find($notification->gaming_account_id)->load('platform');
            }

            if($notification->type == 'credit-added'){
                $notification->data = CreditRequest::find($notification->credit_request_id)->load('platform');
            }


            if($notification->type == 'redeem-done'){
                $notification->data = RedeemRequest::find($notification->redeem_request_id)->load('platform');
            }


            if($notification->type == 'redeem-rejected'){
                $notification->data = RedeemRequest::find($notification->redeem_request_id)->load('platform');
            }

        }
        return view('frontend.notifications', compact('notifications'));
    }

    public function populate(Request $request)
    {
        $id = Auth::user()->id;
        $username = GamingAccount::where('user_id', $id)->where('platform_id', $request->platform_id)->value('username');
        return response()->json(['success' => $username]);
    }

    public function contactUs(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);
        $to_name    = 'Sugarsweeps';
        $to_email   = 'websales9999@gmail.com';
        $data_email       = array("name"=> $request->name, "email" => $request->email, "subject" => $request->subject, "messag" => $request->message);

        Mail::send("frontend.emails.contact", $data_email, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
            ->subject("New Query from Sugarsweeps");
            $message->from("stakesdragon7@gmail.com","Sugarsweeps");
        });
        return redirect()->route('index')->with('success', 'Thank you for contacting with us!');
    }
}

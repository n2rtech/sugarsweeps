<?php

namespace App\Http\Controllers;

use App\Models\CreditRequest;
use App\Models\GamingAccount;
use App\Models\GamingPlatform;
use App\Models\Notification;
use App\Models\PaymentMethod;
use App\Models\RedeemRequest;
use App\Models\TransactionHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $gaming_accounts = GamingAccount::where('user_id', Auth::user()->id)->where('status', 1)->count();
        $notifications      = Notification::orderBy('id', 'desc')->where('receiver_id', Auth::user()->id)->orderBy('id', 'desc')->take(5)->get();
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
        $histories = TransactionHistory::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->take('5')->get();
        return view('frontend.dashboard',compact('gaming_accounts', 'notifications', 'histories'));
    }

    public function gamingAccounts()
    {
        $platforms = GamingPlatform::where('status', 1)->get();
        return view('frontend.gaming-accounts', compact('platforms'));
    }

    public function requestAccount($platform_id){
        $platform               = GamingPlatform::find($platform_id);
        $id                     = Auth::user()->id;
        $account                = new GamingAccount();
        $account->user_id       = $id;
        $account->platform_id   = $platform_id;
        $account->save();

        // Generate Notification

        $notification                       = new Notification();
        $notification->type                 = 'request-account';
        $notification->sender               = 'player';
        $notification->sender_id            = $id;
        $notification->receiver_id          = 0;
        $notification->gaming_account_id    = $account->id;
        $notification->save();

        return redirect()->back()->with('success', 'You have successfully requested for '.$platform->platform.' account');
    }

    public function buyCredits()
    {
        $id                         = Auth::user()->id;
        $platforms                  = GamingPlatform::where('status', 1)->get();
        $account_exists             = GamingAccount::where('user_id', $id)->where('status', '1')->exists();
        foreach($platforms as $platform){
            $platform->exists       = GamingAccount::where('user_id', $id)->where('platform_id', $platform->id)->where('status', '1')->exists();
            $platform->platform_id  = GamingAccount::where('user_id', $id)->where('platform_id', $platform->id)->where('status', '1')->value('id');
        }
        $methods                    = PaymentMethod::where('status', '1')->where('id', '1')->get();

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.nowpayments.io/v1/currencies',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'x-api-key: 9KCBP26-9XF4MG6-PJR8FXM-MY1XC19',
        ),
        ));

        $result = curl_exec($curl);

        $response = json_decode($result,true);

        curl_close($curl);

        return view('frontend.buy-credits', compact('platforms', 'methods', 'account_exists', 'response'));
    }

    public function populate(Request $request)
    {
        $id = Auth::user()->id;
        $username = GamingAccount::where('user_id', $id)->where('platform_id', $request->platform_id)->value('username');
        return response()->json(['success' => $username]);
    }

    public function createPayment(Request $request){

        $id = Auth::user()->id;


        $rules = [
            'platform'          => 'required',
            'bitcoin_username'          => 'required',
            'credit'            => 'required',
            'method'            => 'required',
            'currency'          => 'required',
        ];

        $messages = [
            'platform.required'             => "Please select your gaming platform.",
            'bitcoin_username.required'     => "Please enter your gaming platform username.",
            'credit.required'               => "Please enter the amount to buy.",
            'method.required'               => "Please select the payment method.",
            'currency.required'               => "Please select any one crypto currency.",
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

            $notification                       = new Notification;
            $notification->type                 = 'credit-requested';
            $notification->sender               = 'player';
            $notification->sender_id            = $id;
            $notification->receiver_id          = 0;
            $notification->credit_request_id    = $credit->id;
            $notification->save();




        }else{

            $platform = GamingPlatform::find($request->platform)->value('platform');
            return redirect()->back()->withInput()->with('error', 'Your Account for '. $platform .' does not exist on our platform. Please request account or wait for approval if already requested.');

        }

        return redirect()->route('index')->with('success', 'You have successfully purchased '.$request->credit.' credits');

    }

    public function linkExpired(){
        return redirect()->route('buy.credits')->with('error', 'Its too late. Your payment link has been expired. Please try again.');
    }

    public function redeemCredits()
    {
        $id                         = Auth::user()->id;
        $platforms                  = GamingPlatform::where('status', 1)->get();
        $account_exists             = GamingAccount::where('user_id', $id)->where('status', '1')->exists();

        foreach($platforms as $platform){

            $platform->exists       = GamingAccount::where('user_id', $id)->where('platform_id', $platform->id)->where('status', '1')->exists();

            $platform->platform_id  = GamingAccount::where('user_id', $id)->where('platform_id', $platform->id)->where('status', '1')->value('id');

        }

        $methods                    = PaymentMethod::where('status', '1')->get();

        return view('frontend.redeem-credits', compact('platforms', 'methods', 'account_exists'));
    }

    public function redeemRequest(Request $request){

        $id = Auth::user()->id;

            $rules = [
                'redeem_platform'          => 'required',
                'redeem_username'   => 'required',
                'payment_method'            => 'required',
                'cashtag'           => $request->method == '2' ? 'required' : '',
                'bitcoin_address'   => $request->method == '1' ? 'required' : '',
            ];

            $messages = [
                'redeem_platform.required'             => "Please select your gaming platform.",
                'payment_method.required'      => "Please enter your gaming platform username.",
                'method.required'               => "Please select the payment method.",
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

    public function notifications()
    {
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

    public function transactionHistory()
    {
        $histories = TransactionHistory::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate('20');
        return view('frontend.transaction-history', compact('histories'));
    }
}

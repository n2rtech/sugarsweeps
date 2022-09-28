<?php

use App\Models\CreditRequest;
use App\Models\GamingAccount;
use App\Models\Notification;
use App\Models\RedeemRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

if (!function_exists('checkIfAccountIsRequested')) {
    function checkIfAccountIsRequested($id)
    {
        $user_id = Auth::user()->id;
        $account_exists = GamingAccount::where('user_id', $user_id)->where('platform_id', $id)->exists();
        return $account_exists;
    }
}
if (!function_exists('checkIfCredentialsGenerated')) {
    function checkIfCredentialsGenerated($id)
    {
        $user_id = Auth::user()->id;
        $credential_generated = GamingAccount::where('user_id', $user_id)->where('platform_id', $id)->where('status', 1)->exists();
        return $credential_generated;
    }
}

if (!function_exists('getUsername')) {
    function getUsername($id)
    {
        $user_id = Auth::user()->id;
        $username = GamingAccount::where('user_id', $user_id)->where('platform_id', $id)->value('username');
        return $username;
    }
}
if (!function_exists('getPassword')) {
    function getPassword($id)
    {
        $user_id = Auth::user()->id;
        $password = GamingAccount::where('user_id', $user_id)->where('platform_id', $id)->value('password');
        return $password;
    }
}
if (!function_exists('getPasswordByUserId')) {
    function getPasswordByUserId($user_id, $id)
    {
        $password = GamingAccount::where('user_id', $user_id)->where('platform_id', $id)->value('password');
        return $password;
    }
}
if (!function_exists('getLatestAdminNotifications')) {
    function getLatestAdminNotifications()
    {
        $notifications      = Notification::orderBy('id', 'desc')->where('receiver_id', 0)->orderBy('id', 'desc')->take(5)->get();
        foreach ($notifications as $notification) {

            $notification->user = User::find($notification->sender_id);

            if ($notification->type == 'credit-requested') {
                $notification->data = CreditRequest::find($notification->credit_request_id)->load('platform');
            }

            if ($notification->type == 'redeem-request') {
                $notification->data = RedeemRequest::find($notification->redeem_request_id)->load('platform');
            }
        }
        return $notifications;
    }
}
if (!function_exists('getLatestPlayerNotifications')) {
    function getLatestPlayerNotifications()
    {

        $notifications      = Notification::orderBy('id', 'desc')->where('receiver_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(20);
        foreach ($notifications as $notification) {

            $notification->user = User::find($notification->receiver_id);

            if ($notification->type == 'credit-added') {
                $notification->data = CreditRequest::find($notification->credit_request_id)->load('platform');
            }


            if ($notification->type == 'redeem-done') {
                $notification->data = RedeemRequest::find($notification->redeem_request_id)->load('platform');
            }


            if ($notification->type == 'redeem-rejected') {
                $notification->data = RedeemRequest::find($notification->redeem_request_id)->load('platform');
            }
        }
        return $notifications;
    }
}
if (!function_exists('platformExists')) {
    function platformExists($id)
    {
        $user_id               = Auth::user()->id;
        $platform_exists       = GamingAccount::where('user_id', $user_id)->where('platform_id', $id)->where('status', '1')->exists();
        return $platform_exists;
    }
}
if (!function_exists('accountExists')) {
    function accountExists()
    {
        $user_id                    = Auth::user()->id;
        $account_exists             = GamingAccount::where('user_id', $user_id)->where('status', '1')->exists();
        return $account_exists;
    }

}
if (!function_exists('getPlayerNameById')) {
    function getPlayerNameById($id)
    {
        $username = User::where('id', $id)->value('name');
        return $username;
    }
}

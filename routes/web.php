<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\MyAccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Models\GamingPlatform;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/about-us', function () {
    return view('frontend.about-us');
})->name('about-us');

Route::get('/setting', [IndexController::class, 'setting'])->name('setting')->middleware('auth');

Route::get('/gaming-platforms', function () {
    $platforms = GamingPlatform::where('status', 1)->get();
    return view('frontend.gaming-platforms', compact('platforms'));
})->name('gaming-platforms');

Auth::routes();

Route::get('home', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Gaming Accounts Route
|--------------------------------------------------------------------------
*/

Route::get('gaming-accounts', [HomeController::class, 'gamingAccounts'])->name('gaming-accounts');

Route::get('request-account/{platform_id}', [HomeController::class, 'requestAccount'])->name('request-account');

/*
|--------------------------------------------------------------------------
| Buy Credits
|--------------------------------------------------------------------------
*/

Route::get('buy-credits', [HomeController::class, 'buyCredits'])->name('buy-credits');

Route::post('auto-populate', [HomeController::class, 'populate'])->name('populate');

Route::post('create-payment', [HomeController::class, 'createPayment'])->name('create.payment');

Route::post('request-credits', [HomeController::class, 'requestCredits'])->name('request.credits');

Route::get('link-expired', [HomeController::class, 'linkExpired'])->name('link.expired');

/*
|--------------------------------------------------------------------------
| Redeem Credits
|--------------------------------------------------------------------------
*/

Route::get('redeem-credits', [HomeController::class, 'redeemCredits'])->name('redeem-credits');

Route::post('redeem-request', [HomeController::class, 'redeemRequest'])->name('redeem-request');

/*
|--------------------------------------------------------------------------
| Notifications
|--------------------------------------------------------------------------
*/

Route::get('notifications', [HomeController::class, 'notifications'])->name('notifications');

/*
|--------------------------------------------------------------------------
| Transaction History
|--------------------------------------------------------------------------
*/

Route::get('transaction-history', [HomeController::class, 'transactionHistory'])->name('transaction-history');

/*
|--------------------------------------------------------------------------
| Settings > My Account Route
|--------------------------------------------------------------------------
*/
Route::resource('my-account', MyAccountController::class);

/*
|--------------------------------------------------------------------------
| Settings > Change Password Route
|--------------------------------------------------------------------------
*/
Route::get('change-password', [ChangePasswordController::class,'changePasswordForm'])->name('password.form');

Route::post('change-password', [ChangePasswordController::class,'changePassword'])->name('change-password');

Route::get('privacy-policy', [IndexController::class,'privacyPolicy'])->name('privacy-policy');

Route::get('terms-and-conditions', [IndexController::class,'termsAndCondition'])->name('terms-and-conditions');

<?php

use App\Http\Controllers\Cashier\Auth\ChangePasswordController;
use App\Http\Controllers\Cashier\Auth\ForgotPasswordController;
use App\Http\Controllers\Cashier\Auth\LoginController;
use App\Http\Controllers\Cashier\Auth\MyAccountController;
use App\Http\Controllers\Cashier\Auth\ResetPasswordController;
use App\Http\Controllers\Cashier\CreditRequestController;
use App\Http\Controllers\Cashier\DashboardController;
use App\Http\Controllers\Cashier\GamingRequestController;
use App\Http\Controllers\Cashier\NotificationController;
use App\Http\Controllers\Cashier\PlayerController;
use App\Http\Controllers\Cashier\RedeemRequestController;
use App\Http\Controllers\Cashier\TransactionHistoryController;
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

Route::group(['prefix' => 'cashier', 'as' => 'cashier.'], function () {

    /*
    |--------------------------------------------------------------------------
    | Authentication Routes | LOGIN | REGISTER
    |--------------------------------------------------------------------------
    */

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.submit');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/update', [ResetPasswordController::class, 'reset'])->name('password.update');


    /*
    |--------------------------------------------------------------------------
    | Dashboard Route
    |--------------------------------------------------------------------------
    */

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Player Route
    |--------------------------------------------------------------------------
    */
    Route::resource('players', PlayerController::class);


    /*
    |--------------------------------------------------------------------------
    | Gaming Request Route
    |--------------------------------------------------------------------------
    */
    Route::resource('gaming-requests', GamingRequestController::class);

    /*
    |--------------------------------------------------------------------------
    | Deposit Request Route
    |--------------------------------------------------------------------------
    */
    Route::resource('deposit-requests', CreditRequestController::class);

    /*
    |--------------------------------------------------------------------------
    | Redeem Request Route
    |--------------------------------------------------------------------------
    */
    Route::resource('redeem-requests', RedeemRequestController::class);
    Route::put('verify-request/{id}', [RedeemRequestController::class, 'verifyRequest'])->name('verify-request');

    Route::post('approve-full-report', [RedeemRequestController::class, 'redeemFull'])->name('redeem.full');

    /*
    |--------------------------------------------------------------------------
    | Notification Center Route
    |--------------------------------------------------------------------------
    */
    Route::get('check-notifications', [NotificationController::class, 'checkNotification'])->name('check-notifications');
    Route::resource('notification-center', NotificationController::class);

    /*
    |--------------------------------------------------------------------------
    | Transaction History Route
    |--------------------------------------------------------------------------
    */

    Route::resource('transaction-history', TransactionHistoryController::class);

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
    Route::get('change-password', [ChangePasswordController::class, 'changePasswordForm'])->name('password.form');

    Route::post('change-password', [ChangePasswordController::class, 'changePassword'])->name('change-password');
});

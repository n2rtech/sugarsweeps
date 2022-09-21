<?php

use App\Http\Controllers\Admin\Auth\ChangePasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\MyAccountController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\CashAppController;
use App\Http\Controllers\Admin\CashierController;
use App\Http\Controllers\Admin\CreditRequestController;
use App\Http\Controllers\Admin\PlayerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GamingPlatformController;
use App\Http\Controllers\Admin\GamingRequestController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\RedeemRequestController;
use App\Http\Controllers\Admin\TransactionHistoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::redirect('/admin', '/admin/dashboard');
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {


/*
|--------------------------------------------------------------------------
| Authentication Routes | LOGIN | REGISTER
|--------------------------------------------------------------------------
*/

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.submit');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('register.submit');

/*
|--------------------------------------------------------------------------
| Dashboard Route
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Player Route
|--------------------------------------------------------------------------
*/
Route::resource('players', PlayerController::class);

Route::get('admin/player/change-password/{id}', [PlayerController::class,'changePasswordForm'])->name('player.password-form');

    Route::post('admin/player/change-password', [PlayerController::class,'changePassword'])->name('player.change-password');

/*
|--------------------------------------------------------------------------
| Cashier Route
|--------------------------------------------------------------------------
*/
Route::resource('cashiers', CashierController::class);

Route::get('admin/cashier/change-password/{id}', [CashierController::class,'changePasswordForm'])->name('cashier.password-form');

Route::post('admin/cashier/change-password', [CashierController::class,'changePassword'])->name('cashier.change-password');

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

Route::post('approve-full-report', [RedeemRequestController::class,'redeemFull'])->name('redeem.full');

Route::get('redeem-report', [RedeemRequestController::class,'redeemHistory'])->name('redeem.report');

Route::post('redeem-report', [RedeemRequestController::class,'getHistory'])->name('get-report');

/*
|--------------------------------------------------------------------------
| Notification Center Route
|--------------------------------------------------------------------------
*/

Route::get('check-notifications', [NotificationController::class,'checkNotification'])->name('check-notifications');

Route::resource('notification-center', NotificationController::class);

/*
|--------------------------------------------------------------------------
| Transaction History Route
|--------------------------------------------------------------------------
*/

Route::resource('transaction-history', TransactionHistoryController::class);

/*
|--------------------------------------------------------------------------
| Gaming Platforms Route
|--------------------------------------------------------------------------
*/
Route::resource('gaming-platforms', GamingPlatformController::class);

/*
|--------------------------------------------------------------------------
| Payment Method Route
|--------------------------------------------------------------------------
*/
Route::resource('payment-methods', PaymentMethodController::class);

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

Route::get('cashapp-setting', [CashAppController::class,'setting'])->name('cashapp.form');

Route::post('cashapp-setting', [CashAppController::class,'saveSetting'])->name('save-cashapp');

Route::get('privacy-setting', [CashAppController::class,'privacySetting'])->name('privacy-setting.form');

Route::post('privacy-setting', [CashAppController::class,'savePrivacySetting'])->name('save-privacy-setting');

Route::get('term-setting', [CashAppController::class,'termSetting'])->name('term-setting.form');

Route::post('term-setting', [CashAppController::class,'saveTermSetting'])->name('save-term-setting');

});

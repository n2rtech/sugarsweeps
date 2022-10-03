<?php

use App\Http\Controllers\Admin\ApprovalRequestController;
use App\Http\Controllers\Admin\Auth\ChangePasswordController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\MyAccountController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\BulkEmailController;
use App\Http\Controllers\Admin\CashierController;
use App\Http\Controllers\Admin\CreditRequestController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GamingPackageController;
use App\Http\Controllers\Admin\GamingPlatformController;
use App\Http\Controllers\Admin\GamingRequestController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\PlayerController;
use App\Http\Controllers\Admin\RedeemRequestController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TransactionHistoryController;
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

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

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
    Route::get('players/credentials/{id}', [PlayerController::class, 'credentials'])->name('players.credentials');

    Route::get('admin/player/change-password/{id}', [PlayerController::class, 'changePasswordForm'])->name('player.password-form');

    Route::post('admin/player/change-password', [PlayerController::class, 'changePassword'])->name('player.change-password');

    /*
    |--------------------------------------------------------------------------
    | Cashier Route
    |--------------------------------------------------------------------------
    */
    Route::resource('cashiers', CashierController::class);

    Route::get('admin/cashier/change-password/{id}', [CashierController::class, 'changePasswordForm'])->name('cashier.password-form');

    Route::post('admin/cashier/change-password', [CashierController::class, 'changePassword'])->name('cashier.change-password');

    /*
    |--------------------------------------------------------------------------
    | Approval Request Route
    |--------------------------------------------------------------------------
    */
    Route::resource('approval-requests', ApprovalRequestController::class);
    Route::get('approval-requests/approve/{id}', [ApprovalRequestController::class, 'approve'])->name('approval-requests.approve');
    Route::get('approval-requests/reject/{id}', [ApprovalRequestController::class, 'reject'])->name('approval-requests.reject');

    /*
    |--------------------------------------------------------------------------
    | Gaming Package Route
    |--------------------------------------------------------------------------
    */
    Route::resource('gaming-packages', GamingPackageController::class);

    Route::get('gaming-packages-import-export', [GamingPackageController::class, 'importExport'])->name('gaming-packages.import-export');

    Route::post('gaming-packages-import', [GamingPackageController::class, 'import'])->name('gaming-packages.import');

    Route::post('gaming-packages-export', [GamingPackageController::class, 'export'])->name('gaming-packages.export');

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

    Route::get('redeem-report', [RedeemRequestController::class, 'redeemHistory'])->name('redeem.report');

    Route::post('redeem-report', [RedeemRequestController::class, 'getHistory'])->name('get-report');

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
    Route::get('change-password', [ChangePasswordController::class, 'changePasswordForm'])->name('password.form');

    Route::post('change-password', [ChangePasswordController::class, 'changePassword'])->name('change-password');

    Route::get('cashapp-setting', [SettingController::class, 'setting'])->name('cashapp.form');

    Route::post('cashapp-setting', [SettingController::class, 'saveSetting'])->name('save-cashapp');

    Route::get('privacy-setting', [SettingController::class, 'privacySetting'])->name('privacy-setting.form');

    Route::post('privacy-setting', [SettingController::class, 'savePrivacySetting'])->name('save-privacy-setting');

    Route::get('term-setting', [SettingController::class, 'termSetting'])->name('term-setting.form');

    Route::post('term-setting', [SettingController::class, 'saveTermSetting'])->name('save-term-setting');

    Route::resource('bulk-emails', BulkEmailController::class);


});

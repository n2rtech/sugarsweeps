<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\MyAccountController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Artisan;
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

Route::post('create-payment', [IndexController::class, 'createPayment'])->name('create.payment');

Route::post('request-credits', [IndexController::class, 'requestCredits'])->name('request.credits');

Route::post('redeem-request', [IndexController::class, 'redeemRequest'])->name('redeem-request');

Route::get('link-expired', [IndexController::class, 'linkExpired'])->name('link.expired');

Route::post('auto-populate', [IndexController::class, 'populate'])->name('populate');

Route::get('terms-and-conditions', [IndexController::class, 'terms'])->name('terms-and-conditions');

Route::get('privacy-policy', [IndexController::class, 'privacyPolicy'])->name('privacy-policy');

Route::get('settings', [IndexController::class, 'settings'])->name('settings');

Route::get('transactions', [IndexController::class, 'transactions'])->name('transactions');

Route::get('notifications', [IndexController::class, 'notifications'])->name('notifications');

Route::get('/', [IndexController::class, 'index'])->name('index');

Auth::routes(['verify' => true]);

Route::redirect('/home', '/')->name('home');

Route::resource('my-account', MyAccountController::class);

Route::post('change-password', [ChangePasswordController::class,'changePassword'])->name('change-password');

Route::post('contact-us', [IndexController::class, 'contactUs'])->name('contact-us');

Route::get('refresh-database', function () {

    Artisan::call('migrate:fresh');
    Artisan::call('db:seed');

    dd("Hello ! Database has been refreshed and sample data has been inserted!");

});

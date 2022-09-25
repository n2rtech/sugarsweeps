<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\MyAccountController;
use App\Http\Controllers\IndexController;
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

Route::get('terms-and-conditions', [IndexController::class, 'terms'])->name('terms-and-conditions');
Route::get('privacy-policy', [IndexController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('settings', [IndexController::class, 'settings'])->name('settings');
Route::get('transactions', [IndexController::class, 'transactions'])->name('transactions');
Route::get('notifications', [IndexController::class, 'notifications'])->name('notifications');

Route::get('/', [IndexController::class, 'index'])->name('index');

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('my-account', MyAccountController::class);

Route::post('change-password', [ChangePasswordController::class,'changePassword'])->name('change-password');

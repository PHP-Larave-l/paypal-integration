<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayPalController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/subscribe-page', function () {
    return view('subscribe');
})->name('subscribe-page');

Route::get('/subscribe', [PayPalController::class, 'subscribe'])->name('subscribe');
Route::get('/subscription-success', [PayPalController::class, 'subscriptionSuccess'])->name('subscription-success');
Route::get('/subscription-cancel', [PayPalController::class, 'subscriptionCancel'])->name('subscription-cancel');

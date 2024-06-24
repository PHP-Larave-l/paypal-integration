<?php

use App\Http\Controllers\PayController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/subscribe-page', function () {
    return view('subscribe');
})->name('subscribe-page');

Route::get('/subscribe', [PayController::class, 'showSubscriptionForm'])->name('subscribe');
Route::get('/subscription-success', [PayController::class, 'subscriptionSuccess'])->name('subscription-success');
Route::get('/subscription-cancel', [PayController::class, 'subscriptionCancel'])->name('subscription-cancel');
Route::post('/create-subscription', [PayController::class, 'createSubscription'])->name('create-subscription');

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
Route::get('/payment-page', function () {
    return view('pay');
})->name('payment-page');
Route::get('/pay', [PayPalController::class, 'pay'])->name('pay');
Route::get('/success', [PayPalController::class, 'success'])->name('success');
Route::get('/cancel', [PayPalController::class, 'cancel'])->name('cancel');

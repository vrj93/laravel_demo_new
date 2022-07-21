<?php

use App\Http\Controllers\CoinMapController;
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

Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {
    
    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/index', [ CoinMapController::class, 'index' ])->name('index');

    Route::get('/coin-map', [ CoinMapController::class, 'getCoinATM' ])->name('coin.map');

    Route::get('/payment-page', [ CoinMapController::class, 'paymentPage' ])->name('payment.page');

    Route::get('/payment', [ CoinMapController::class, 'payment' ])->name('payment');
    
});

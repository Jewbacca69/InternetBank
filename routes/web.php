<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CryptoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/transactions', [TransactionsController::class, 'index'])->name('transactions');
    Route::get('/crypto', [CryptoController::class, 'index'])->name('crypto');
    Route::post('/crypto', [CryptoController::class, 'store'])->name('crypto.buy');
    Route::post('/crypto/sell', [CryptoController::class, 'sellCrypto'])->name('crypto.sell');
    Route::post('/accounts', [AccountController::class, 'store'])->name('accounts.store');
    Route::post('/transfer', [AccountController::class, 'transferFunds'])->name('accounts.transfer');
});

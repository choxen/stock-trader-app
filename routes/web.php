<?php

use App\Http\Controllers\StocksController;
use App\Http\Controllers\TradersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::get('/transactions', [TradersController::class, 'transactions'])
    ->middleware(['auth', 'verified'])->name('transactions');

Route::get('/myStocks', [StocksController::class, 'myStocks'])
    ->middleware(['auth', 'verified'])->name('stocks.my');

Route::post('/search', [StocksController::class, 'search'])
    ->name('search');

Route::get('/search/{symbol}/stock', [StocksController::class, 'result'])
    ->name('result');

Route::post('/buy/stock/{company}/{stock}/{price}', [StocksController::class, 'buy'])
    ->middleware(['auth', 'verified'])->name('buy.stock');

Route::post('/sell/{stock}', [StocksController::class, 'sell'])
    ->middleware(['auth', 'verified'])->name('sell.stock');

Route::get('/send-email', [\App\Http\Controllers\SendEmailController::class, 'showForm']);
Route::post('/send-email', [\App\Http\Controllers\SendEmailController::class, 'send'])->name('email.send');

require __DIR__ . '/auth.php';

<?php

use App\Http\Controllers\StocksController;
use App\Http\Controllers\TradersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->to('home');
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::get('/transactions', [TradersController::class, 'transactions'])
    ->middleware(['auth', 'verified'])->name('transactions');

Route::get('/stocks/owned', [StocksController::class, 'owned'])
    ->middleware(['auth', 'verified'])->name('stocks.owned');

Route::post('/stocks/search', [StocksController::class, 'search'])
    ->middleware(['auth', 'verified'])->name('stocks.search');

Route::get('/stocks/search/{symbol}', [StocksController::class, 'result'])
    ->middleware(['auth', 'verified'])->name('stocks.result');

Route::post('/stocks/buy/{company}/{stock}', [StocksController::class, 'buy'])
    ->middleware(['auth', 'verified'])->name('stocks.buy');

Route::post('/stocks/sell/{stock}', [StocksController::class, 'sell'])
    ->middleware(['auth', 'verified'])->name('stocks.sell');

require __DIR__ . '/auth.php';

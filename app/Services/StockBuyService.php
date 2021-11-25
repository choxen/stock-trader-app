<?php

namespace App\Services;

use App\Events\StockPurchased;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockBuyService
{
    public function execute(string $company, string $ticker, string $price, int $quantity)
    {
        $user = Auth::user();

        $stocksPrice = $quantity * $price;

        $user->stocks()->updateOrCreate(
            [
                'user_id' => $user->id,
                'company' => $company,
                'ticker' => $ticker,
            ],
            [
                'quantity' => DB::raw('quantity + ' . $quantity),
                'total_invested' => DB::raw('total_invested +' . $stocksPrice),
                'current_total' => DB::raw('current_total +' . $stocksPrice)
            ],
        );

        $transaction = (new Transaction([
            'stock' => $ticker,
            'quantity' => $quantity,
            'money' => $stocksPrice,
            't_type' => 'Bought',
            'created_at' => config('app.timezone')
        ]));

        $transaction->user()->associate($user);
        $transaction->save();

        $user->money -= $stocksPrice;
        $user->save();

        StockPurchased::dispatch($user, $ticker, $quantity, $price);
    }
}

<?php

namespace App\Services;

use App\Models\Stock;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockBuyService
{
    public function execute(string $company, string $symbol, string $price, Request $request)
    {
        $request->validate([
            'stock-amount' => ['required']
        ]);

        $user = Auth::user();

        $stockAmount = $request->get('stock-amount');
        $stocksPrice = $stockAmount * $price;
        $userCredits = $user->credits_amount / 100;

        if ($userCredits < $stocksPrice) {
            return redirect()->back()->withErrors(['msg' => 'You dont have enough funds']);
        }

        $timezone = env('TIMEZONE');
        $opens = Carbon::today($timezone)->addHours(16);
        $closes = Carbon::today($timezone)->addHours(23);
        $current = now($timezone);

        if ($current->lt($opens) && $current->gt($closes)) {
            return redirect()->back()->withErrors([
                'msg' => 'Stock market works from ' . $opens->format('H:i') . ' till ' . $closes->format('H:i')
            ]);
        }

        $user->stocks()->updateOrCreate(
            [
                'user_id' => $user->id,
                'company' => $company,
                'stock' => $symbol,
            ],
            [
                'quantity' => DB::raw('quantity + ' . $stockAmount)
            ],
        );

        $transaction = (new Transaction([
            'stock' => $symbol,
            'quantity' => $stockAmount,
            'credits_amount' => $stocksPrice,
            't_type' => 'Bought',
            'created_at' => $current
        ]));

        $transaction->user()->associate($user);
        $transaction->save();

        $user->credits_amount -= $stocksPrice * 100;
        $user->save();
    }
}

<?php

namespace App\Services;

use App\Models\Stock;
use App\Models\Transaction;
use App\Repositories\StocksRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockSellService
{
    private StocksRepository $stocksRepository;

    public function __construct(StocksRepository $stocksRepository)
    {
        $this->stocksRepository = $stocksRepository;
    }

    public function execute(Stock $stock, int $quantity)
    {
        $user = Auth::user();

        $timezone = env('TIMEZONE');
        $opens = Carbon::today($timezone)->addHours(16);
        $closes = Carbon::today($timezone)->addHours(23);
        $current = now($timezone);

        if ($current->lt($opens) && $current->gt($closes)) {
            return redirect()->back()->withErrors([
                'msg' => 'Stock market works from ' . $opens->format('H:i') . ' till ' . $closes->format('H:i')
            ]);
        }

        $companyQuoteData = $this->stocksRepository->companyQuoteData($stock->stock);

        $total = $companyQuoteData->currentPrice() * $quantity;
        $totalInCents = $total * 100;

        $userStock = Stock::where([
            'user_id' => $user->id,
            'stock' => $stock->stock
        ])->first();

        if ($userStock->quantity < $quantity) {
            return redirect()->back()->withErrors([
                'msg' => 'You dont that much stocks...'
            ]);
        }

        $userStock->quantity -= $quantity;
        $userStock->save();

        if ($userStock->quantity <= 0) {
            $userStock->delete();
        }

        $transaction = (new Transaction([
            'stock' => $stock->stock,
            'quantity' => $quantity,
            'credits_amount' => $total,
            't_type' => 'Sold',
            'created_at' => $current
        ]));

        $transaction->user()->associate($user);
        $transaction->save();

        $user->credits_amount += $totalInCents;
        $user->save();
    }
}

<?php

namespace App\Services;

use App\Events\StockSold;
use App\Models\Stock;
use App\Models\Transaction;
use App\Repositories\StocksRepository;
use Illuminate\Support\Facades\Auth;

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

        $companyQuoteData = $this->stocksRepository->companyQuoteData($stock->ticker);

        $total = $companyQuoteData->currentPrice() * $quantity;

        $stock->quantity -= $quantity;
        $stock->current_total -= $total;
        $stock->save();

        StockSold::dispatch($user, $stock->ticker, $quantity, $total);

        if ($stock->quantity <= 0) {
            $stock->delete();
        }

        $transaction = (new Transaction([
            'stock' => $stock->ticker,
            'quantity' => $quantity,
            'money' => $total,
            't_type' => 'Sold',
            'created_at' => config('app.timezone')
        ]));

        $transaction->user()->associate($user);
        $transaction->save();

        $user->money += $total;
        $user->save();
    }
}

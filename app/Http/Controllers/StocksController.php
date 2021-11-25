<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockRequest;
use App\Models\Stock;
use App\Repositories\StocksRepository;
use App\Rules\AllowedTime;
use App\Rules\EnoughMoney;
use App\Rules\EnoughStocks;
use App\Rules\Workday;
use App\Services\StockBuyService;
use App\Services\StockSellService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Throwable;

class StocksController extends Controller
{
    private StocksRepository $stocksRepository;

    public function __construct(StocksRepository $stocksRepository)
    {
        $this->stocksRepository = $stocksRepository;
    }

    public function owned(): View
    {
        $stocks = Auth::user()->stocks()->paginate(10);

        foreach ($stocks->all() as $stock) {
            $price = $this->stocksRepository->companyQuoteData($stock->ticker)->currentPrice();
            $stock->total_profit = $price * $stock->quantity - $stock->current_total;
        }

        return view('owned-stocks')->with(['stocks' => $stocks]);
    }

    public function result(string $symbol)
    {
        try {
            $company = $this->stocksRepository->companyProfile($symbol);
            $companyQuoteData = $this->stocksRepository->companyQuoteData($symbol);
        } catch (Throwable $exception) {
            report($exception);

            return redirect()->back();
        }

        return view('result')->with([
            'company' => $company,
            'companyQuoteData' => $companyQuoteData
        ]);
    }

    public function search(StockRequest $request)
    {
        $request->validate(
            $request->rules()
        );

        try {
            $stockData = $this->stocksRepository->stockData($request->get('stock'));
        } catch (Throwable $exception) {
            report($exception);

            return redirect()->back();
        }

        return redirect()->route('stocks.result', $stockData->displaySymbol());
    }

    public function buy(Request $request, StockBuyService $service, string $company, string $ticker)
    {
        $user = Auth::user();

        $price = $this->stocksRepository->companyQuoteData($ticker)->currentPrice();

        $request->request->add([
            'time' => now(config('app.timezone'))
        ]);
        $request->validate([
            'stock-quantity' => [
                'required',
                new EnoughMoney($user->money, $price)
            ],
            'time' => [
                new AllowedTime(),
                new Workday()
            ]
        ]);

        $service->execute($company, $ticker, $price, (int)$request->get('stock-quantity'));

        return redirect()->back();
    }

    public function sell(Request $request, StockSellService $service, Stock $stock)
    {
        $request->request->add([
            'time' => now(config('app.timezone'))
        ]);
        $request->validate([
            'stock-quantity' => [
                'required',
                new EnoughStocks($stock->quantity)
            ],
            'time' => [
                new AllowedTime(),
                new Workday()
            ]
        ]);

        $service->execute($stock, (int)$request->get('stock-quantity'));

        return redirect()->back();
    }
}

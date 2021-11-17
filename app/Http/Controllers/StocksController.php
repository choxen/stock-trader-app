<?php

namespace App\Http\Controllers;

use App\Events\StockPurchased;
use App\Http\Requests\StockRequest;
use App\Models\Stock;
use App\Repositories\StocksRepository;
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

    public function myStocks(): View
    {
        $stocks = Auth::user()->stocks()->paginate(10);

        return view('mystocks')->with(['stocks' => $stocks]);
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

        return redirect()->route('result', $stockData['displaySymbol']);
    }

    public function buy(string $company, string $stock, string $price, Request $request, StockBuyService $service)
    {
        $service->execute($company, $stock, $price, $request);

        StockPurchased::dispatch(Auth::user(), $stock, $price);

        return redirect()->back();
    }

    public function sell(Stock $stock, Request $request, StockSellService $service)
    {
        $service->execute($stock, $request->get('stock-quantity'));

        return redirect()->back();
    }
}

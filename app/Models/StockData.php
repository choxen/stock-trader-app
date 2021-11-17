<?php

namespace App\Models;

class StockData
{
    private float $currentPrice;
    private float $change;
    private float $percentChange;
    private float $highestPrice;
    private float $lowestPrice;
    private float $openPrice;
    private float $previousClosePrice;

    public function __construct(array $stockData)
    {
        $this->currentPrice = $stockData['c'];
        $this->change = $stockData['d'];
        $this->percentChange = $stockData['dp'];
        $this->highestPrice = $stockData['h'];
        $this->lowestPrice = $stockData['l'];
        $this->openPrice = $stockData['o'];
        $this->previousClosePrice = $stockData['pc'];
    }

    public function currentPrice(): float
    {
        return $this->currentPrice;
    }

    public function change(): float
    {
        return $this->change;
    }

    public function percentChange(): float
    {
        return $this->percentChange;
    }

    public function highestPrice(): float
    {
        return $this->highestPrice;
    }

    public function lowestPrice(): float
    {
        return $this->lowestPrice;
    }

    public function openPrice(): float
    {
        return $this->openPrice;
    }

    public function previousClosePrice(): float
    {
        return $this->previousClosePrice;
    }
}

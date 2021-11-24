<?php

namespace App\Models;

class StockData
{
    private string $description;
    private string $displaySymbol;
    private string $symbol;
    private string $type;

    public function __construct(array $data)
    {
        $this->description = $data['description'];
        $this->displaySymbol = $data['displaySymbol'];
        $this->symbol = $data['symbol'];
        $this->type = $data['type'];
    }

    public function description(): string
    {
        return $this->description;
    }

    public function displaySymbol(): string
    {
        return $this->displaySymbol;
    }

    public function symbol(): string
    {
        return $this->symbol;
    }

    public function type(): string
    {
        return $this->type;
    }
}

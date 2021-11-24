<?php

namespace App\Models;

class CompanyProfile
{
    private string $name;
    private string $ticker;
    private string $currency;
    private string $exchange;
    private string $country;
    private int $phone;
    private string $logo;
    private float $sharesOutstanding;

    public function __construct(array $company)
    {
        $this->name = $company['name'];
        $this->ticker = $company['ticker'];
        $this->currency = $company['currency'];
        $this->exchange = $company['exchange'];
        $this->country = $company['country'];
        $this->phone = $company['phone'];
        $this->logo = $company['logo'];
        $this->sharesOutstanding = $company['shareOutstanding'] ;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function ticker(): string

    {
        return $this->ticker;
    }

    public function currency(): string
    {
        return $this->currency;
    }

    public function exchange(): string
    {
        return $this->exchange;
    }

    public function country(): string
    {
        return $this->country;
    }

    public function phone(): int
    {
        return $this->phone;
    }

    public function logo(): string
    {
        return $this->logo;
    }

    public function sharesOutstanding(): float
    {
        return $this->sharesOutstanding;
    }
}

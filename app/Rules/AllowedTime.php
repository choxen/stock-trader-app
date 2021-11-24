<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class AllowedTime implements Rule
{
    private Carbon $opens;
    private Carbon $closes;

    public function __construct()
    {
        $timezone = config('app.timezone');
        $this->opens = Carbon::today($timezone)->addHours(config('stock-market.market_opens'));
        $this->closes = Carbon::today($timezone)->addHours(config('stock-market.market_closes'));
    }

    public function passes($attribute, $value)
    {
        if ($value->lt($this->opens) || $value->gt($this->closes)) {
            return false;
        }
        return true;
    }

    public function message()
    {
        return 'Stock market works from ' . $this->opens->format('H:i') . ' till ' . $this->closes->format('H:i');
    }
}

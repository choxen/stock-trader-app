<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EnoughStocks implements Rule
{
    private int $userStockQuantity;

    public function __construct(int $userStockQuantity)
    {
        $this->userStockQuantity = $userStockQuantity;
    }

    public function passes($attribute, $value)
    {
        if ($this->userStockQuantity >= $value) {
            return true;
        }
        return false;
    }

    public function message()
    {
        return 'You dont have enough stocks...';
    }
}

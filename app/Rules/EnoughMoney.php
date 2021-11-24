<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EnoughMoney implements Rule
{
    private int $userMoney;
    private int $price;

    public function __construct(int $userMoney, int $price)
    {
        $this->userMoney = $userMoney;
        $this->price = $price;
    }

    public function passes($attribute, $value)
    {
        if ($this->userMoney >= (int)$value * $this->price) {
            return true;
        } else {
            return false;
        }
    }

    public function message()
    {
        return 'You dont have enough money...';
    }
}

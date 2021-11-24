<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StockSold
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $user;
    public string $ticker;
    public int $quantity;
    public int $price;

    public function __construct(User $user, string $ticker, int $quantity, int $price)
    {
        $this->user = $user;
        $this->ticker = $ticker;
        $this->quantity = $quantity;
        $this->price = $price;
    }
}

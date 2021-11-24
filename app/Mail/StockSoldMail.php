<?php

namespace App\Mail;

use App\Models\Stock;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StockSoldMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private User $user;
    private string $ticker;
    private int $quantity;
    private int $price;

    public function __construct(User $user, string $ticker, int $quantity, int $price)
    {
        $this->user = $user;
        $this->ticker = $ticker;
        $this->quantity = $quantity;
        $this->price = $price;
    }

    public function build()
    {
        return $this->subject('Stock Sold')
            ->with([
                'name' => $this->user->name,
                'ticker' => $this->ticker,
                'quantity' => $this->quantity,
                'price' => $this->price
            ])
            ->view('mail.stock-sold');
    }
}

<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StockPurchasedMail extends Mailable implements ShouldQueue
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
        return $this->subject('Stock Purchased')
            ->with([
                'name' => $this->user->name,
                'ticker' => $this->ticker,
                'quantity' => $this->quantity,
                'price' => $this->price * $this->quantity
            ])
            ->view('mail.stock-purchased');
    }
}

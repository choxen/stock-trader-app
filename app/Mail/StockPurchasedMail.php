<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StockPurchasedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $stock;
    private $price;

    public function __construct($stock, $price)
    {
        $this->stock = $stock;
        $this->price = $price;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Stock Purchased')
            ->from(env('MAIL_FROM_ADDRESS'))
            ->with([
                'stock' => $this->stock,
                'price' => $this->price
            ])
            ->view('mail.stock-purchased');
    }
}

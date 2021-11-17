<?php

namespace App\Listeners;

use App\Events\StockPurchased;
use App\Mail\StockPurchasedMail;
use Illuminate\Support\Facades\Mail;

class SendStockPurchasedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param StockPurchased $event
     * @return void
     */
    public function handle(StockPurchased $event)
    {
        Mail::to($event->user->email)
            ->send(new StockPurchasedMail($event->stock, $event->price));
    }
}

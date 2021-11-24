<?php

namespace App\Listeners;

use App\Events\StockPurchased;
use App\Mail\StockPurchasedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class StockPurchasedNotification implements ShouldQueue
{
    public function __construct()
    {
    }

    public function handle(StockPurchased $event)
    {
        Mail::to($event->user->email)
            ->send(new StockPurchasedMail($event->user, $event->ticker, $event->quantity, $event->price));
    }
}

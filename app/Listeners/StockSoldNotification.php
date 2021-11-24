<?php

namespace App\Listeners;

use App\Events\StockSold;
use App\Mail\StockSoldMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class StockSoldNotification implements ShouldQueue
{
    public function __construct()
    {
    }

    public function handle(StockSold $event)
    {
        Mail::to($event->user->email)
            ->send(new StockSoldMail($event->user, $event->ticker, $event->quantity, $event->price));
    }
}

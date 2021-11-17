<?php

namespace App\Providers;

use App\Events\SendEmailEvent;
use App\Events\StockPurchased;
use App\Listeners\SendEmail;
use App\Listeners\SendStockPurchasedNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        StockPurchased::class => [
            SendStockPurchasedNotification::class
        ],
        SendEmailEvent::class => [
            SendEmail::class
        ]
    ];

    public function boot()
    {

    }
}

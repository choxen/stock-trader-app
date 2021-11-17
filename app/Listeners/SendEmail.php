<?php

namespace App\Listeners;

use App\Mail\SendMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    public function __construct()
    {
        //
    }

    public function handle($event)
    {
        Mail::to($event->getEmail())
            ->send(new SendMail());
    }
}

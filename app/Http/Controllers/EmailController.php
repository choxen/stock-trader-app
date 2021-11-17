<?php

namespace App\Http\Controllers;

use App\Events\SendEmailEvent;
use App\Listeners\SendEmail;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function show()
    {
        return view('email');
    }

    public function sendEmail(Request $request)
    {
        event(new SendEmailEvent($request->get('email')));
        return redirect()->route('email', $request->get('email'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TradersController extends Controller
{
    public function transactions(): View
    {
        $transactions = Auth::user()->transactions()->orderBy('created_at', 'DESC')->paginate(10);

        return view('transactions')->with(['transactions' => $transactions]);
    }
}

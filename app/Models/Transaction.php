<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'user_stocks_transactions';

    protected $fillable = [
        'stock',
        'quantity',
        'credits_amount',
        't_type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

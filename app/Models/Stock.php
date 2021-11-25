<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'user_stocks';

    public $timestamps = false;

    protected $fillable = [
        'company',
        'ticker',
        'quantity',
        'total_invested',
        'current_total',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

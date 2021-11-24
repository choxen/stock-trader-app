<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeStockColumnInUserStocks extends Migration
{

    public function up()
    {
        Schema::table('user_stocks', function (Blueprint $table) {
            $table->renameColumn('stock', 'ticker');
        });
    }

    public function down()
    {
        Schema::table('user_stocks', function (Blueprint $table) {
            $table->renameColumn('ticker', 'stock');
        });
    }
}

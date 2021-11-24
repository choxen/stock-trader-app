<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalInvestedToUserStocks extends Migration
{
    public function up()
    {
        Schema::table('user_stocks', function (Blueprint $table) {
            $table->float('total_invested')->default(0);
        });
    }

    public function down()
    {
        Schema::table('user_stocks', function (Blueprint $table) {
            $table->dropColumn('total_invested');
        });
    }
}

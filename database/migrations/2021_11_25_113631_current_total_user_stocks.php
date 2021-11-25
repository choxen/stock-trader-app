<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CurrentTotalUserStocks extends Migration
{
    public function up()
    {
        Schema::table('user_stocks', function (Blueprint $table) {
            $table->float('current_total')->default(0);
        });
    }

    public function down()
    {
        Schema::table('user_stocks', function (Blueprint $table) {
            $table->dropColumn('current_total');
        });
    }
}

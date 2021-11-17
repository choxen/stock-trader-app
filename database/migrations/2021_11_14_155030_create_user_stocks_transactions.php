<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserStocksTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_stocks_transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->index();
            $table->string('stock');
            $table->string('quantity');
            $table->string('credits_amount');
            $table->string('t_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_stocks_transactions');
    }
}

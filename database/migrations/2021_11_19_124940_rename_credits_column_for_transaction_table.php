<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameCreditsColumnForTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_stocks_transactions', function (Blueprint $table) {
            $table->renameColumn('credits_amount', 'money');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('user_stocks_transactions', function (Blueprint $table) {
            $table->renameColumn('money', 'credits_amount');
        });
    }
}

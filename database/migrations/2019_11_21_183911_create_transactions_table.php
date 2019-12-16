<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('transaction_type_id')->unsigned();
            $table->foreign('transaction_type_id')
                ->references('id')
                ->on('transaction_types');

            $table->bigInteger('sender_account_id')->unsigned();
            $table->foreign('sender_account_id')
                ->references('id')
                ->on('accounts');

            $table->bigInteger('receiver_account_id')->unsigned();
            $table->foreign('receiver_account_id')
                ->references('id')
                ->on('accounts');

            $table->softDeletes();
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
        Schema::dropIfExists('transactions');
    }
}

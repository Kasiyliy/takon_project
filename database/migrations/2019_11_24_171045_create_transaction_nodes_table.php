<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_nodes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('transaction_id')->unsigned();
            $table->foreign('transaction_id')
                ->references('id')
                ->on('transactions');

            $table->double('amount')
                ->nullable(false);

            $table->bigInteger('account_company_order_id')->unsigned();
            $table->foreign('account_company_order_id')
                ->references('id')
                ->on('account_company_orders');

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
        Schema::dropIfExists('transaction_nodes');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountCompanyOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_company_orders', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->double('amount')
                ->unsigned()
                ->nullable(false);

            $table->bigInteger('account_id')->unsigned();
            $table->foreign('account_id')
                ->references('id')
                ->on('accounts');

            $table->bigInteger('company_order_id')->unsigned();
            $table->foreign('company_order_id')
                ->references('id')
                ->on('company_orders');

            $table->bigInteger('account_company_order_status_id')->unsigned();
            $table->foreign('account_company_order_status_id')
                ->references('id')
                ->on('account_company_order_statuses');

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
        Schema::dropIfExists('account_company_orders');
    }
}

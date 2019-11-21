<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_orders', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->timestamp('due_date')
                ->nullable(false);

            $table->integer('amount')
                ->unsigned()
                ->nullable(false);

            $table->double('actual_service_price')
                ->unsigned()
                ->nullable(false);

            $table->bigInteger('company_id')->unsigned();
            $table->foreign('company_id')
                ->references('id')
                ->on('companies');

            $table->bigInteger('service_id')->unsigned();
            $table->foreign('service_id')
                ->references('id')
                ->on('services');

            $table->bigInteger('order_status_id')->unsigned();
            $table->foreign('order_status_id')
                ->references('id')
                ->on('order_statuses');

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
        Schema::dropIfExists('company_orders');
    }
}

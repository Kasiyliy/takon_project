<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name')
                ->nullable(false);
            $table->double('price')
                ->nullable(false);

            $table->integer('expiration_days')
                ->unsigned();

            $table->bigInteger('partner_id')
                ->unsigned();
            $table->foreign('partner_id')
                ->references('id')
                ->on('partners');

            $table->bigInteger('service_status_id')->unsigned();
            $table->foreign('service_status_id')
                ->references('id')
                ->on('service_statuses');

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
        Schema::dropIfExists('services');
    }
}

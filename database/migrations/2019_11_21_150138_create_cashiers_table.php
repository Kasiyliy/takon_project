<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashiers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name')
                ->nullable(false);

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                ->on('users')
                ->references('id');

            $table->bigInteger('account_id')->unsigned();
            $table->foreign('account_id')
                ->on('accounts')
                ->references('id');

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
        Schema::dropIfExists('cashiers');
    }
}

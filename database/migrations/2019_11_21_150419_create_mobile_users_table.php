<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobileUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobile_users', function (Blueprint $table) {
            $table->bigIncrements('id');


            $table->string('first_name')
                ->nullable(false);
            $table->string('last_name')
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
        Schema::dropIfExists('mobile_users');
    }
}

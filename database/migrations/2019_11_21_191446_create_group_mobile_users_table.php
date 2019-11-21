<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupMobileUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_mobile_users', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('group_id')
                ->unsigned()
                ->nullable(false);
            $table->foreign('group_id')
                ->references('id')
                ->on('groups');

            $table->bigInteger('mobile_user_id')
                ->unsigned()
                ->nullable(false);
            $table->foreign('mobile_user_id')
                ->references('id')
                ->on('mobile_users');

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
        Schema::dropIfExists('group_mobile_users');
    }
}

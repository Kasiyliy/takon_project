<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    use \Illuminate\Database\Eloquent\SoftDeletes;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('username')
                ->unique()
                ->nullable();

            $table->string('email')
                ->unique()
                ->nullable();

            $table->string('phone_number')
                ->unique()
                ->nullable();

            $table->timestamp('username_verified_at')
                ->nullable();

            $table->string('password');

            $table->string('token')
                ->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToPartners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->text('image_path')->nullable();
        });
    }


    public function down()
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->dropColumn('image_path');
        });
    }
}
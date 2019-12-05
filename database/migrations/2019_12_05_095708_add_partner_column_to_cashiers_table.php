<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPartnerColumnToCashiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cashiers', function (Blueprint $table) {
            $table->bigInteger('partner_id')
                ->unsigned();
            $table->foreign('partner_id', 'fk_cashiers_partners')
                ->on('partners')
                ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cashiers', function (Blueprint $table) {
            $table->dropForeign('fk_cashiers_partners');
            $table->dropColumn('partner_id');
        });
    }
}

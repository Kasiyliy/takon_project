<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddModerationStatusToServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->bigInteger('moderation_status_id')
                ->unsigned();
            $table->foreign('moderation_status_id', 'fk_services_moderation_statuses')
                ->on('moderation_statuses')
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
        Schema::table('services', function (Blueprint $table) {
            $table->dropForeign('fk_services_moderation_statuses');
            $table->dropColumn('moderation_status_id');
        });
    }
}

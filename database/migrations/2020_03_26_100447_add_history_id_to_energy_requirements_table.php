<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHistoryIdToEnergyRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('energy_requirements', function (Blueprint $table) {
            $table->bigInteger('history_id')->unsigned();
            $table->foreign('history_id')->references('id')->on('dietary_histories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('energy_requirements', function (Blueprint $table) {
            $table->dropForeign(['history_id']);
        });
    }
}

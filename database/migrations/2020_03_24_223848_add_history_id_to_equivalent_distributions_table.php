<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHistoryIdToEquivalentDistributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('equivalent_distributions', function (Blueprint $table) {
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
        Schema::table('equivalent_distributions', function (Blueprint $table) {
            $table->dropForeign(['history_id']);
        });
    }
}

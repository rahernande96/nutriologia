<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeVitalSignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vital_signs', function (Blueprint $table) {
            $table->decimal('PAS', 11,2)->nullable()->change();
            $table->decimal('PAD', 11,2)->nullable()->change();
            $table->decimal('breathing_frequency', 11,2)->nullable()->change();
            $table->decimal('body_temperature', 11,2)->nullable()->change();
            $table->decimal('beats_per_minute', 11,2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

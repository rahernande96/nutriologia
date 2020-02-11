<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeBloodChemistriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blood_chemistries', function (Blueprint $table) {
          
            $table->decimal('glucose', 11, 2)->change();
            $table->decimal('proteins', 11, 2)->change();
            $table->decimal('albumin', 11, 2)->change();
            $table->decimal('transferrin', 11, 2)->change();
            $table->decimal('prealbumin', 11, 2)->change();
            $table->decimal('globulin', 11, 2)->change();
            $table->decimal('reason_alb', 11, 2)->change();
            $table->decimal('BUN', 11, 2)->change();
            $table->decimal('creatinine', 11, 2)->change();
            $table->decimal('uric_acid', 11, 2)->change();
            $table->decimal('total_ammonium', 11, 2)->change();
            $table->decimal('Ca', 11, 2)->change();
            $table->decimal('Na', 11, 2)->change();
            $table->decimal('Ka', 11, 2)->change();
            $table->decimal('P', 11, 2)->change();
            $table->decimal('Cl', 11, 2)->change();
            $table->decimal('Mg', 11, 2)->change();
            $table->decimal('CO2', 11, 2)->change();
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

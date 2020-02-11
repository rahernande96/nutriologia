<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBloodChemistriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_chemistries', function (Blueprint $table) {
            $table->unsignedInteger('patient_id');

            $table->foreign('patient_id')
            ->references('id')->on('patients')
            ->onDelete('cascade');

            $table->Increments('id');
            $table->integer('glucose')->nullable();
            $table->integer('proteins')->nullable();
            $table->integer('albumin')->nullable();
            $table->integer('transferrin')->nullable();
            $table->integer('prealbumin')->nullable();
            $table->integer('globulin')->nullable();
            $table->integer('reason_alb')->nullable();
            $table->integer('BUN')->nullable();
            $table->integer('creatinine')->nullable();
            $table->integer('uric_acid')->nullable();
            $table->integer('total_ammonium')->nullable();
            $table->integer('Ca')->nullable();
            $table->integer('Na')->nullable();
            $table->integer('Ka')->nullable();
            $table->integer('P')->nullable();
            $table->integer('Cl')->nullable();
            $table->integer('Mg')->nullable();
            $table->integer('CO2')->nullable();
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
        Schema::dropIfExists('blood_chemistries');
    }
}

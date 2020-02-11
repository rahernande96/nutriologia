<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnergyRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('energy_requirements', function (Blueprint $table) {
            $table->Increments('id');

            $table->unsignedInteger('patient_id');
            $table->integer('period')->nullable()->comment('en caso de estar en periodo de lactancia o embarazo');
            $table->integer('type_get')->comment('Tipo de calculo del GET (rapido, formulas o manual)');
            $table->integer('semestry')->nullable();
            $table->integer('trimestry')->nullable();
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('energy_requirements');
    }
}

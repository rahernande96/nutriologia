<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquivalentDistributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equivalent_distributions', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('patient_id');
            $table->longText('food_groups')->nullable()->comment('arreglo con los grupos de alimentos');
            $table->longText('food_times')->nullable()->comment('arreglo con los tiempos de comidas');
            $table->longText('days')->comment('dias de la semana de dietoterapia');
            $table->date('start_date')->nulled()->comment('fecha de inicio de la dietoterapia');
            $table->date('end_date')->nulled()->comment('fecha de fin de la dietoterapia');
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
        Schema::dropIfExists('equivalent_distributions');
    }
}

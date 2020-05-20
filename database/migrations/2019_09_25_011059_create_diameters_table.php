<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diameters', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('body_measure_id');

            $table->decimal('biepicondilar_humero', 11,2)->nullable();
            $table->decimal('biepicondilar_femur', 11,2)->nullable();
            $table->decimal('biacromial', 11,2)->nullable();
            $table->decimal('biliocrestideo', 11,2)->nullable();
            $table->decimal('longitud_pie', 11,2)->nullable();
            $table->decimal('transverso_torax', 11,2)->nullable();
            $table->decimal('profundidad_anteroposterior_torax', 11,2)->nullable();

            $table->foreign('body_measure_id')->references('id')->on('body_measures')->onDelete('cascade');

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
        Schema::dropIfExists('diameters');
    }
}

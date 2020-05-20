<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBioelectricImpedancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bioelectric_impedances', function (Blueprint $table) {
            $table->Increments('id');

            $table->unsignedInteger('body_measure_id');

            $table->decimal('body_weight', 11,2)->nullable();

            $table->decimal('total_fat_kg', 11,2)->nullable();
            $table->decimal('total_fat_porcent', 11,2)->nullable();

            $table->decimal('upper_fat_kg', 11,2)->nullable();
            $table->decimal('upper_fat_porcent', 11,2)->nullable();

            $table->decimal('lower_fat_kg', 11,2)->nullable();
            $table->decimal('lower_fat_porcent', 11,2)->nullable();

            $table->decimal('visceral_mass_kg', 11,2)->nullable();
            $table->decimal('visceral_mass_porcent', 11,2)->nullable();

            $table->decimal('fat_free_dough_kg', 11,2)->nullable();
            $table->decimal('fat_free_dough_porcent', 11,2)->nullable();

            $table->decimal('muscle_mass_kg', 11,2)->nullable();
            $table->decimal('muscle_mass_porcent', 11,2)->nullable();

            $table->decimal('bone_weight_kg', 11,2)->nullable();
            $table->decimal('bone_weight_porcent', 11,2)->nullable();

            $table->decimal('body_water_l', 11,2)->nullable();
            $table->decimal('body_water_porcent', 11,2)->nullable();

            $table->integer('metabolic_age')->nullable();

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
        Schema::dropIfExists('bioelectric_impedances');
    }
}

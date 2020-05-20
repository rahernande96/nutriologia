<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrequencyConsumptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frequency_consumptions', function (Blueprint $table) {
            $table->unsignedInteger('patient_id');

            $table->foreign('patient_id')
            ->references('id')->on('patients')
            ->onDelete('cascade');

            $table->unsignedInteger('food_group');

            $table->foreign('food_group')
            ->references('id')->on('foods_groups');

            $table->Increments('id');
            $table->string('food_name');
            $table->string('frecuency');
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
        Schema::dropIfExists('frequency_consumptions');
    }
}

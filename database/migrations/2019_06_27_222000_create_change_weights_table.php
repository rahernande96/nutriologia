<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChangeWeightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('change_weights', function (Blueprint $table) {
            $table->unsignedInteger('patient_id');

            $table->foreign('patient_id')
            ->references('id')->on('patients')
            ->onDelete('cascade');

            $table->Increments('id');
            $table->string('max_weight')->nullable();
            $table->string('min_weight')->nullable();
            $table->string('usual_weight')->nullable();
            $table->string('lastMonth')->nullable();
            $table->string('lastThreeMonths')->nullable();
            $table->string('lastSixMonths')->nullable();
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
        Schema::dropIfExists('change_weights');
    }
}

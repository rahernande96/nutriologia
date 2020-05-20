<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToxicHabitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toxic_habits', function (Blueprint $table) {
            $table->unsignedInteger('patient_id');

            $table->foreign('patient_id')
            ->references('id')->on('patients')
            ->onDelete('cascade');

            $table->Increments('id');
            $table->string('tabaquism_frequency')->nullable();
            $table->string('tabaquism_quantity')->nullable();
            $table->string('alcoholism_frequency')->nullable();
            $table->string('alcoholism_quantity')->nullable();
            $table->string('drug_frequency')->nullable();
            $table->string('drug_quantity')->nullable();
            $table->string('coffe_frequency')->nullable();
            $table->string('coffe_quantity')->nullable();
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
        Schema::dropIfExists('toxic_habits');
    }
}

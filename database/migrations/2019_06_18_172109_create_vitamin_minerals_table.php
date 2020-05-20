<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVitaminMineralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vitamin_minerals', function (Blueprint $table) {
            $table->unsignedInteger('patient_id');

            $table->foreign('patient_id')
            ->references('id')->on('patients')
            ->onDelete('cascade');

            $table->Increments('id');
            $table->integer('thiamin')->nullable();
            $table->integer('pyridoxine')->nullable();
            $table->integer('cobalamin')->nullable();
            $table->integer('B12')->nullable();
            $table->integer('folate')->nullable();
            $table->integer('iron')->nullable();
            $table->integer('ferritin')->nullable();
            $table->integer('vitamin_a')->nullable();
            $table->integer('OH')->nullable();
            $table->integer('vitamin_e')->nullable();
            $table->integer('vitamin_k')->nullable();
            $table->integer('zinc')->nullable();
            $table->integer('selenium')->nullable();
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
        Schema::dropIfExists('vitamin_minerals');
    }
}

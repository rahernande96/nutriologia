<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHematicBiometriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hematic_biometries', function (Blueprint $table) {
            $table->unsignedInteger('patient_id');

            $table->foreign('patient_id')
            ->references('id')->on('patients')
            ->onDelete('cascade');

            $table->Increments('id');
            $table->integer('WBC')->nullable();
            $table->integer('RBC')->nullable();
            $table->integer('HGB')->nullable();
            $table->integer('HCT')->nullable();
            $table->integer('VCM')->nullable();
            $table->integer('HCM')->nullable();
            $table->integer('HCM_promedy')->nullable();
            $table->integer('neutrophils')->nullable();
            $table->integer('lymphocytes')->nullable();
            $table->integer('monocytes')->nullable();
            $table->integer('eosinophils')->nullable();
            $table->integer('basophils')->nullable();
            $table->integer('PLT')->nullable();
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
        Schema::dropIfExists('hematic_biometries');
    }
}

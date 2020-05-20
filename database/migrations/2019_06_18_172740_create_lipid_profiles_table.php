<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLipidProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lipid_profiles', function (Blueprint $table) {
            $table->unsignedInteger('patient_id');

            $table->foreign('patient_id')
            ->references('id')->on('patients')
            ->onDelete('cascade');

            $table->Increments('id');

            $table->integer('total_cholesterol')->nullable();
            $table->integer('HDL_cholesterol')->nullable();
            $table->integer('LDL_cholesterol')->nullable();
            $table->integer('triglycerides')->nullable();
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
        Schema::dropIfExists('lipid_profiles');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBriefClinicalHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brief_clinical_history', function (Blueprint $table) {
            $table->Increments('id');

            $table->unsignedInteger('patient_id');

            $table->foreign('patient_id')
            ->references('id')->on('patients')
            ->onDelete('cascade');

            $table->string('symptom')->nullable();
            $table->string('current_pathology')->nullable();
            $table->string('medicines')->nullable();
            $table->string('treatment_frequency')->nullable();
            $table->string('treatment_quantity')->nullable();
            $table->string('treatment_results')->nullable();
            $table->string('pregnancy')->nullable();
            $table->string('contraceptive')->nullable();
            $table->string('surgery')->nullable();
            $table->string('allergy')->nullable();

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
        Schema::dropIfExists('brief_clinical_history');
    }
}

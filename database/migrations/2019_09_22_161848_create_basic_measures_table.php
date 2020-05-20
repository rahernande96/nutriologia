<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBasicMeasuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basic_measures', function (Blueprint $table) {
            $table->Increments('id');

            $table->unsignedInteger('patient_id');
            
            $table->decimal('size', 11,2);
            $table->decimal('weight', 11,2);
            $table->decimal('imc', 11,2);
            $table->boolean('pregnancy');
            $table->integer('gestation_week')->nullable();
            $table->decimal('pregestational_weight', 11,2)->nullable();
            $table->decimal('PeIMCpgEG', 11,2)->nullable();
            $table->decimal('%PeIMCpgEg', 11,2)->nullable();
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
        Schema::dropIfExists('basic_measures');
    }
}

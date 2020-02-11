<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecificDietsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specific_diets', function (Blueprint $table) {
            $table->unsignedInteger('patient_id');

            $table->foreign('patient_id')
            ->references('id')->on('patients')
            ->onDelete('cascade');

            $table->Increments('id');
            $table->string('diet_salad')->nullable();
            $table->string('diet_vegan')->nullable();
            $table->string('diet_crudiverian')->nullable();
            $table->string('diet_ovegetarian')->nullable();
            $table->string('diet_ovolactovegetarian')->nullable();
            $table->string('diet_mediterranean')->nullable();
            $table->string('other')->nullable();
            $table->string('water')->nullable();
            $table->string('vitamins')->nullable();
            $table->string('proteins')->nullable();
            $table->string('aminoacids')->nullable();
            $table->string('none')->nullable();
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
        Schema::dropIfExists('specific_diets');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedings', function (Blueprint $table) {
            $table->unsignedInteger('patient_id');

            $table->foreign('patient_id')
            ->references('id')->on('patients')
            ->onDelete('cascade');

            $table->Increments('id');
            $table->string('salad')->nullable();
            $table->string('red_meat')->nullable();
            $table->string('soup')->nullable();
            $table->string('pasta')->nullable();
            $table->string('vegetable')->nullable();
            $table->string('fruit')->nullable();
            $table->string('vegetarian')->nullable();
            $table->string('vegan')->nullable();
            $table->string('bird')->nullable();
            $table->string('pork')->nullable();
            $table->string('mexican')->nullable();
            $table->string('shellfish')->nullable();
            $table->string('food_not_prefer')->nullable();
            $table->string('alimentary_habits')->nullable();
            $table->string('food_belief')->nullable();
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
        Schema::dropIfExists('feedings');
    }
}

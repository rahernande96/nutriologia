<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodGroupEquivalentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_group_equivalents', function (Blueprint $table) {
            $table->Increments('id');

            $table->unsignedInteger('group_id')->nullable();

            $table->decimal('energy')->nullable();
            $table->decimal('protein')->nullable();
            $table->decimal('lipids')->nullable();
            $table->decimal('carbohydrates')->nullable();

            $table->foreign('group_id')->references('id')->on('foods_groups')->onDelete('cascade');
            
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
        Schema::dropIfExists('food_group_equivalents');
    }
}

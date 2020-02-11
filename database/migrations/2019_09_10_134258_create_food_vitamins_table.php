<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodVitaminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_vitamins', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('food_id');
            $table->decimal('vitamina_A')->nullable();
            $table->decimal('acido_ascorbico')->nullable();
            $table->decimal('acido_folico')->nullable();
            $table->timestamps();

            $table->foreign('food_id')->references('id')->on('foods')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_vitamins');
    }
}

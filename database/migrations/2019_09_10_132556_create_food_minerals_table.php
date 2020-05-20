<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodMineralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_minerals', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('food_id'); 
            $table->decimal('hierro_NO')->nullable(); 
            $table->decimal('potasio')->nullable(); 
            $table->decimal('hierro')->nullable(); 
            $table->decimal('sodio')->nullable(); 
            $table->decimal('calcio')->nullable(); 
            $table->decimal('fosforo')->nullable();  
            $table->decimal('selenio')->nullable();
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
        Schema::dropIfExists('food_minerals');
    }
}

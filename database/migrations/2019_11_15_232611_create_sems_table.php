<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sems', function (Blueprint $table) {
            $table->Increments('id');
            $table->text('food')->nullable();
            $table->unsignedInteger('food_group_id')->nullable();
            $table->decimal('quantity', 11,2)->nullable();	
            $table->text('unity')->nullable();	
            $table->decimal('gross_weight', 11,1)->nullable();	
            $table->decimal('net_weight', 11,1)->nullable();	
            $table->decimal('energy', 11,1)->nullable();	
            $table->decimal('proteins', 11,1)->nullable();	
            $table->decimal('lipids', 11,1)->nullable();	
            $table->decimal('carbohydrates', 11,1)->nullable();	
            $table->decimal('fiber', 11,1)->nullable();	
            $table->decimal('vitamin_A', 11,1)->nullable();	
            $table->decimal('ascorbic_acid', 11,1)->nullable();	
            $table->decimal('folic_acid', 11,1)->nullable();	
            $table->decimal('airon_NO', 11,1)->nullable();	
            $table->decimal('potassium', 11,1)->nullable();	
            $table->decimal('glycemic_iex', 11,1)->nullable();	
            $table->decimal('glycemic_charge', 11,1)->nullable();	
            $table->decimal('sugar_equivalent', 11,1)->nullable();
            $table->timestamps();

            
            $table->foreign('food_group_id')->references('id')->on('foods_groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sems');
    }
}

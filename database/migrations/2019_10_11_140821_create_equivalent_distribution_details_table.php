<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquivalentDistributionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equivalent_distribution_details', function (Blueprint $table) {
            $table->Increments('id');

            $table->unsignedInteger('equivalent_dist_id');
            $table->unsignedInteger('food_group_id');
            //$table->unsignedInteger('food_time_id');

            /*$table->decimal('food_group_equivalent', 11,2)->nullable();
            $table->decimal('food_time_equivalent', 11,2)->nullable();
            $table->decimal('day_missing_equivalent', 11,2)->nullable();*/
            $table->longText('fields')->nullable()->comment('json con arreglo de toda la infomacion de la distribucion');
            
            //$table->integer('day')->nullable();
            /*
            $table->longText('equivalent_food_group')->nullable()->comment('equivalentes por grupo de alimentos');
            $table->longText('equivalent_day_food_time')->nullable()->comment('equivalentes por tiempo de comida');
            $table->longText('missing_equivalent_day_food_group')->nullable()->comment('equivalentes faltantes por dia y grupo de alimentos');*/
            $table->timestamps();

            $table->foreign('equivalent_dist_id')->references('id')->on('equivalent_distributions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equivalent_distribution_details');
    }
}

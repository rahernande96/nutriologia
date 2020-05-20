<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoriesDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dishes', function (Blueprint $table) {
            $table->unsignedInteger('cost_id')->after('notes')->nullable();
            $table->unsignedInteger('style_id')->after('cost_id')->nullable();
            $table->unsignedInteger('temperature_id')->after('style_id')->nullable();
            $table->unsignedInteger('type_id')->after('temperature_id')->nullable();

            $table->foreign('cost_id')->references('id')->on('dish_costs')->onDelete('cascade');
            $table->foreign('style_id')->references('id')->on('dish_styles')->onDelete('cascade');
            $table->foreign('temperature_id')->references('id')->on('dish_temperatures')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('dish_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dishes', function (Blueprint $table) {
            $table->dropForeign(['cost_id']);
            
            $table->dropForeign(['style_id']);
            
            $table->dropForeign(['temperature_id']);
            
            $table->dropForeign(['type_id']);
            
        });
    }
}

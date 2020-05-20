<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProtLipHidratToFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('foods', function (Blueprint $table) {
            $table->decimal('energy')->after('name')->nullable();
            $table->decimal('protein')->after('energy')->nullable();
            $table->decimal('lipids')->after('protein')->nullable();
            $table->decimal('carbohydrates')->after('lipids')->nullable();
            $table->decimal('fiber')->after('carbohydrates')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('foods', function (Blueprint $table) {
            $table->dropColumn('energy');
            $table->dropColumn('protein');
            $table->dropColumn('lipids');
            $table->dropColumn('carbohydrates');
            $table->dropColumn('fiber');
        });
        
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMacrosDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dishes', function (Blueprint $table) {
            $table->decimal('lipids', 11,2)->after('kcal')->nullable();
            $table->decimal('proteins', 11,2)->after('lipids')->nullable();
            $table->decimal('carbohydrates', 11,2)->after('lipids')->nullable();
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
            $table->dropColumn('lipids');
            $table->dropColumn('proteins');
            $table->dropColumn('carbohydrates');
        });
    }
}

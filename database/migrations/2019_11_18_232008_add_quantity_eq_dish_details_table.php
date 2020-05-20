<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQuantityEqDishDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dish_details', function (Blueprint $table) {
            $table->integer('quantity')->after('sem_id')->nullable();
            $table->decimal('eq', 11,2)->after('quantity')->nullable();
            $table->decimal('unity', 11,2)->after('eq')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dish_details', function (Blueprint $table) {
            $table->dropColumn('quantity');
            $table->dropColumn('eq');
            $table->dropColumn('unity');
        });
    }
}

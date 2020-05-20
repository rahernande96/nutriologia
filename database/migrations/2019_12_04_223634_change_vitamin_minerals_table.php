<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeVitaminMineralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vitamin_minerals', function (Blueprint $table) {
          
            
            $table->decimal('thiamin', 11, 2)->change();
            $table->decimal('pyridoxine', 11, 2)->change();
            $table->decimal('cobalamin', 11, 2)->change();
            $table->decimal('B12', 11, 2)->change();
            $table->decimal('folate', 11, 2)->change();
            $table->decimal('iron', 11, 2)->change();
            $table->decimal('ferritin', 11, 2)->change();
            $table->decimal('vitamin_a', 11, 2)->change();
            $table->decimal('OH', 11, 2)->change();
            $table->decimal('vitamin_e', 11, 2)->change();
            $table->decimal('vitamin_k', 11, 2)->change();
            $table->decimal('zinc', 11, 2)->change();
            $table->decimal('selenium', 11, 2)->change();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

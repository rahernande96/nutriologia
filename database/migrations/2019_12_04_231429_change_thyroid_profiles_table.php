<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeThyroidProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('thyroid_profiles', function (Blueprint $table) {
          
            $table->decimal('T4', 11, 2)->change();
            $table->decimal('T4_free', 11, 2)->change();
            $table->decimal('T3_total', 11, 2)->change();
            $table->decimal('TSH', 11, 2)->change();
            
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeUrinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('urines', function (Blueprint $table) {
          
            $table->decimal('amylase', 11, 2)->change();
            $table->decimal('creatinine', 11, 2)->change();
            $table->decimal('urea', 11, 2)->change();
            $table->decimal('Ca', 11, 2)->change();
            $table->decimal('Na', 11, 2)->change();
            $table->decimal('K', 11, 2)->change();

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

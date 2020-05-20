<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeUrineTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('urine_tests', function (Blueprint $table) {
          
            $table->decimal('pH', 11, 2)->change();
            $table->decimal('protein', 11, 2)->change();
            $table->decimal('specific_gravity', 11, 2)->change();
            $table->decimal('glucose', 11, 2)->change();
            $table->decimal('whites_cells', 11, 2)->change();
            $table->decimal('erythrocytes', 11, 2)->change();

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

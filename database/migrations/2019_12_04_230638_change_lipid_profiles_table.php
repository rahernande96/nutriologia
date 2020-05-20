<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeLipidProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lipid_profiles', function (Blueprint $table) {
          
            $table->decimal('total_cholesterol', 11, 2)->change();
            $table->decimal('HDL_cholesterol', 11, 2)->change();
            $table->decimal('LDL_cholesterol', 11, 2)->change();
            $table->decimal('triglycerides', 11, 2)->change();

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

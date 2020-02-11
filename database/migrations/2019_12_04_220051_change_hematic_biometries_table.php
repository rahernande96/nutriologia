<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeHematicBiometriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hematic_biometries', function (Blueprint $table) {
          
            $table->decimal('WBC', 11, 2)->change();
            $table->decimal('RBC', 11, 2)->change();
            $table->decimal('HGB', 11, 2)->change();
            $table->decimal('HCT', 11, 2)->change();
            $table->decimal('VCM', 11, 2)->change();
            $table->decimal('HCM', 11, 2)->change();
            $table->decimal('HCM_promedy', 11, 2)->change();
            $table->decimal('neutrophils', 11, 2)->change();
            $table->decimal('lymphocytes', 11, 2)->change();
            $table->decimal('monocytes', 11, 2)->change();
            $table->decimal('eosinophils', 11, 2)->change();
            $table->decimal('basophils', 11, 2)->change();
            $table->decimal('PLT', 11, 2)->change();
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

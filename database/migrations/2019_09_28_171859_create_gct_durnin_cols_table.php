<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGctDurninColsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gct_durnin_cols', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('gender')->nullable()->comment('sexo del paciente, 1 para Hombre, 2 para Mujer');
            $table->decimal('sum_folds', 11,2)->nullable()->comment('sumatoria de los 4 pliegues');
            $table->decimal('age_17_29', 11,2)->nullable()->comment('Edad entre 17 y 29 anos');
            $table->decimal('age_30_39', 11,2)->nullable()->comment('Edad entre 30 y 39 anos');
            $table->decimal('age_40_49', 11,2)->nullable()->comment('Edad entre 40 y 49 anos');
            $table->decimal('age_more_50', 11,2)->nullable()->comment('Edad mayor o igual a 50 anos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gct_durnin_cols');
    }
}

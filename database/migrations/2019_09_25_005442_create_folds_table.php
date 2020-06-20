<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folds', function (Blueprint $table) {
            $table->Increments('id');

            $table->unsignedInteger('body_measure_id');

            $table->decimal('bicep', 11,3)->nullable();
            $table->decimal('tricep', 11,3)->nullable();
            $table->decimal('subescapular', 11,3)->nullable();
            $table->decimal('suprailiaco', 11,3)->nullable();
            $table->decimal('supraespinal', 11,3)->nullable();
            $table->decimal('abdominal', 11,3)->nullable();
            $table->decimal('muslo_frontal', 11,3)->nullable();
            $table->decimal('pantorrilla_medial', 11,3)->nullable();
            $table->decimal('axilar_medial', 11,3)->nullable();
            $table->decimal('pectoral', 11,3)->nullable();

            $table->foreign('body_measure_id')->references('id')->on('body_measures')->onDelete('cascade');
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
        Schema::dropIfExists('folds');
    }
}

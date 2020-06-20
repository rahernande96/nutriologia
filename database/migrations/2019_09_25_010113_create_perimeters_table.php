<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerimetersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perimeters', function (Blueprint $table) {
            $table->Increments('id');

            $table->unsignedInteger('body_measure_id');

            $table->decimal('muneca', 11,3)->nullable();
            $table->decimal('cintura', 11,3)->nullable();
            $table->decimal('cadera', 11,3)->nullable();
            $table->decimal('brazo_relajado', 11,3)->nullable();
            $table->decimal('brazo_contraido', 11,3)->nullable();
            $table->decimal('pantorrilla', 11,3)->nullable();
            $table->decimal('antebrazo', 11,3)->nullable();
            $table->decimal('cabeza', 11,3)->nullable();
            $table->decimal('cuello', 11,3)->nullable();
            $table->decimal('torax', 11,3)->nullable();
            $table->decimal('muslo', 11,3)->nullable();
            $table->decimal('muslo_medial', 11,3)->nullable();
            $table->decimal('tobilo', 11,3)->nullable();

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
        Schema::dropIfExists('perimeters');
    }
}

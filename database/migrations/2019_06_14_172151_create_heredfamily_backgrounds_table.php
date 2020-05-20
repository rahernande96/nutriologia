<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHeredfamilyBackgroundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('heredfamily_backgrounds', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('DM1')->nullable();
            $table->string('DM2')->nullable();
            $table->string('HAS')->nullable();
            $table->string('Cardiopatías')->nullable();
            $table->string('Aterosclerosis')->nullable();
            $table->string('Osteopenia')->nullable();
            $table->string('Obesidad')->nullable();
            $table->string('Hipotiroidismo')->nullable();
            $table->string('Hipertiroidismo')->nullable();
            $table->string('Gota')->nullable();
            $table->string('Hepatitis')->nullable();
            $table->string('Cáncer')->nullable();
            $table->string('Estreñimiento_Crónico')->nullable();
            $table->string('Gastritis_Crónica')->nullable();
            $table->string('Colitis')->nullable();
            $table->timestamps();

            $table->unsignedInteger('patient_id');

            $table->foreign('patient_id')
            ->references('id')->on('patients')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('heredfamily_backgrounds');
    }
}

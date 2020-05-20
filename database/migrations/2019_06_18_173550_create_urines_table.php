<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urines', function (Blueprint $table) {
            $table->unsignedInteger('patient_id');

            $table->foreign('patient_id')
            ->references('id')->on('patients')
            ->onDelete('cascade');

            $table->bigIncrements('id');
            $table->integer('amylase')->nullable();
            $table->integer('creatinine')->nullable();
            $table->integer('urea')->nullable();
            $table->integer('Ca')->nullable();
            $table->integer('Na')->nullable();
            $table->integer('K')->nullable();
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
        Schema::dropIfExists('urines');
    }
}

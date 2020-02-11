<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('user_id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('picture')->default('default.png');
            $table->string('address');
            $table->string('city');
            $table->date('birthdate');
            $table->integer('age');
            $table->string('phone_1');
            $table->string('phone_2')->nullable();
            $table->string('email');
            $table->string('gender');
            $table->integer('trimester')->nullable();
            $table->integer('semester')->nullable();
            $table->integer('sdg')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('size')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')->on('users')
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
        Schema::dropIfExists('patients');
    }
}

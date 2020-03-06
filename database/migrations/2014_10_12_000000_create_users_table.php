<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('rols',function(Blueprint $table){
            $table->Increments('id');
            $table->string('rol');
            $table->longText('description')->nullable();
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('picture')->default('default.png');
            //$table->string('role')->default('user');
            $table->unsignedInteger('role_id')->default(\App\Rol::DOCTOR);
            $table->foreign('role_id')->references('id')->on('rols')->onDelete('cascade');
            $table->boolean('status')->default(1);
            $table->string('email')->unique();
            $table->string('confirmation_code')->nullable();
            $table->boolean('confirmed')->default(0);
            $table->boolean('sex')->default(0);
            $table->time('date_birth');    
            $table->string('no_registry');
            $table->string('identification_card');
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('rols');
    }
}

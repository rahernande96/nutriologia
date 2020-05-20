<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mets', function (Blueprint $table) {
            $table->Increments('id');
            $table->text('actividad')->comment('actividad del met');
            $table->string('categoria')->comment('categoria del met');
            $table->decimal('met', 4,1)->comment('valor del met');
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
        Schema::dropIfExists('mets');
    }
}

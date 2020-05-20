<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReminderFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reminder_foods', function (Blueprint $table) {
            $table->Increments('id');

            $table->unsignedInteger('reminder_item_id')->nullable();
            $table->unsignedInteger('group_id')->nullable();
            $table->unsignedInteger('food_id')->nullable();

            $table->string('quantity')->nullable();
            $table->string('unity')->nullable();

            $table->foreign('reminder_item_id')->references('id')->on('reminder_items')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('foods_groups')->onDelete('cascade');
            $table->foreign('food_id')->references('id')->on('foods')->onDelete('cascade');

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
        Schema::dropIfExists('reminder_foods');
    }
}

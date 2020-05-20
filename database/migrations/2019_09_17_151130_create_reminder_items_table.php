<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReminderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reminder_items', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('reminder_id')->nullable();
            $table->unsignedInteger('food_time_id')->nullable();
            //$table->unsignedInteger('group_id')->nullable();
            //$table->unsignedInteger('food_id')->nullable();

            $table->string('food_hour')->nullable();
            $table->string('food_site')->nullable();
            $table->string('food_who')->nullable();
            //$table->string('quantity')->nullable();
            //$table->string('unity')->nullable();

            $table->foreign('reminder_id')->references('id')->on('reminders')->onDelete('cascade');
            $table->foreign('food_time_id')->references('id')->on('food_times')->onDelete('cascade');
            //$table->foreign('group_id')->references('id')->on('foods_groups')->onDelete('cascade');
            //$table->foreign('food_id')->references('id')->on('foods')->onDelete('cascade');
            
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
        Schema::dropIfExists('reminder_items');
    }
}

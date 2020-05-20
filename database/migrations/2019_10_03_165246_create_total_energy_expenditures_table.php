<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTotalEnergyExpendituresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('total_energy_expenditures', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('energy_requirement_id')->nullable();
            $table->decimal('kcal', 11,2)->nullable();
            $table->decimal('get', 11,2)->nullable();
            $table->integer('supplement')->nullable();
            $table->decimal('supplement_value', 11, 2)->nullable();
            $table->integer('method_water_requirement')->nullable();
            $table->decimal('water_requirement', 11,2)->nullable();
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
        Schema::dropIfExists('total_energy_expenditures');
    }
}

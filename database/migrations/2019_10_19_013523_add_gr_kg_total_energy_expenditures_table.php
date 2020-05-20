<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGrKgTotalEnergyExpendituresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('total_energy_expenditures', function (Blueprint $table) {
            $table->decimal('gr_kg_proteins', 11,2)->after('percentage_lipids')->nullable();
            //$table->renameColumn('gr_kg', 'gr_kg_proteins');
            $table->decimal('gr_kg_lipids', 11,2)->nullable();
            $table->decimal('gr_kg_carbohydrates', 11,2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('total_energy_expenditures', function (Blueprint $table) {
            $table->dropColumn('gr_kg_proteins');
            $table->dropColumn('gr_kg_lipids');
            $table->dropColumn('gr_kg_carbohydrates');
        });
    }
}

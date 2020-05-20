<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWaterRequiementsTotalEnergyExpendituresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('total_energy_expenditures', function (Blueprint $table) {
            $table->decimal('water_requirement_ml_kcal', 11,2)->after('method_water_requirement')->nullable();
            $table->decimal('water_requirement_manual', 11,2)->after('water_requirement_ml_kcal')->nullable();
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
            $table->dropColumn('water_requirement_ml_kcal');
            $table->dropColumn('water_requirement_manual');
        });
    }
}

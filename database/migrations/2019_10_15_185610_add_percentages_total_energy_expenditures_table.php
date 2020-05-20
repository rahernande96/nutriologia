<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPercentagesTotalEnergyExpendituresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('total_energy_expenditures', function (Blueprint $table) {
            $table->decimal('percentage_carbohydrates', 11,2)->after('kcal')->nullable();
            $table->decimal('percentage_protein', 11, 2)->after('percentage_carbohydrates')->nullable();
            $table->decimal('percentage_lipids', 11, 2)->after('percentage_protein')->nullable();
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
            $table->dropColumn('percentage_carbohydrates');
            $table->dropColumn('percentage_protein');
            $table->dropColumn('percentage_lipids');
        });
    }
}

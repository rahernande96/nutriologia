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
        Schema::dropColumn('percentage_carbohydrates');
        Schema::dropColumn('percentage_protein');
        Schema::dropColumn('percentage_lipids');
    }
}

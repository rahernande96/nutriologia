<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsFormulaTotalEnergyExpedituresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('total_energy_expenditures', function (Blueprint $table) {
            $table->integer('weight_type')->after('water_requirement')->nullable();
            $table->decimal('weight', 11,2)->after('weight_type')->nullable();
            $table->integer('formula')->after('weight')->nullable();
            $table->integer('thermic_effect')->after('formula')->nullable();
            $table->integer('stress_factor')->after('thermic_effect')->nullable();
            $table->integer('stress_factor_type')->after('stress_factor')->nullable();
            $table->integer('fisic_activity')->after('stress_factor')->nullable();
            $table->integer('met_id')->after('fisic_activity')->nullable();
            $table->decimal('activity_time', 11,2)->after('met_id')->nullable();
            $table->decimal('met', 11,2)->after('activity_time')->nullable();
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
            $table->dropColumn('weight_type');
            $table->dropColumn('weight');
            $table->dropColumn('formula');
            $table->dropColumn('thermic_effect');
            $table->dropColumn('stress_factor');
            $table->dropColumn('stress_factor_type');
            $table->dropColumn('fisic_activity');
            $table->dropColumn('met_id');
            $table->dropColumn('activity_time');
            $table->dropColumn('met');
        });
        
    }
}

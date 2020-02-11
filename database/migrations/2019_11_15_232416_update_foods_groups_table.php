<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFoodsGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('foods_groups')->insert(
            array(
                [
                    'name' => 'Cerales sin grasa' //6
                ],
                [
                    'name'  => 'Cereales con grasa' //7
                ],
                [
                    'name'  => 'leguminosas' //()
                ],
                [
                    'name'  => 'Alimentos de origen animal bajos en grasa'
                ],
                [
                    'name'  => 'Alimentos de origen animal muy bajos en grasa'
                ],
                [
                    'name'  => 'Alimentos de origen animal muy bajos en grasa'
                ],
                [
                    'name'  => 'Alimentos de origen animal altos en grasa'
                ],
                [
                    'name'  => 'Leche descremada'
                ],
                [
                    'name'  => 'Leche semidescremada'
                ],
                [
                    'name'  => 'Leche entera'
                ]
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

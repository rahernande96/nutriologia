<?php

use App\FoodGroup;
use Illuminate\Database\Seeder;

class GroupsFoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FoodGroup::create([
        	'name' => 'VERDURAS'
        ]);

        FoodGroup::create([
        	'name' => 'FRUTAS'
        ]);

        FoodGroup::create([
        	'name' => 'CEREALES Y TUBÉRCULOS'
        ]);

        FoodGroup::create([
        	'name' => 'CEREALES CON GRASA'
        ]);

        FoodGroup::create([
        	'name' => 'LEGUMINOSAS'
        ]);

        FoodGroup::create([
            'name' => 'AOA MUY BAJO APORTE DE GRASA'
        ]);

        FoodGroup::create([
            'name' => 'AOA BAJO APORTE DE GRASA'
        ]);

        FoodGroup::create([
            'name' => 'AOA MODERADO APORTE DE GRASA'
        ]);

        FoodGroup::create([
            'name' => 'AOA ALTO APORTE DE GRASA'
        ]);

        FoodGroup::create([
            'name' => 'LECHE'
        ]);

        FoodGroup::create([
            'name' => 'LECHE SEMIDESCREMADA'
        ]);

        FoodGroup::create([
            'name' => 'LECHE ENTERA'
        ]);

        FoodGroup::create([
            'name' => 'LECHE CON AZÚCAR'
        ]);

        FoodGroup::create([
            'name' => 'ACEITES Y GRASAS'
        ]);

        FoodGroup::create([
            'name' => 'ACEITES Y GRASAS CON PROTEINA'
        ]);

        FoodGroup::create([
            'name' => 'AZÚCARES SIN GRASA'
        ]);

        FoodGroup::create([
            'name' => 'AZÚCARES CON GRASA'
        ]);

    }
}














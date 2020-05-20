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
        	'name' => 'CEREALES SIN GRASA'
        ]);

        FoodGroup::create([
        	'name' => 'CEREALES CON GRASA'
        ]);

        FoodGroup::create([
        	'name' => 'LEGUMINOSAS'
        ]);

        FoodGroup::create([
            'name' => 'ALIMENTOS DE ORIGEN ANIMAL MUY BAJO APORTE DE GRASA'
        ]);

        FoodGroup::create([
            'name' => 'ALIMENTOS DE ORIGEN ANIMAL BAJO APORTE DE GRASA'
        ]);

        FoodGroup::create([
            'name' => 'ALIMENTOS DE ORIGEN ANIMAL MODERADO APORTE DE GRASA'
        ]);

        FoodGroup::create([
            'name' => 'ALIMENTOS DE ORIGEN ANIMAL ALTO APORTE DE GRASA'
        ]);

        FoodGroup::create([
            'name' => 'LECHE DESCREMADA'
        ]);

        FoodGroup::create([
            'name' => 'LECHE ENTERA'
        ]);

        FoodGroup::create([
            'name' => 'LECHE SEMIDESCREMADA'
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
            'name' => 'ACEITES SIN GRASAS'
        ]);

        FoodGroup::create([
            'name' => 'ACEITES CON GRASAS'
        ]);

        FoodGroup::create([
            'name' => 'ALIMENTOS LIBRES EN ENERGÍA'
        ]);

        FoodGroup::create([
            'name' => 'BEBIDAS ALCOHOLICAS'
        ]);

        FoodGroup::create([
            'name' => 'PRODUTOS YAKULT'
        ]);

        FoodGroup::create([
            'name' => 'PLATILLOS'
        ]);
        
        FoodGroup::create([
            'name' => 'COMIDA RAPIDA'
        ]);
    }
}














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
        	'name' => 'AOA moderado aporte en grasa'
        ]);

        FoodGroup::create([
        	'name' => 'Leche con azúcar'
        ]);

        FoodGroup::create([
        	'name' => 'Aceites y grasas'
        ]);

        FoodGroup::create([
        	'name' => 'Aceites y grasas con proteinas'
        ]);

        FoodGroup::create([
        	'name' => 'Azucares sin grasa'
        ]);

        FoodGroup::create([
            'name' => 'Azucares con grasa'
        ]);

        FoodGroup::create([
            'name' => 'Alimentos libres en energias'
        ]);

        FoodGroup::create([
            'name' => 'Bebidas Alcoholicas'
        ]);

        FoodGroup::create([
            'name' => 'Productos Yakult'
        ]);

        FoodGroup::create([
            'name' => 'Platillos'
        ]);

        FoodGroup::create([
            'name' => 'Comida Rapida'
        ]);
    }
}

<?php

use App\FoodGroupEquivalent;
use Illuminate\Database\Seeder;

class FoodGroupEquivalentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //VERDURAS
        FoodGroupEquivalent::create([
            'group_id'      => 1,
            'energy'        => 25,
            'protein'       => 2,
            'lipids'        => 0,
            'carbohydrates' => 4
        ]);
        //FRUTAS
        FoodGroupEquivalent::create([
            'group_id'      => 2,
            'energy'        => 60,
            'protein'       => 0,
            'lipids'        => 0,
            'carbohydrates' => 15
        ]);
        //CEREALES Y TUBÉRCULOS
        FoodGroupEquivalent::create([
            'group_id'      => 3,
            'energy'        => 70,
            'protein'       => 2,
            'lipids'        => 0,
            'carbohydrates' => 15
        ]);
        //CEREALES CON GRASA

        FoodGroupEquivalent::create([
            'group_id'      => 4,
            'energy'        => 115,
            'protein'       => 2,
            'lipids'        => 5,
            'carbohydrates' => 15
        ]);
        //LEGUMINOSAS
        FoodGroupEquivalent::create([
            'group_id'      => 5,
            'energy'        => 120,
            'protein'       => 8,
            'lipids'        => 1,
            'carbohydrates' => 20
        ]);
        //AOA MUY BAJO APORTE DE GRASA
        FoodGroupEquivalent::create([
            'group_id'      => 6,
            'energy'        => 40,
            'protein'       => 7,
            'lipids'        => 1,
            'carbohydrates' => 0
        ]);
        //AOA BAJO APORTE DE GRASA
        FoodGroupEquivalent::create([
            'group_id'      => 7,
            'energy'        => 55,
            'protein'       => 7,
            'lipids'        => 3,
            'carbohydrates' => 0
        ]);
        //AOA MODERADO APORTE DE GRASA
        FoodGroupEquivalent::create([
            'group_id'      => 8,
            'energy'        => 75,
            'protein'       => 7,
            'lipids'        => 5,
            'carbohydrates' => 0
        ]);
        //AOA ALTO APORTE DE GRASA
        FoodGroupEquivalent::create([
            'group_id'      => 9,
            'energy'        => 100,
            'protein'       => 7,
            'lipids'        => 8,
            'carbohydrates' => 0
        ]);
        //LECHE
        FoodGroupEquivalent::create([
            'group_id'      => 10,
            'energy'        => 95,
            'protein'       => 9,
            'lipids'        => 2,
            'carbohydrates' => 12
        ]);
        //LECHE SEMIDESCREMADA
        FoodGroupEquivalent::create([
            'group_id'      => 11,
            'energy'        => 110,
            'protein'       => 9,
            'lipids'        => 4,
            'carbohydrates' => 12
        ]);
        //LECHE ENTERA
        FoodGroupEquivalent::create([
            'group_id'      => 12,
            'energy'        => 150,
            'protein'       => 9,
            'lipids'        => 8,
            'carbohydrates' => 12
        ]);
        //LECHE CON AZÚCAR
        FoodGroupEquivalent::create([
            'group_id'      => 13,
            'energy'        => 200,
            'protein'       => 8,
            'lipids'        => 5,
            'carbohydrates' => 30
        ]);
        //ACEITES Y GRASAS
        FoodGroupEquivalent::create([
            'group_id'      => 14,
            'energy'        => 45,
            'protein'       => 0,
            'lipids'        => 5,
            'carbohydrates' => 0
        ]);
        //ACEITES Y GRASAS CON PROTEÍNA
        FoodGroupEquivalent::create([
            'group_id'      => 15,
            'energy'        => 70,
            'protein'       => 3,
            'lipids'        => 5,
            'carbohydrates' => 3
        ]);
        //AZÚCARES SIN GRASA
        FoodGroupEquivalent::create([
            'group_id'      => 16,
            'energy'        => 40,
            'protein'       => 0,
            'lipids'        => 0,
            'carbohydrates' => 10
        ]);
        //AZÚCARES CON GRASA
        FoodGroupEquivalent::create([
            'group_id'      => 17,
            'energy'        => 85,
            'protein'       => 0,
            'lipids'        => 5,
            'carbohydrates' => 10
        ]);
        

    }
}

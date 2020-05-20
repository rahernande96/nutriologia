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
        FoodGroupEquivalent::create([
            'group_id'      => 11,
            'energy'        => 0,
            'protein'       => 0,
            'lipids'        => 0,
            'carbohydrates' => 0
        ]);

        FoodGroupEquivalent::create([
            'group_id'      => 12,
            'energy'        => 140,
            'protein'       => 0,
            'lipids'        => 0,
            'carbohydrates' => 20
        ]);

        FoodGroupEquivalent::create([
            'group_id'      => 13,
            'energy'        => 60,
            'protein'       => 0,
            'lipids'        => 0,
            'carbohydrates' => 15
        ]);

        FoodGroupEquivalent::create([
            'group_id'      => 14,
            'energy'        => 120,
            'protein'       => 8,
            'lipids'        => 1,
            'carbohydrates' => 20
        ]);

        FoodGroupEquivalent::create([
            'group_id'      => 15,
            'energy'        => 25,
            'protein'       => 2,
            'lipids'        => 0,
            'carbohydrates' => 4
        ]);

        FoodGroupEquivalent::create([
            'group_id'      => 16,
            'energy'        => 75,
            'protein'       => 7,
            'lipids'        => 5,
            'carbohydrates' => 0
        ]);

        FoodGroupEquivalent::create([
            'group_id'      => 17,
            'energy'        => 200,
            'protein'       => 8,
            'lipids'        => 5,
            'carbohydrates' => 30
        ]);

        FoodGroupEquivalent::create([
            'group_id'      => 18,
            'energy'        => 45,
            'protein'       => 0,
            'lipids'        => 5,
            'carbohydrates' => 0
        ]);

        FoodGroupEquivalent::create([
            'group_id'      => 19,
            'energy'        => 70,
            'protein'       => 3,
            'lipids'        => 5,
            'carbohydrates' => 3
        ]);

        FoodGroupEquivalent::create([
            'group_id'      => 20,
            'energy'        => 40,
            'protein'       => 0,
            'lipids'        => 0,
            'carbohydrates' => 10
        ]);

        FoodGroupEquivalent::create([
            'group_id'      => 21,
            'energy'        => 85,
            'protein'       => 0,
            'lipids'        => 5,
            'carbohydrates' => 10
        ]);

        
    }
}

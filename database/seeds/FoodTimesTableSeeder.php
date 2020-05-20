<?php

use App\FoodTime;
use Illuminate\Database\Seeder;

class FoodTimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FoodTime::create([
            'name'  => 'Desayuno'
        ]);

        FoodTime::create([
            'name'  => 'Colación matutina'
        ]);

        FoodTime::create([
            'name'  => 'Comida'
        ]);

        FoodTime::create([
            'name'  => 'Colación vespertina'
        ]);

        FoodTime::create([
            'name'  => 'Cena'
        ]);
    }
}

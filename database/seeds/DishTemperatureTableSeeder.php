<?php
use App\DishTemperature;
use Illuminate\Database\Seeder;

class DishTemperatureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DishTemperature::create([
            'name'      => 'caliente'
        ]);

        DishTemperature::create([
            'name'      => 'fresca'
        ]);
    }
}

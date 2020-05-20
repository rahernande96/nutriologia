<?php
use App\DishCost;
use Illuminate\Database\Seeder;

class DishCostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DishCost::create([
            'name'      => 'media'
        ]);

        DishCost::create([
            'name'      => 'economica'
        ]);
    }
}

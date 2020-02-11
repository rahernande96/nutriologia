<?php
use App\DishCost;
use Illuminate\Database\Seeder;

class NewDishCostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DishCost::create([
            'name'      => 'alto'
        ]);
    }
}

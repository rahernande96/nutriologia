<?php
use App\DishStyle;
use Illuminate\Database\Seeder;

class DishStyleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DishStyle::create([
            'name'      => 'clasico'
        ]);

        DishStyle::create([
            'name'      => 'gourmet'
        ]);

        DishStyle::create([
            'name'      => 'para llevar'
        ]);
    }
}

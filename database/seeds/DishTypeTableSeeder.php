<?php
use App\DishType;
use Illuminate\Database\Seeder;

class DishTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DishType::create([
            'name'      => 'proteica'
        ]);

        DishType::create([
            'name'      => 'vegetariana'
        ]);

        DishType::create([
            'name'      => 'ovolacteo'
        ]);

        DishType::create([
            'name'      => 'ensalada'
        ]);
    }
}

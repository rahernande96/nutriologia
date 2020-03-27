<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolsTableSeeder::class,
            UsersTableSeeder::class,
            GroupsFoodsTableSeeder::class,
            //FoodsTableSeeder::class,
            //FoodVitaminsTableSeeder::class,
            //FoodMineralsTableSeeder::class,
            //FoodGroupEquivalentsTableSeeder::class,
            FoodTimesTableSeeder::class,
            GctDurminColTableSeeder::class,
            DishCostTableSeeder::class,
            DishStyleTableSeeder::class,
            DishTemperatureTableSeeder::class,
            DishTypeTableSeeder::class,
            MetsTableSeeder::class,
            //SemTableSeeder::class,
            NewDishCostTableSeeder::class,
            PaymentMethodSeeder::class,
            SubscriptionPaymentMethodSeeder::class
        ]);
    }
}

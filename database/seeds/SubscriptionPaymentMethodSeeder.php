<?php

use Illuminate\Database\Seeder;
use App\SubscriptionPaymentMethod;

class SubscriptionPaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubscriptionPaymentMethod::create([
            'name'=>'Stripe',
        ]);

        SubscriptionPaymentMethod::create([
            'name'=>'PayPal',
        ]);
    }
}

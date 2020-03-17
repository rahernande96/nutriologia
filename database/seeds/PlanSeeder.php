<?php

use Illuminate\Database\Seeder;
use App\Plan;
use App\Http\Controllers\Paypal\PlanController;
use App\SubscriptionPaymentMethod;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Eliminar todos los planes
        plan::truncate();

        //obtener todos los planes de paypal
        /*
        $obj = new PlanController;
        
        $plans = $obj->index()->plans; 
        
        $paymentMethod = SubscriptionPaymentMethod::where('name','PayPal')->first();

        if (is_array($plans) && isset($plans[0]->id)) {

            foreach($plans as $plan)
            {
                $planDetails = $obj->show($plan->id);    
                
                Plan::create([
                    'name'=>$planDetails->name,
                    'plan_id'=>$planDetails->id,
                    'payment_method_id'=>isset($paymentMethod->id) ? $paymentMethod->id : null,
                    'currency_code'=>$planDetails->payment_preferences->setup_fee->currency_code,
                    'value'=>$planDetails->payment_preferences->setup_fee->value,
                ]);
            }
        }*/

        $obj = new PlanController;
        
        $plans = $obj->create();

        //obtener todos los planes de stripe
    }
}

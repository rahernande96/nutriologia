<?php

use Illuminate\Database\Seeder;
use App\Plan;
use App\Http\Controllers\Paypal\PlanController;
use App\SubscriptionPaymentMethod;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

class PlanSeeder extends Seeder
{

    public $apiContext;

    function __construct() {

		$this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                env('PAYPAL_CLIENT_ID'), 
                env('PAYPAL_SECRET_ID')
            )
        );

        $this->apiContext->setConfig(
            array(
              'mode' => 'sandbox',
            )
        );
	}
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Eliminar todos los planes
        //plan::truncate();

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

        //$obj = new PlanController;
        
        //$plans = $obj->create();

        //obtener todos los planes de stripe


        $plan = new \PayPal\Api\Plan();
        $plan->setName("Plan Basic")
            ->setDescription("Servicio de nutriologia")
            ->setType('INFINITE');

        // Set billing plan definitions
        $paymentDefinition = new \PayPal\Api\PaymentDefinition();
        $paymentDefinition->setName('Regular Payments')
            ->setType('REGULAR')
            ->setFrequency('Year')
            ->setFrequencyInterval('1')
            ->setAmount(new \PayPal\Api\Currency(array(
            'value' => 1200,
            'currency' => 'MXN'
        )));

        // Set merchant preferences
        $merchantPreferences = new \PayPal\Api\MerchantPreferences();
        $merchantPreferences->setReturnUrl(route('paypal.success'))
            ->setCancelUrl(route('paypal.cancel'))
            ->setAutoBillAmount('yes')
            ->setInitialFailAmountAction('CONTINUE')
            ->setSetupFee(new \PayPal\Api\Currency(array('value' => 1200, 'currency' => 'MXN')));

        $plan->setPaymentDefinitions(array(
            $paymentDefinition
        ));
        $plan->setMerchantPreferences($merchantPreferences);

        try {
            $createdPlan = $plan->create($this->apiContext);
        
            $paymentMethod = \App\SubscriptionPaymentMethod::where('name','PayPal')->first();
        
            \App\Plan::create([
                'name'=>$createdPlan->name,
                'plan_id'=>$createdPlan->id,
                'payment_method_id'=>isset($paymentMethod->id) ? $paymentMethod->id : null,
                'currency_code'=>$createdPlan->payment_definitions[0]->amount->currency,
                'value'=>$createdPlan->payment_definitions[0]->amount->value,
            ]); 

            $patch = new \PayPal\Api\Patch();
        
            $value = new \PayPal\Common\PayPalModel('{
               "state":"ACTIVE"
             }');
        
            $patch->setOp('replace')
                ->setPath('/')
                ->setValue($value);
            $patchRequest = new \PayPal\Api\PatchRequest();
            $patchRequest->addPatch($patch);
        
            $createdPlan->update($patchRequest, $this->apiContext);
        

        } catch (\Exception $ex) {
            dd($ex->getMessage());
            
            return "error";

        }


    }
}

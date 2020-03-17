<?php

namespace App\Http\Controllers\Paypal;

use PayPal\Api\Plan;
use PayPal\Api\Patch;
use App\Plan as PlanDB;
use PayPal\Api\Currency;
use PayPal\Api\ChargeModel;
use PayPal\Rest\ApiContext;
use Illuminate\Http\Request;
use PayPal\Api\PatchRequest;
use PayPal\Common\PayPalModel;
use PayPal\Api\PaymentDefinition;
use App\SubscriptionPaymentMethod;
use PayPal\Api\MerchantPreferences;
use App\Http\Controllers\Controller;
use PayPal\Auth\OAuthTokenCredential;
use App\Http\Traits\GetPaypalClientCredential;

class PlanController extends Controller
{
    use GetPaypalClientCredential;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ch = curl_init();

        $base_url = $this->enviroment();

        curl_setopt($ch, CURLOPT_URL, $base_url.'/v1/billing/plans?page_size=2&page=1&total_required=true');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: Bearer '.$this->getClientCredentials()->access_token;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        return json_decode($result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plan = new Plan();
        $plan->setName("Plan Basic")
            ->setDescription("Servicio de nutriologia")
            ->setType('INFINITE');

        // Set billing plan definitions
        $paymentDefinition = new PaymentDefinition();
        $paymentDefinition->setName('Regular Payments')
            ->setType('REGULAR')
            ->setFrequency('Year')
            ->setFrequencyInterval('1')
            ->setAmount(new Currency(array(
            'value' => 1200,
            'currency' => 'MXN'
        )));

        // Set merchant preferences
        $merchantPreferences = new MerchantPreferences();
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
        
            $this->store($createdPlan);

            $createdPlan = $this->activatePlan($createdPlan);

        } catch (\Exception $ex) {
            dd($ex->getMessage());
            
            return "error";

        }

        return dd($createdPlan);

       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $createdPlan
     */
    public function store($createdPlan)
    {
        $paymentMethod = SubscriptionPaymentMethod::where('name','PayPal')->first();
        
        PlanDB::create([
            'name'=>$createdPlan->name,
            'plan_id'=>$createdPlan->id,
            'payment_method_id'=>isset($paymentMethod->id) ? $paymentMethod->id : null,
            'currency_code'=>$createdPlan->payment_definitions[0]->amount->currency,
            'value'=>$createdPlan->payment_definitions[0]->amount->value,
        ]);      

    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ch = curl_init();

        $base_url = $this->enviroment();

        curl_setopt($ch, CURLOPT_URL, $base_url.'/v1/billing/plans/'.$id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: Bearer '.$this->getClientCredentials()->access_token;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        return json_decode($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function activatePlan($createdPlan)
    {
        try {
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
        
            return $createdPlan = \PayPal\Api\Plan::get($createdPlan->getId(), $this->apiContext);
        } catch (\Exception $ex) {
                $ex->getMessage();
            die();
        }

        return $createdPlan;
    }
}

<?php

namespace App\Http\Controllers;

use App\Plan;
use PayPal\Api\Agreement;
use App\PaypalSubscription;
use PayPal\Rest\ApiContext;
use Illuminate\Http\Request;
use App\Http\Traits\PaypalWebhook;
use Illuminate\Support\Facades\Auth;
use PayPal\Auth\OAuthTokenCredential;
use App\Http\Traits\GetPaypalClientCredential;
use App\Http\Traits\PaypalSubscriptionManager;

class PaypalSubscriptionController extends Controller
{
    use PaypalSubscriptionManager, PaypalWebhook;

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
    
    public function store(Request $request)
    {

        
        $user = Auth::user();

        $subscription = $user->paypalSubscription();

        if ($user->role_id == 1) {

            return redirect()->route('Dashboard');
        }

        if(isset($subscription->paypal_status))
        {
            if($subscription->paypal_status == "Active" || $subscription->paypal_status == "Pending")
            {
                alert()->error('Tienes una subscripcion activa o pendiente, no puedes realizar esta accion.', 'Error')->persistent('Close');
                return back();
            }
        }
        
        $plan = Plan::whereHas('SubscriptionPaymentMethod',function($query){

            return $query->where('name','PayPal');

        })
        ->latest()
        ->first();
        //dd($plan);
        //create agreement
        $agreement = $this->agreement($plan->plan_id);

        //add Payer 
        $agreement = $this->addPayer($agreement,$user);

        //call api
        try {
            $agreement = $agreement->create($this->apiContext);
            
        } catch (\Exception $ex) {
            echo $ex->getCode(); // Prints the Error Code
            //echo $ex->getData(); // Prints the detailed error message 
        }

        // Get redirect url
        $approvalUrl = $agreement->getApprovalLink();
        //dd($agreement);
        return redirect($approvalUrl);

        //Mandamos el correo de confirmación de pago
        //Mail::to($user->email)->send(new PaymentSuccess($user));

        //Logueamos al usuario despues de crearlo

        //return redirect()->route('Dashboard')->with('success', 'Pago realizado correctamente');

		
    }

    public function agreement($id)
    {
        $agreement = new \PayPal\Api\Agreement();

        $agreement->setName('Subscription nutriologia')
            ->setDescription('Recurring payment of $1200 MXN on the ' . date('jS') . ' of every month.')
            // set the start date to 1 month from now as we take our first payment via the setup fee
            ->setStartDate(gmdate("Y-m-d\TH:i:s\Z", strtotime("+1 year", time())));

        // Link the plan up with the agreement
        $plan = new \PayPal\Api\Plan();
        $plan->setId($id);
        $agreement->setPlan($plan);

        return $agreement;
    
    }

    public function addPayer($agreement,$user)
    {
        $payerInfo = new \PayPal\Api\PayerInfo();
        $payerInfo->setEmail($user->email);

        $payer = new \PayPal\Api\Payer();
        $payer->setPaymentMethod('paypal')
              ->setPayerInfo($payerInfo);
        
        $agreement->setPayer($payer);
        
        return $agreement;
    }

    public function success(Request $request)
    {
        
        if (!empty($request->get('token'))) {
            // paypal was successful but the payment still needs processing
            $token = $request->get('token');
    
            $agreement = new \PayPal\Api\Agreement();
            try {
                // Execute the agreement by passing in the token
                $agreement->execute($token, $this->apiContext);

                if($agreement->state == "Active" || $agreement->state == "Pending")
                {
                    $user = Auth::user();

                    $plan = Plan::whereHas('SubscriptionPaymentMethod',function($query){

                        return $query->where('name','PayPal');
            
                    })
                    ->latest()
                    ->first();

                    if($subscription = PaypalSubscription::where('paypal_id',$agreement->id)->first())
                    {
                        $subscription->update([
                            'paypal_status'=>$agreement->state,
                        ]);

                    }else{

                        PaypalSubscription::create([
                            'user_id'=>$user->id,
                            'name'=>$plan->name,
                            'paypal_id'=>$agreement->id,
                            'paypal_status'=>$agreement->state,
                            'paypal_plan'=>$plan->plan_id,
                            'quantity'=>1,
                            'trial_ends_at',
                            'ends_at'=>$agreement->agreement_details->next_billing_date,
                        ]); 
                    }

                    $user->update([
                        'payment_method_id'=>2,
                    ]);
                }

                return redirect()->route('Dashboard')->with('success','Pago Exitoso');

            } catch (\Exception $ex) {
                return redirect()->route('billing')->with('error','Ha ocurrido un error');
            }

            // Record the transaction here.
    
            // Upgrade the user account, etc.
        } else {
            // payment failed, perhaps send the user elsewhere and log the error
        }
        
    }

    public function cancel()
    {
        return redirect()->route('billing')->with('error','Ha ocurrido un error');
    }

    public function test()
    {
        $agreement = Agreement::get("I-AJX4J8PJD1RJ", $this->apiContext);
        dd($agreement);
    }




}

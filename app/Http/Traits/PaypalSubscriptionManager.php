<?php

namespace App\Http\Traits;

use PayPal\Api\Agreement;
use App\PaypalSubscription;
use Illuminate\Support\Facades\Auth;
use PayPal\Api\AgreementStateDescriptor;

trait PaypalSubscriptionManager 
{
   public function suspendSubscription()
   {
        $user = \Auth::user();

        $subscription = $user->paypalSubscription();

        $agreementStateDescriptor = new AgreementStateDescriptor();
        $agreementStateDescriptor->setNote("Suspending the agreement");

        try {

            $createdAgreement = Agreement::get($subscription->paypal_id, $this->apiContext);
            
            $createdAgreement->suspend($agreementStateDescriptor, $this->apiContext);
            $agreement = Agreement::get($createdAgreement->getId(), $this->apiContext);

            $subscription->update([
                'paypal_status'=>$agreement->state,
            ]);
        
        } catch (\Exception $ex) {
            return back()->with('error','Ha ocurrido un error, intentalo mas tarder');
        }

        return back()->with('success','Suspencion Exitosa!');
    }

   public function reactivateSubscription()
   {
    //try {
        $user = \Auth::user();

        $subscription = $user->paypalSubscription();

        $suspendedAgreement = Agreement::get($subscription->paypal_id, $this->apiContext);

        $agreementStateDescriptor = new AgreementStateDescriptor();
        $agreementStateDescriptor->setNote("Reactivating the agreement");

        try {
            
            $suspendedAgreement->reActivate($agreementStateDescriptor, $this->apiContext);
    
            $agreement = Agreement::get($suspendedAgreement->getId(), $this->apiContext);
            
            $subscription->update([
                'paypal_status'=>$agreement->state,
                'ends_at'=>$agreement->agreement_details->next_billing_date
            ]);

        } catch (\Exception $ex) {
            return back()->with('error','Ha ocurrido un error, intentalo mas tarder');
        }

        return back()->with('success','Reactivacion Exitosa!');
    /*
    } catch (\Exception $ex) {
  
        

    }*/
   }

}

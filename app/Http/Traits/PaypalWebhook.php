<?php

namespace App\Http\Traits;

use PayPal\Api\Agreement;
use App\PaypalSubscription;
use \PayPal\Api\WebhookEvent;
use \PayPal\Api\VerifyWebhookSignature;

trait PaypalWebhook 
{

    public function webhook()
    {
        /**
        * Receive the entire body that you received from PayPal webhook.
        */
        $bodyReceived = file_get_contents('php://input');

        /**
        * Receive HTTP headers that you received from PayPal webhook.
        */
        $headers = getallheaders();

        /**
        * Uppercase all the headers for consistency
        */
        $headers = array_change_key_case($headers, CASE_UPPER);

        $signatureVerification = new VerifyWebhookSignature();
        $signatureVerification->setWebhookId(env('WEBHOOK_ID'));
        $signatureVerification->setAuthAlgo($headers['PAYPAL-AUTH-ALGO']);
        $signatureVerification->setTransmissionId($headers['PAYPAL-TRANSMISSION-ID']);
        $signatureVerification->setCertUrl($headers['PAYPAL-CERT-URL']);
        $signatureVerification->setTransmissionSig($headers['PAYPAL-TRANSMISSION-SIG']);
        $signatureVerification->setTransmissionTime($headers['PAYPAL-TRANSMISSION-TIME']);

        $webhookEvent = new WebhookEvent();
        $webhookEvent->fromJson($bodyReceived);
        $signatureVerification->setWebhookEvent($webhookEvent);
        $request = clone $signatureVerification;

        try {
            /** @var \PayPal\Api\VerifyWebhookSignatureResponse $output */
            $output = $signatureVerification->post($this->apiContext);
            $this->changeSubscription($output,$request);

            return \Response::json("",200);

        } catch (\Exception $ex) {
            print_r($ex->getMessage());
            exit(1);
        }
    }

    public function changeSubscription($output,$request)
    {
        $verificationStatus = $output->getVerificationStatus();
        $responseArray = json_decode($request->toJSON(), true);

        $event = $responseArray['webhook_event']['event_type'];

        $outputArray = json_decode($output->toJSON(), true);

        if ($verificationStatus == 'SUCCESS') {
            switch($event) {
                case 'BILLING.SUBSCRIPTION.CANCELLED':
                case 'BILLING.SUBSCRIPTION.SUSPENDED':
                case 'BILLING.SUBSCRIPTION.EXPIRED':
                // subscription canceled: agreement id = $responseArray['webhook_event']['resource']['id']

                    $agreement = Agreement::get($responseArray['webhook_event']['resource']['id'], $this->apiContext);

                    $subscription = PaypalSubscription::where('paypal_id',$agreement->id)->first();
                    
                    $subscription->update([
                        'paypal_status'=>$agreement->state,
                    ]);

                break;
                case 'PAYMENT.SALE.COMPLETED':

                    $subscription = PaypalSubscription::where('paypal_id',$responseArray['webhook_event']['resource']['billing_agreement_id'])->first();
                    
                    $agreement = Agreement::get($subscription->paypal_id, $this->apiContext);
                    
                    if(isset($agreement->payer->payer_info->payer_id))
                    {
                        $subscription->update([
                            'paypal_status'=>$agreement->state == "Pending" ? "Active" : $agreement->state,
                            'ends_at'=>isset($agreement->agreement_details->next_billing_date) ? $agreement->agreement_details->next_billing_date : $agreement->start_date,
                        ]);
                    }

                //subscription payment recieved: agreement id = $responseArray['webhook_event']['resource']['billing_agreement_id']
                break;
            }
        }
    }

}

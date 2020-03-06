<?php

namespace App\Http\Controllers;

use App\Http\Traits\GetPaypalClientCredential;
use App\PaypalSubscription;
use Illuminate\Http\Request;

class PaypalSubscriptionController extends Controller
{
    use GetPaypalClientCredential;


    public function createProduct()
    {

        $ch = curl_init();

        $base_url = $this->enviroment();

        curl_setopt($ch, CURLOPT_URL, $base_url.'/v1/catalogs/products');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n  \"name\": \"Nutriologia Service\",\n  \"description\": \"Gestion de pacientes\",\n  \"type\": \"SERVICE\",\n  \"category\": \"SOFTWARE\"\n}");

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: Bearer '.$this->getClientCredentials()->access_token;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        return $result;
    }

    public function createPlan()
    {
        $ch = curl_init();

        $base_url = $this->enviroment();

        curl_setopt($ch, CURLOPT_URL, $base_url.'/v1/billing/plans');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n        \"product_id\": \"PROD-7NN16524TB096521B\",\n        \"name\": \"Basic Plan\",\n        \"description\": \"Basic plan\",\n        \"billing_cycles\": [\n            {\n              \"frequency\": {\n                \"interval_unit\": \"YEAR\",\n                \"interval_count\": 1\n              },\n              \"tenure_type\": \"REGULAR\",\n              \"sequence\": 1,\n              \"total_cycles\": 12,\n              \"pricing_scheme\": {\n                \"fixed_price\": {\n                  \"value\": \"1200\",\n                  \"currency_code\": \"MXN\"\n                }\n              }\n            }\n          ],\n        \"payment_preferences\": {\n          \"service_type\": \"PREPAID\",\n          \"auto_bill_outstanding\": true,\n          \"setup_fee\": {\n            \"value\": \"1200\",\n            \"currency_code\": \"MXN\"\n          },\n          \"setup_fee_failure_action\": \"CONTINUE\",\n          \"payment_failure_threshold\": 3\n        },\n        \"quantity_supported\": true,\n        \"taxes\": {\n          \"percentage\": \"0\",\n          \"inclusive\": false\n        }\n    }");

        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Authorization: Bearer '.$this->getClientCredentials()->access_token;
        $headers[] = 'Prefer: return=representation';
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        return $result;
    } 

}

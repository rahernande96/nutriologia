<?php

namespace App\Http\Controllers\Paypal;

use App\Http\Traits\GetPaypalClientCredential;
use App\PaypalSubscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    use GetPaypalClientCredential;

    public function create()
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

   

}
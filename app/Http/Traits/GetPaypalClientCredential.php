<?php

namespace App\Http\Traits;


trait GetPaypalClientCredential 
{
    public function getClientCredentials()
    {
    	$ch = curl_init();

    	$base_url = $this->enviroment();

		curl_setopt($ch, CURLOPT_URL, $base_url.'/v1/oauth2/token');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
		curl_setopt($ch, CURLOPT_USERPWD, env('PAYPAL_CLIENT_ID') . ':' . env('PAYPAL_SECRET_ID'));

		$headers = array();
		$headers[] = 'Accept: application/json';
		$headers[] = 'Accept-Language: en_US';
		$headers[] = 'Content-Type: application/x-www-form-urlencoded';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		if (curl_errno($ch)) {
		    echo 'Error:' . curl_error($ch);
		}
		curl_close($ch);
		
		return json_decode($result);
    }

    public function enviroment()
    {
    	$mode = env('PAYPAL_MODE', 'sandbox');

    	if ( ($mode == "live")) {
    		
    		return "https://api.paypal.com";

    	} else {
    		
    		return "https://api.sandbox.paypal.com";
    	} 
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Plan;

class BillingController extends Controller
{
    public function billing()
    {
        $user = Auth::user();
        
        $paypal = Plan::whereHas('SubscriptionPaymentMethod',function($query){
            
            return $query->where('name','PayPal');
            
        })->first();
    	
    	return view('billing.billing',[
    		'user'=>$user,
    		'paypal'=>$paypal,
    	]);
    }


    public function payment()
    {
    	$user->newSubscription('main', "plan_GVtuWIHiSH3obG")->create($request->input('payment_method'));
    }
}

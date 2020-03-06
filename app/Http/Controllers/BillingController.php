<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillingController extends Controller
{
    public function billing()
    {
    	$user = Auth::user();
    	
    	return view('billing.billing',[
    		'user'=>$user,
    	]);
    }


    public function payment()
    {
    	$user->newSubscription('main', "plan_GVtuWIHiSH3obG")->create($request->input('payment_method'));
    }
}

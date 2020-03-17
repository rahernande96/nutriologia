<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StripeController extends Controller
{
    public function store(Request $request)
    {
    	//dd($request->all());

    	$request->validate([
            'payment_method' => ['required'],
    	]);

    	try{ 

            $user = Auth::user();

            if ($user->role_id == 1) {

                return redirect()->route('Dashboard');
            }

    		$user->newSubscription('main', "plan_GVtuWIHiSH3obG")->create($request->input('payment_method'));

		//Mandamos el correo de confirmación de pago
			//Mail::to($user->email)->send(new PaymentSuccess($user));

			//actualizamos el metodo de pago elegido por el usuario 
			$user->update([
				'payment_method_id'=>1,
			]);

			return redirect()->route('Dashboard')->with('success', 'Pago realizado correctamente');

		}catch(\Exception $e){ 
				
				if($e->getMessage() == 'The card was declined'){
					return redirect()->route('register')->with('info', 'La tarjeta ha sido rechazada, intente nuevamente o ingrese otra tarjeta.');
				}
				
				if($e->getmessage() == 'The card has expired'){
					return redirect()->route('register')->with('info', 'La tarjeta ha expirado.');
				}

				if($e->getmessage() == "The card doesn't have sufficient funds"){
					return redirect()->route('register')->with('info', 'La tarjeta no tiene fondos suficientes.');
				};

				if($e->getmessage() == 'The card was reported as stolen'){
					return redirect()->route('register')->with('info', 'La tarjeta ha sido identificada como una tarjeta robada.');
				}

				if($e->getmessage() == 'The card was declined (k)'){
					return redirect()->route('register')->with('info', 'La tarjeta ha sido rechazada por el sistema antifraudes.');
				}
				
				return redirect()->route('register')->with('info', $e->getMessage());
			} 
    }

    public function cancelSubscription()
    {
    	$user = Auth::user();
    	
    	if ($user->role_id == 2) {
    		
    		$user->subscription('main')->cancel();
    	}

    	return back();
    }

    public function resumeSubscription()
    {
    	$user = Auth::user();
    	
    	if ($user->role_id == 2) {
    		
    		$user->subscription('main')->resume();
    	}


    	return back();
    }

    public function createSuscription()
    {
    	$user = Auth::user();
    	
    	if ($user->role_id == 2) {

    		$paymentMethod = $user->defaultPaymentMethod();
    		
    		$user->newSubscription('main', 'plan_GVtuWIHiSH3obG')->create($paymentMethod->id);
    	}


    	return back();
    }
}

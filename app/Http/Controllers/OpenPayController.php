<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Mail\PaymentSuccess;
use App\User;
use DB;
use Auth;
use Hash;
use Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Openpay;

class OpenPayController extends Controller
{
	public function __construct()
	{
		$this->id = env('OPEN_PAY_ID');
		$this->secret = env('OPEN_PAY_SECRET');
	}

	public function store(RegisterRequest $request){

		Openpay::setSandboxMode(true);
		$openpay = Openpay::getInstance($this->id, $this->secret);

		try{ DB::beginTransaction(); 

	  	// Creamos el cliente
			$customerData = array(
				'name' => $request->name_nutriologist,
				'email' => $request->email
			);

			$customer = $openpay->customers->add($customerData);

		// Guardar la tarjeta
			$cardDataRequest = array(
				'holder_name' => $request->name,
				'card_number' => $request->card_number,
				'cvv2' => $request->cvv2,
				'expiration_month' => $request->expiration_month,
				'expiration_year' => $request->expiration_year);

			$customer = $openpay->customers->get($customer->id);
			$card = $customer->cards->add($cardDataRequest);

		// Suscripción por un año

			$subscriptionDataRequest = array(
				'plan_id' => 'pgh3e4n4ggpqeckuj4dr',
				'card_id' => $card->id);

			$customer = $openpay->customers->get($customer->id);
			$subscription = $customer->subscriptions->add($subscriptionDataRequest);

    	//Registramos el cliente en la base de datos
			$user = User::create([
				'name' => $request->name_nutriologist,
				'slug' => str_slug(Str::random(40)),
				'picture' => 'default.png',
				'no_registry' => $request->no_registry,
				'identification_card' => $request->identification_card,
				'email' => $request->email,
				'confirmation_code' => Str::random(25),
				'password' => Hash::make($request->password),
			]);

		//Mandamos el correo de confirmación de pago
			Mail::to($user->email)->send(new PaymentSuccess($user));

		//Logueamos al usuario despues de crearlo
			auth()->guard('web')->login($user);

			DB::commit(); 

			return redirect()->route('Dashboard')->with('success', 'Pago realizado correctamente');

		}catch(\Exception $e){ 
				DB::rollback();
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
	}

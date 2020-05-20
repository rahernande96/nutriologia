@extends('layouts.admin')

@section('head')
<style type="text/css">
	
	.border-card-element{
		border: 1px solid grey;
		border-radius: 10px;
		height: 50px;
	}

	
</style>
@endsection

@section('title')
Subscripcion
@endsection

@section('content')





	@if(Auth::user()->role_id == 2)

		<div class="row mt-4">
		  
		  <div class="col-md-12">

		    <div class="card">

		      <div class="card-header">

		        <h3 class="card-title">Administrar suscripciones</h3>
				
		      </div>

		      <div class="card-body">

				<p>Producto (Anualidad) - Paga con tarjeta de crédito o débito, vigencia 1 año.
					Paga con uno de los siguientes métodos 
					</p>
		        
		        <div class="row">
		          
					<div class="col-md-12">
                @if ($user->payment_method_id == 1)
                  
		            @if(!$user->subscription('main'))

		            	@include('billing.credit_card')

		            @elseif($user->subscription('main')->onGracePeriod())
		              
		              <div class="alert alert-warning">

		                <p>¡Lamentamos que hayas cancelado tu suscripción!, puedes volver cuando quieras, tu cuenta estará activa hasta el : {{$user->subscription('main')->ends_at}}</p>

		              </div>

		              <a class="btn btn-success" href="{{ route('resume.subscription') }}">Renovar Suscripción</a>

		            @elseif($user->subscription('main')->ended())

		              <div class="alert alert-warning">

		                <p>¡Lamentamos que hayas cancelado tu suscripción!, puedes volver cuando quieras./p>

		              </div>

		              @include('billing.credit_card')

		            @else

		              <a class="btn btn-danger" href="{{ route('cancel.subscription') }}">Cancelar Suscripción</a>

		            @endif
              
                @elseif($user->payment_method_id == 2)
					
					@php
					
					$subscription = $user->paypalSubscription();
					//dd($subscription);
					$dateNow = \Carbon\Carbon::now();   
					@endphp

					@if($subscription->paypal_status != "Active")

						@if($subscription->paypal_status == "Pending")
						
							<div class="alert alert-warning">
								<p>Su pago esta siendo procesando, esto suele tardar solo unos minutos.</p>
							</div>
		
						
						@elseif(!is_null($subscription->ends_at) && $dateNow <= $subscription->ends_at)
						
							<div class="alert alert-warning">

								<p>¡Lamentamos que hayas cancelado tu suscripción!, puedes volver cuando quieras, tu cuenta estará activa hasta el : {{$subscription->ends_at}}</p>
		
							</div>

							<a class="btn btn-success" href="{{ route('paypal.subscription.reactivate') }}">Renovar Suscripción</a>
					

						@else

							@include('billing.credit_card')

						@endif
						
					@else

					<a class="btn btn-danger" href="{{ route('paypal.subscription.suspend') }}">Cancelar Suscripción</a>

					@endif

              	@else
                
                	@include('billing.credit_card')
              
              	@endif
		          </div>		         

		        </div>

		      </div>
		      
		    </div>
		    
		  </div>

		</div>

@endif

@endsection


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
		        
		        <div class="row">
		          
					 <div class="col-md-12">

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

		          </div>		         

		        </div>

		      </div>
		      
		    </div>
		    
		  </div>

		</div>

@endif


	

@endsection

@section('extra-js')
<script src="https://js.stripe.com/v3/"></script>
<script>
    // Create a Stripe client.
var stripe = Stripe('{{ env('STRIPE_KEY') }}');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    lineHeight: '18px',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});



var form = document.getElementById('subscription-form');

form.addEventListener('submit', function(event) {
  // We don't want to let default form submission happen here,
  // which would refresh the page.
  event.preventDefault();

  stripe.createPaymentMethod({
    type: 'card',
    card: card,
    billing_details: {
      email: 'jenny.rosen@example.com',
    },
  }).then(stripePaymentMethodHandler);
});

/*
// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();


  stripe.createPaymentMethod(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});*/

// Submit the form with the token ID.
function stripePaymentMethodHandler(result, email) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('subscription-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'payment_method');
  hiddenInput.setAttribute('value', result.paymentMethod.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
</script>

@endsection
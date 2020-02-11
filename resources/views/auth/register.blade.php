@extends('layouts.payment')

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
Registro
@endsection

@section('content')
<div class="container-fluid" id="loadPayment">
	<div class="row" id="load">
		<div class="spinner-border text-light" role="status">
  			<span class="sr-only">Loading...</span>
		</div>
		<div class="col-md-4">
			<p class="text-white mb-0">
				Procesando Pago, no cierre ni recargue esta página.
			</p>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		{{-- Inicia formulario de usuario --}}
		<form action="{{ route('stripe.store') }}" method="POST" id="subscription-form">
			@csrf

			<div class="col-md-12">
				<div class="card my-4">
					<div class="card-header bg-danger">
						<h3 class="text-white mb-0">
							Datos del nutriologo
						</h3>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="name_nutriologist">Nombre del nutriologo</label>
								<input id="name_nutriologist" class="form-control" type="text" placeholder="Nombre del nutriologo" name="name_nutriologist" value="{{ old('name_nutriologist') }}" required>
							</div>
							<div class="form-group col-md-6">
								<label for="email">Correo Electrónico</label>
								<input id="email" class="form-control" type="email" placeholder="Correo Electrónico" name="email" value="{{ old('email') }}">
							</div>
							<div class="form-group col-md-6">
								<label for="email_confirmation">Repetir Correo Electrónico</label>
								<input id="email_confirmation" class="form-control" type="email" placeholder="Ingrese nuevamente su correo electrónico" name="email_confirmation" value="{{ old('email_confirmation') }}">
							</div>
							<div class="form-group col-md-6">
								<label for="no_registry">Número de registro</label>
								<input id="no_registry" class="form-control" type="text" placeholder="Número de registro" name="no_registry" value="{{ old('no_registry') }}">
							</div>
							<div class="form-group col-md-6">
								<label for="cedula">Cédula Profesional</label>
								<input id="cedula" class="form-control" type="text" placeholder="Cédula Profesional" name="identification_card" value="{{ old('identification_card') }}">
							</div>
							<div class="form-group col-md-6">
								<label for="password">Contraseña</label>
								<input id="password" class="form-control" type="password" placeholder="Contraseña" name="password">
							</div>
							<div class="form-group col-md-6">
								<label for="password_confirmation">Repite la Contraseña</label>
								<input id="password_confirmation" class="form-control" type="password" placeholder="Repite la contraseña" name="password_confirmation">
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-12">
				<div class="card my-4">
					<div class="card-header bg-danger">
						<h3 class="text-white mb-0">
							Tarjeta de crédito o débito
						</h3>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-3">
								<div class="row">
									<div class="col-md-12">
										<h4>Tarjetas de crédito</h4>
									</div>
									<div class="col-md-12">
										<img src="{{ asset('images/openPay/cards1.png') }}" alt="">
									</div>
								</div>
							</div>
							<div class="col-md-9">
								<div class="row">
									<div class="col-md-12">
										<h4>Tarjetas de débito</h4>
									</div>
									<div class="col-md-12">
										<img src="{{ asset('images/openPay/cards2.png') }}">
									</div>
								</div>
							</div>
						</div>
						<div class="row my-4">
							<div class="col-md-12">
								{{-- Inicia formulario de Pago --}}
								<input type="hidden" name="token_id" id="token_id">
								<div class="form-row">
									

									<div class="col-md-12 mt-3 mb-3 border-card-element">
										<div id="card-element"></div>

										<div id="card-errors" role="alert"></div>
									</div>

									<div class="col-md-6 d-flex align-items-center">
										<button class="text-white btn btn-danger btn-block" id="pay-button" ><span id="text-payment" class="text-white">Pagar</span></button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
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
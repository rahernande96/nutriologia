<div class="accordion mt-5 mb-5" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          	
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
        
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      
      <div class="card-body">
      
        	<div class="row my-4">
				
            <div class="col-md-12">
            
              {{-- Inicia formulario de Pago --}}
              <form action="{{ route('stripe.charge') }}" method="post" id="subscription-form">
                @csrf

                <input type="hidden" name="token_id" id="token_id">
              
                <div class="form-row">
                  
                  <div class="col-md-12 mt-3 mb-3 border-card-element">
                  
                    <div id="card-element"></div>

                    <div id="card-errors" role="alert"></div>
                
                  </div>

                  <div class="col-md-6 d-flex align-items-center mt-3">

                    <button class="text-white btn btn-primary btn-block" id="pay-button" >

                      <span id="text-payment" class="text-white">Pagar</span>
                    </button>
                  
                  </div>
                
                </div>

              </form>
            
            </div>
			
		    	</div>
      
      </div>
    
    </div>
  
  </div>

  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
		
      <a class="btn btn-link" href="#">
          
        <img style="max-width: 100px;" src="{{ asset('Logos/paypal_logo.png') }}">
        
      </a>
      
      <a class="btn btn-primary ml-auto" href="{{ route('create.subscription.paypal') }}">Pagar con PayPal</a>

      </h2>
    </div>
   
  </div>

</div>

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
    color: '#43B8BD',
    lineHeight: '18px',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#43B8BD'
    }
  },
  invalid: {
    color: '#43B8BD',
    iconColor: '#43B8BD'
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
      email: '{{ Auth::user()->email }}',
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

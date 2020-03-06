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
<!--
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          <img style="max-width: 100px;" src="{{ asset('Logos/paypal_logo.png') }}">
        </button>
      </h2>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
        Bonto de pago paypal
      </div>
    </div>
  </div>
-->
</div>
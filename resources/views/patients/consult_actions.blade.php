<div class="row">
	
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 mt-1">
		

		<a href="{{ route('ClinicHistoryPatient', $patient->slug) }}" class="btn btn-primary">

		    Historia Clínica
		
		</a>



	</div>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 mt-1">
		

		<a href="{{ route('anthropometry.index', $patient->slug) }}" class="btn btn-primary">

		    Antropometría
		
		</a>


	</div>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 mt-1">
		

		<a href="{{ route('dietetic.index', $patient->slug) }}" class="btn btn-primary">

		    Dietética
		
		</a>


	</div>


</div>




   
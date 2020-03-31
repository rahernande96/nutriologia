<div class="btn-group btn-group-sm" role="group" aria-label="First group">
	
	<a href="{{ route('ClinicHistoryPatient', $patient->slug) }}" class="btn btn-primary">

		Historia Clínica
	
	</a>

	<a href="{{ route('anthropometry.index', $patient->slug) }}" class="btn btn-primary">

		Antropometría
	
	</a>

	<a href="{{ route('dietetic.history.index', $patient->slug) }}" class="btn btn-primary">

		Dietética
	
	</a>

</div>




   
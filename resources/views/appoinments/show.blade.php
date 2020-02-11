@extends('layouts.admin')

@section('title')
	Cita del paciente: {{ $event->patient->name }}
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card card-primary mt-4">
			<div class="card-header">
				<div class="card-title">
					Cita programada con el paciente {{ $event->patient->name }}
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-12">
										<img src="{{ asset($event->patient->picture) }}" alt="{{ $event->patient->name }}" class="img-fluid">
									</div>
									<div class="col-md-12 d-flex justify-content-center">
										<button class="btn btn-info mr-1"><i class="fa fa-user"></i> Editar Paciente</button>
										<form action="{{ route('event.delete', $event->slug) }}" method="POST">
											@method('DELETE')
											@csrf
											<button type="submit" onclick="deleteEvent(event)" class="btn btn-danger ml-1"><i class="fa fa-trash"></i> Eliminar Cita</button>
										</form>
									</div>
								</div>
							</div>
							<div class="col-md-8 jumbotron px-4 py-4">
								<div class="row">
									<div class="col-md-12">
										<h4>{{ $event->patient->name }}</h4>
									</div>
									<div class="col-md-12">
										<hr>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<p><strong>Dirección:</strong> {{ $event->patient->address }}, {{ $event->patient->city }}.</p>
									</div>
									<div class="col-md-12">
										<p><strong>Edad:</strong> {{ $event->patient->age }} años</p>
									</div>
									<div class="col-md-12">
										<p><strong>Género: </strong>{{ $event->patient->gender }}</p>
									</div>
									@if($event->patient->gender != 'Masculino')
									<div class="col-md-12">
										<p><strong>Trimestre de embarazo: </strong>{{ $event->patient->trimester }}</p>
									</div>
									<div class="col-md-12">
										<p><strong>SDG (Embarazo): </strong>{{ $event->patient->sdg }}</p>
									</div>
									<div class="col-md-12">
										<p><strong>Semestre de lactancia: </strong>{{ $event->patient->semester }}</p>
									</div>
									@endif
									<div class="col-md-12">
										<p><strong>Correo Electrónico: </strong>{{ $event->patient->email }}</p>
									</div>
									<div class="col-md-12">
										<p><strong>Telefono Principal: </strong>{{ $event->patient->phone_1 }}</p>
									</div>
									@if($event->patient->phone_2 != null)
									<div class="col-md-12">
										<p><strong>Telefono Secundario: </strong>{{ $event->patient->phone_2 }}</p>
									</div>
									@endif
									<div class="col-md-12">
										<p><strong>Peso: </strong>{{ $event->patient->weight }}</p>
									</div>
									<div class="col-md-12">
										<p><strong>Talla: </strong>{{ $event->patient->size }}</p>
									</div>
									<div class="col-md-12">
										<p><strong>Notas del paciente: </strong>{{ $event->patient->notes }}</p>
									</div>
									<div class="col-md-12">
										<p><strong>Notas de la cita: </strong>{{ $event->description }}</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('extra-js')

<script>
    function deleteEvent(e) {
      if (!confirm("Eliminar Cita?")){
        e.preventDefault();
      }
    }
</script>

@endsection
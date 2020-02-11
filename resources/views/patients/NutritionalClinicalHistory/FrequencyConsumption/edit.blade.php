@extends('layouts.admin')

@section('title')
Frecuencia de Consumo
@endsection

@section('content')
<div class="row">
	<div class="col-md-12 d-flex justify-content-end mt-4">
		<a href="{{ route('chart.show', $patient->slug) }}" class="btn btn-primary mx-2 text-white">Generar Gráfica de frecuencia de consumo</a>
	</div>
	<div class="col-md-12">
		<div class="card card-primary mt-4">
			<div class="card-body">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Alimentos registrados</h3>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fas fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<ul class="list-group list-group-horizontal">
									@foreach($frequency as $food)
									<li class="list-group-item">
										<div class="row">
											<div class="col-md-6 d-flex align-items-center">
												<strong>{{ $food->food_name }}</strong> - {{ $food->frecuency }}	
											</div>
											<div class="col-md-6 d-flex justify-content-end">
												<form action="{{ route('frequencyConsumption.delete',$food->id) }}" method="POST" class="form-inline">
													@csrf
													@method('DELETE')
													<button class="btn btn-danger" type="submit" style="display: inline-block;">Eliminar</button>
												</form>
											</div>
										</div>
									</li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>
				</div>
				
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Editar Frecuencia de Consumo</h3>

						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fas fa-minus"></i></button>
							</div>
						</div>
						<div class="card-body">
							{{-- Componente Draggable --}}
							<div id="foodsEdit">
								<foods-edit :foods="{{ $foods }}" :patient="{{ $patient }}" :frequency="{{ $frequency }}"></foods-edit>
							</div>
						</div>
					</div>
					<div class="cad-footer">
						<div class="col-md-3 offset-md-4">
							<a class="btn btn-primary" href="{{ route('ClinicHistoryPatient', $patient->slug) }}">Ir a Historia Clinica</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection

	@section('extra-js')
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/sweetalert2@8.js') }}"></script>
	@endsection
@extends('layouts.admin')

@section('title')
Paciente {{ $patient->name }}
@endsection

@section('content')
<div class="row">
	<div class="col-md-12 mt-4">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Paciente: {{ $patient->name }}</h3>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="form-group col-md-4">
						<label>Nombre Completo</label>
						<input type="text" class="form-control" value="{{ $patient->name }}" disabled>
					</div>
					<div class="form-group col-md-4">
						<label>Dirección</label>
						<input type="text" class="form-control" value="{{ $patient->address }}" disabled>
					</div>
					<div class="form-group col-md-4">
						<label>Ciudad</label>
						<input type="text" class="form-control" value="{{ $patient->city }}" disabled>
					</div>

					<div class="form-group col-md-4">
						<label>Fecha de nacimiento</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-calendar"></i></span>
							</div>
							<input type="text" name="birthdate" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="{{ $date }}" disabled>
						</div>
					</div>

					<div class="form-group col-md-4">
						<label>Telefono celular/convencional</label>
						<input type="text" class="form-control" value="{{ $patient->phone_1 }}" disabled>
					</div>

					@if($patient->phone_2 == null)
						<div class="form-group col-md-4">
							<label>Telefono secundario (opcional)</label>
							<input type="text" class="form-control" id="phone_2" placeholder="Teléfono secundario no registrado" disabled>
						</div>
						@else
						<div class="form-group col-md-4">
							<label for="phone_2">Telefono secundario (opcional)</label>
							<input type="text" class="form-control" id="phone_2" placeholder="Ingrese el telefono secundario (opcional)" value="{{ $patient->phone_2 }}" name="phone_2">
						</div>
						@endif

						<div class="form-group col-md-4">
							<label>Correo electrónico</label>
							<input type="text" class="form-control" value="{{ $patient->email }}" disabled>
						</div>

						{{--<div class="form-group col-md-4">
							<label>Peso</label>
							<input type="text" class="form-control" value="{{ $patient->weight }}" disabled>
						</div>--}}

						<div class="form-group col-md-4">
							<label>Género</label>
							<input type="text" class="form-control" value="{{ $patient->gender }}" disabled>
						</div>

						@if($patient->gender == 'Femenino')

							<div class="form-group col-md-4">
								<label>Trimestre (Embarazo)</label>
								<input type="text" class="form-control" value="{{ $patient->trimester }}" disabled>
							</div>

							<div class="form-group col-md-4">
								<label>SDG (Embarazo)</label>
								<input type="text" class="form-control" value="{{ $patient->sdg }}" disabled>
							</div>

							<div class="form-group col-md-4">
								<label>Semestre (Lactancia)</label>
								<input type="text" class="form-control" value="{{ $patient->semester }}" disabled>
							</div>

							@endif


							{{--<div class="form-group col-md-4">
								<label>Talla</label>
								<input type="text" class="form-control" value="{{ $patient->size }}" disabled>
							</div>--}}

							<div class="form-group col-md-4">
								<label>Edad</label>
								<input type="text" class="form-control" value="{{ $patient->age }}" disabled>
							</div>

							<div class="form-group col-md-12">
								<label>Notas adicionales (opcional)</label>
								<textarea class="form-control" rows="3" disabled>{{ $patient->notes }}</textarea>
							</div>

							<div class="form-group col-md-12">
								<div class="row">
									<a href="{{ route('patients.edit', $patient->slug) }}" class="btn btn-info text-white mr-1" type="button" class="btn btn-info">Editar Información</a>
									<a href="{{ route('BriefClinicHistory.create', $patient->slug) }}" class="btn btn-info text-white ml-1" type="button" class="btn btn-info">Evaluación Médica</a>
								</div>
							</div>
				</div>
			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
</div>
@endsection

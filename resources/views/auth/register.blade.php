@extends('layouts.app')

@section('title')
Registro
@endsection

@section('content')

<div class="container">
	<div class="row">
		{{-- Inicia formulario de usuario --}}
		<form action="{{ route('register') }}" method="POST" id="subscription-form">
			@csrf

			<div class="col-md-12">
				<div class="card my-4">
					<div class="card-header">
						<h3 class="mb-0">
							Datos del nutriólogo
						</h3>
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="name_nutriologist">Nombre del nutriólogo</label>
								<input id="name_nutriologist" class="form-control" type="text" placeholder="Nombre del nutriólogo" name="name_nutriologist" value="{{ old('name_nutriologist') }}" required>
							</div>
							<div class="form-group col-md-6">
								<label for="email">Correo electrónico</label>
								<input id="email" class="form-control" type="email" placeholder="Correo Electrónico" name="email" value="{{ old('email') }}">
							</div>
							<div class="form-group col-md-6">
								<label for="email_confirmation">Repetir correo electrónico</label>
								<input id="email_confirmation" class="form-control" type="email" placeholder="Ingrese nuevamente su correo electrónico" name="email_confirmation" value="{{ old('email_confirmation') }}">
							</div>
							<div class="form-group col-md-6">
								<label for="cedula">Cédula profesional</label>
								<input id="cedula" class="form-control" type="text" placeholder="Cédula profesional" name="identification_card" value="{{ old('identification_card') }}">
							</div>
							<div class="form-group col-md-6">
								<label for="password">Contraseña</label>
								<input id="password" class="form-control" type="password" placeholder="Contraseña" name="password">
							</div>
							<div class="form-group col-md-6">
								<label for="password_confirmation">Repite la contraseña</label>
								<input id="password_confirmation" class="form-control" type="password" placeholder="Repite la contraseña" name="password_confirmation">
							</div>
							<div class="form-group col-md-6">
								<label for="birthdate">Fecha de nacimiento</label>
								<input type="date" name="birthdate" class="form-control" required>
							</div>
							<div class="form-group col-md-6">
								<label for="sex">Sexo</label>
								<select class="form-control" name="sex" required>
									<option value="0">Femenino</option>
									<option value="1">Masculino</option>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label>&nbsp;</label>
								<input type="submit" class="text-white btn btn-primary btn-block" id="pay-button" value="Registrarme">
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection

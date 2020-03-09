@extends('layouts.admin')

@section('title')
Editar - Historia Clínica Nutricional
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-12 d-flex justify-content-end mt-4">
				<a href="{{ route('reminder.show', $patient->slug) }}" class="btn btn-danger">Recordatorio 24Hrs</a>
				@if($patient->FrequencyConsumption->isEmpty() == true)
				<a href="{{ route('frequencyConsumption.create', $patient->slug) }}" class="btn btn-success mx-2 text-white">Ingresar Frecuencia de Consumo
				</a>
				@else
				<a href="{{ route('chart.show', $patient->slug) }}" class="btn btn-primary mx-2 text-white">Generar gráfica de frecuencia de consumo</a>
				<a href="{{ route('frequencyConsumption.edit', $patient->slug) }}" class="btn btn-warning mx-2 text-white">Frecuencia de consumo
				</a>
				@endif
			</div>
		</div>
		<div class="card card-primary mt-4">
			<div class="card-header">
				<h3 class="mb-0">Evaluación médica nutricional</h3>
			</div>
			<div class="card-body">
				<form action="{{ route('NutritionalClinicalHistory.update', $patient->slug) }}" method="POST">
					@method('PUT')
					@csrf
					<div class="row">
						<div class="col-md-12">
							<h5 class="mb-0"><strong>Estilo de Vida</strong></h5>
						</div>
						<div class="col-md-12">
							<hr>
						</div>
						<div class="form-group col-md-6">
							<label for="physical_activities">Detalle las actividades físicas diarias</label>
							<textarea class="form-control" name="physical_activities" id="physical_activities" rows="3" style="resize: none;">{{ $patient->LifeStyle->details }}</textarea>
						</div>
						<div class="form-group col-md-4 px-4">
							<label>Nivel de estrés</label>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="stress" id="high_stress" value="Mucho Estrés" {{ $patient->LifeStyle->stress == 'Mucho Estrés' ? 'checked':'' }}>
								<label class="form-check-label" for="high_stress">
									Mucho Estrés
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="stress" id="exampleRadios2" value="Estrés Regular" {{ $patient->LifeStyle->stress == 'Estrés Regular' ? 'checked':'' }}>
								<label class="form-check-label" for="exampleRadios2">
									Estrés Regular
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="stress" id="exampleRadios3" value="Poco Estrés" {{ $patient->LifeStyle->stress == 'Poco Estrés' ? 'checked':'' }}>
								<label class="form-check-label" for="exampleRadios3">
									Poco Estrés
								</label>
							</div>
						</div>
						<div class="col-md-12">
							<hr>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<h5 class="mb-0"><strong>Alimentación</strong></h5>
						</div>
						<div class="col-md-12">
							<hr>
						</div>
						<div class="col-md-12">
							<h6><strong>Seleccione los alimentos de preferencia</strong></h6>
						</div>
						<div class="col-md-12">
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="salad" type="checkbox" id="salad" {{ old('salad') ? 'checked' : null }} {{ $patient->Feeding->salad == 'on' ? 'checked':'' }}>
								<label class="form-check-label" for="salad">Ensalada</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="red_meat" type="checkbox" id="red_meat" {{ old('red_meat') ? 'checked' : null }} {{ $patient->Feeding->red_meat == 'on' ? 'checked':'' }}>
								<label class="form-check-label" for="red_meat">Carne roja</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="fish" type="checkbox" id="fish" {{ old('fish') ? 'checked' : null }} {{ $patient->Feeding->fish == 'on' ? 'checked':'' }}>
								<label class="form-check-label" for="fish">Pescado</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="soup" type="checkbox" id="soup" {{ old('soup') ? 'checked' : null }} {{ $patient->Feeding->soup == 'on' ? 'checked':'' }}>
								<label class="form-check-label" for="soup">Sopa</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="pasta" type="checkbox" id="pasta" {{ old('pasta') ? 'checked' : null }} {{ $patient->Feeding->pasta == 'on' ? 'checked':'' }}>
								<label class="form-check-label" for="pasta">Pasta</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="vegetable" type="checkbox" id="vegetable" {{ old('vegetable') ? 'checked' : null }} {{ $patient->Feeding->vegetable == 'on' ? 'checked':'' }}>
								<label class="form-check-label" for="vegetable">Verduras</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="fruit" type="checkbox" id="fruit" {{ old('fruit') ? 'checked' : null }} {{ $patient->Feeding->fruit == 'on' ? 'checked':'' }}>
								<label class="form-check-label" for="fruit">Frutas</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="vegetarian" type="checkbox" id="vegetarian" {{ old('vegetarian') ? 'checked' : null }} {{ $patient->Feeding->vegetarian == 'on' ? 'checked':'' }}>
								<label class="form-check-label" for="vegetarian">Vegetariana</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="vegan" type="checkbox" id="vegan" {{ old('vegan') ? 'checked' : null }} {{ $patient->Feeding->vegan == 'on' ? 'checked':'' }}>
								<label class="form-check-label" for="vegan">Vegana</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="bird" type="checkbox" id="bird" {{ old('bird') ? 'checked' : null }} {{ $patient->Feeding->bird == 'on' ? 'checked':'' }}>
								<label class="form-check-label" for="bird">Aves</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="pork" type="checkbox" id="pork" {{ old('pork') ? 'checked' : null }} {{ $patient->Feeding->pork == 'on' ? 'checked':'' }}>
								<label class="form-check-label" for="pork">Cerdo</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="mexican" type="checkbox" id="mexican" {{ old('mexican') ? 'checked' : null }} {{ $patient->Feeding->mexican == 'on' ? 'checked':'' }}>
								<label class="form-check-label" for="mexican">Mexicana</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="shellfish" type="checkbox" id="shellfish" {{ old('shellfish') ? 'checked' : null }} {{ $patient->Feeding->shellfish == 'on' ? 'checked':'' }}>
								<label class="form-check-label" for="shellfish">Mariscos</label>
							</div>
							<div class="col-md-12">
								<hr>
							</div>
						</div>
						<div class="form-group col-md-6 mt-2">
							<label for="food_not_prefer">Alimentos que no son de su preferencia</label>
							<input type="text" class="form-control" id="food_not_prefer" placeholder="Ingrese los alimentos que no le gustan al paciente." value="{{ $patient->Feeding->food_not_prefer }}" name="food_not_prefer">
						</div>
						<div class="form-group col-md-6 mt-2">
							<label for="alimentary_habits">Habitos alimentarios diarios</label>
							<input type="text" class="form-control" id="alimentary_habits" placeholder="Ingrese los habitos alimentarios diarios." value="{{ $patient->Feeding->alimentary_habits }}" name="alimentary_habits">
						</div>
						<div class="form-group col-md-6 mt-2">
							<label for="food_belief">Creencia sobre algunos alimentos</label>
							<input type="text" class="form-control" id="food_belief" placeholder="Ingrese la creencia de algunos alimentos." value="{{ $patient->Feeding->food_belief }}" name="food_belief">
						</div>
						<div class="col-md-12">
							<hr>
						</div>
						<div class="col-md-12">
							<h6><strong>Dieta específica</strong></h6>
						</div>
						<div class="col-md-12">
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="diet_salad" type="checkbox" id="diet_salad" {{ old('diet_salad') ? 'checked' : null }} {{ $patient->SpecificDiet->diet_salad == 'on' ? 'checked':'' }}>
								<label class="form-check-label" for="diet_salad">Ensaladas</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="diet_vegan" type="checkbox" id="diet_vegan" {{ old('diet_vegan') ? 'checked' : null }} {{ $patient->SpecificDiet->diet_vegan == 'on' ? 'checked':'' }}>
								<label class="form-check-label" for="diet_vegan">Vegana</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="diet_crudiverian" type="checkbox" id="diet_crudiverian" {{ old('diet_crudiverian') ? 'checked' : null }} {{ $patient->SpecificDiet->diet_crudiverian == 'on' ? 'checked':'' }}>
								<label class="form-check-label" for="diet_crudiverian">crudivegana</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="diet_ovegetarian" type="checkbox" id="diet_ovegetarian" {{ old('diet_ovegetarian') ? 'checked' : null }} {{ $patient->SpecificDiet->diet_ovegetarian == 'on' ? 'checked':'' }}>
								<label class="form-check-label" for="diet_ovegetarian">Ovogetariana</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="diet_ovnivoro" type="checkbox" id="diet_ovnivoro" {{ old('diet_ovnivoro') ? 'checked' : null }} {{ $patient->SpecificDiet->diet_ovnivoro == 'on' ? 'checked':'' }}>
								<label class="form-check-label" for="diet_ovnivoro">Ovnivoro</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="diet_ovolactovegetarian" type="checkbox" id="diet_ovolactovegetarian" {{ old('diet_ovolactovegetarian') ? 'checked' : null }} {{ $patient->SpecificDiet->diet_ovolactovegetarian == 'on' ? 'checked':'' }}>
								<label class="form-check-label" for="diet_ovolactovegetarian">Ovolactovegetariana</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="diet_mediterranean" type="checkbox" id="diet_mediterranean" {{ old('diet_mediterranean') ? 'checked' : null }} {{ $patient->SpecificDiet->diet_mediterranean == 'on' ? 'checked':'' }}>
								<label class="form-check-label" for="diet_mediterranean">Meditarránea</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="other" type="checkbox" id="other" {{ old('other') ? 'checked' : null }} {{ $patient->SpecificDiet->other == 'on' ? 'checked':'' }}>
								<label class="form-check-label" for="other">Otra</label>
							</div>
						</div>
						<div class="form-group col-md-6 mt-4">
							<label for="water">Agua durente el dia</label>
							<input type="number" class="form-control" id="water" placeholder="Ingrese los litros de agua que consume el paciente en un dia." value="{{ $patient->SpecificDiet->water }}" name="water">
						</div>
						<div class="col-md-6 mt-4">
							<div class="row">
								<div class="col-md-12">
									<h6><strong>Uso de suplementos</strong></h6>
								</div>
								<div class="col-md-12">
									<div class="form-check form-check-inline">
										<input class="form-check-input" name="vitamins" type="checkbox" id="vitamins" {{ old('vitamins') ? 'checked' : null }} {{ $patient->SpecificDiet->vitamins == 'on' ? 'checked':'' }}>
										<label class="form-check-label" for="vitamins">Vitaminas</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" name="proteins" type="checkbox" id="proteins" {{ old('proteins') ? 'checked' : null }} {{ $patient->SpecificDiet->proteins == 'on' ? 'checked':'' }}>
										<label class="form-check-label" for="proteins">Proteínas</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" name="aminoacids" type="checkbox" id="aminoacids" {{ old('aminoacids') ? 'checked' : null }} {{ $patient->SpecificDiet->aminoacids == 'on' ? 'checked':'' }}>
										<label class="form-check-label" for="aminoacids">Aminoácidos</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" name="none" type="checkbox" id="none" v{{ old('none') ? 'checked' : null }} {{ $patient->SpecificDiet->none == 'on' ? 'checked':'' }}>
										<label class="form-check-label" for="none">Ninguno</label>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<hr>
						</div>

						<div class="col-md-12">
							<h6><strong>Alergias alimentarias</strong></h6>
						</div>

						<div class="col-md-2 d-flex align-items-center justify-content-center">
							<label for="oilseed_allergy" class="mb-3">Oleaginosas</label>	
						</div>
						<div class="form-group col-md-10">
							<input type="text" class="form-control" id="oilseed_allergy" placeholder="Detalles de la alergia." value="{{ $patient->FoodAllergy->oilseed_allergy }}" name="oilseed_allergy">
						</div>

						<div class="col-md-2 d-flex align-items-center justify-content-center">
							<label for="fruit_allergy" class="mb-3">Frutas</label>	
						</div>
						<div class="form-group col-md-10">
							<input type="text" class="form-control" id="fruit_allergy" placeholder="Detalles de la alergia." value="{{ $patient->FoodAllergy->fruit_allergy }}" name="fruit_allergy">
						</div>

						<div class="col-md-2 d-flex align-items-center justify-content-center">
							<label for="vegetable_allergy" class="mb-3">Vegetales</label>	
						</div>
						<div class="form-group col-md-10">
							<input type="text" class="form-control" id="vegetable_allergy" placeholder="Detalles de la alergia." value="{{ $patient->FoodAllergy->vegetable_allergy }}" name="vegetable_allergy">
						</div>

						<div class="col-md-2 d-flex align-items-center justify-content-center">
							<label for="AOA_allergy" class="mb-3">AOA</label>	
						</div>
						<div class="form-group col-md-10">
							<input type="text" class="form-control" id="AOA_allergy" placeholder="Detalles de la alergia." value="{{$patient->FoodAllergy->AOA_allergy }}" name="AOA_allergy">
						</div>

						<div class="col-md-12">
							<hr>
						</div>

						<div class="form-group col-md-6">
							<label for="intolerance">Intolerancia</label>
							<input type="text" class="form-control" id="intolerance" placeholder="Ingrese los alimentos que no tolera el paciente." value="{{ $patient->FoodAllergy->intolerance }}" name="intolerance">
						</div>

						<div class="col-md-12">
							<hr>
						</div>
						<div class="col-md-12">
							<h5 class="mb-0"><strong>Cambios de peso</strong></h5>
						</div>
						<div class="col-md-12">
							<hr>
						</div>
						<div class="form-group col-md-6">
							<label for="max_weight">Máximo peso (KG)</label>
							<input type="text" class="form-control" id="max_weight" placeholder="Ingrese el peso maximo del paciente." value="{{ $patient->ChangeWeight->max_weight }}" name="max_weight">
						</div>
						<div class="form-group col-md-6">
							<label for="min_weight">Mínimo peso (KG)</label>
							<input type="text" class="form-control" id="min_weight" placeholder="Ingrese el peso mínimo del paciente." value="{{ $patient->ChangeWeight->min_weight }}" name="min_weight">
						</div>
						<div class="form-group col-md-6">
							<label for="usual_weight">Peso habitual (KG)</label>
							<input type="text" class="form-control" id="usual_weight" placeholder="Ingrese el peso habitual del paciente." value="{{ $patient->ChangeWeight->usual_weight }}" name="usual_weight">
						</div>
						<div class="form-group col-md-6">
							<label for="lastMonth">Peso del ultimo mes (KG)</label>
							<input type="text" class="form-control" id="lastMonth" placeholder="Ingrese el peso del ultimo mes del paciente." value="{{ $patient->ChangeWeight->lastMonth }}" name="lastMonth">
						</div>
						<div class="form-group col-md-6">
							<label for="lastThreeMonths">Peso de los ultimos 3 meses (KG)</label>
							<input type="text" class="form-control" id="lastThreeMonths" placeholder="Ingrese el peso de los ultimos 3 meses del paciente." value="{{ $patient->ChangeWeight->lastThreeMonths }}" name="lastThreeMonths">
						</div>
						<div class="form-group col-md-6">
							<label for="lastSixMonths">Peso de los ultimos 6 meses (KG)</label>
							<input type="text" class="form-control" id="lastSixMonths" placeholder="Ingrese el peso de los ultimos seis meses del paciente." value="{{ $patient->ChangeWeight->lastSixMonths }}" name="lastSixMonths">
						</div>
						<div class="col-md-12">
							<hr>
						</div>
					</div>
					<div class="row">
						<button type="submit" class="btn btn-success">Guardar Datos</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-3 offset-lg-4">
		<a href="{{ route('ClinicHistoryPatient', $patient->slug) }}" class="btn btn-primary">Ir a Historia del paciente</a>
	</div>
</div>
<br>
@endsection
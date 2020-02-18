@extends('layouts.admin')

@section('title')
Historia Clínica Nutricional
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card card-primary mt-4">
			<div class="card-header">
				<h3 class="mb-0">Evaluación Médica</h3>
			</div>
			<div class="card-body">
				<form action="{{ route('NutritionalClinicalHistory.store', $patient->slug) }}" method="POST">
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
							<textarea class="form-control" name="physical_activities" id="physical_activities" rows="3" style="resize: none;"></textarea>
						</div>
						<div class="form-group col-md-4 px-4">
							<label>Nivel de estrés</label>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="stress" id="high_stress" value="Mucho Estrés" checked>
								<label class="form-check-label" for="high_stress">
									Mucho Estrés
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="stress" id="exampleRadios2" value="Estrés Regular">
								<label class="form-check-label" for="exampleRadios2">
									Estrés Regular
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="stress" id="exampleRadios3" value="Poco Estrés">
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
							<h6><strong>Dieta específica</strong></h6>
						</div>
						<div class="col-md-12">
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="diet_salad" type="checkbox" id="diet_salad" {{ old('diet_salad') ? 'checked' : null }}>
								<label class="form-check-label" for="diet_salad">Ensaladas</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="diet_vegan" type="checkbox" id="diet_vegan" {{ old('diet_vegan') ? 'checked' : null }}>
								<label class="form-check-label" for="diet_vegan">Vegana</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="diet_crudiverian" type="checkbox" id="diet_crudiverian" {{ old('diet_crudiverian') ? 'checked' : null }}>
								<label class="form-check-label" for="diet_crudiverian">Crudiveriana</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="diet_ovogetarian" type="checkbox" id="diet_ovogetarian" {{ old('diet_ovogetarian') ? 'checked' : null }}>
								<label class="form-check-label" for="diet_ovogetarian">Ovogetariana</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="diet_ovolactovegetarian" type="checkbox" id="diet_ovolactovegetarian" {{ old('diet_ovolactovegetarian') ? 'checked' : null }}>
								<label class="form-check-label" for="diet_ovolactovegetarian">Ovolactovegetariana</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="diet_mediterranean" type="checkbox" id="diet_mediterranean" {{ old('diet_mediterranean') ? 'checked' : null }}>
								<label class="form-check-label" for="diet_mediterranean">Meditarránea</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="other" type="checkbox" id="other" {{ old('other') ? 'checked' : null }}>
								<label class="form-check-label" for="other">Otra</label>
							</div>
						</div>
						<div class="form-group col-md-6 mt-4">
							<label for="water">Agua durente el dia</label>
							<input type="number" class="form-control" id="water" placeholder="Ingrese los litros de agua que consume el paciente en un dia." value="{{ old('water') }}" name="water">
						</div>
						<div class="col-md-6 mt-4">
							<div class="row">
								<div class="col-md-12">
									<h6><strong>Uso de suplementos</strong></h6>
								</div>
								<div class="col-md-12">
									<div class="form-check form-check-inline">
										<input class="form-check-input" name="vitamins" type="checkbox" id="vitamins" {{ old('vitamins') ? 'checked' : null }}>
										<label class="form-check-label" for="vitamins">Vitaminas</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" name="proteins" type="checkbox" id="proteins" {{ old('proteins') ? 'checked' : null }}>
										<label class="form-check-label" for="proteins">Proteínas</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" name="aminoacids" type="checkbox" id="aminoacids" {{ old('aminoacids') ? 'checked' : null }}>
										<label class="form-check-label" for="aminoacids">Aminoácidos</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" name="none" type="checkbox" id="none" v{{ old('none') ? 'checked' : null }}>
										<label class="form-check-label" for="none">Ninguno</label>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<hr>
						</div>

						<div class="col-md-12">
							<h6><strong>Seleccione los alimentos de preferencia</strong></h6>
						</div>
						<div class="col-md-12">
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="salad" type="checkbox" id="salad" {{ old('salad') ? 'checked' : null }}>
								<label class="form-check-label" for="salad">Ensalada</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="red_meat" type="checkbox" id="red_meat" {{ old('red_meat') ? 'checked' : null }}>
								<label class="form-check-label" for="red_meat">Carne roja</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="fish" type="checkbox" id="fish" {{ old('fish') ? 'checked' : null }}>
								<label class="form-check-label" for="fish">Pescado</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="soup" type="checkbox" id="soup" {{ old('soup') ? 'checked' : null }}>
								<label class="form-check-label" for="soup">Sopa</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="pasta" type="checkbox" id="pasta" {{ old('pasta') ? 'checked' : null }}>
								<label class="form-check-label" for="pasta">Pasta</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="vegetable" type="checkbox" id="vegetable" {{ old('vegetable') ? 'checked' : null }}>
								<label class="form-check-label" for="vegetable">Verduras</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="fruit" type="checkbox" id="fruit" {{ old('fruit') ? 'checked' : null }}>
								<label class="form-check-label" for="fruit">Frutas</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="vegetarian" type="checkbox" id="vegetarian" {{ old('vegetarian') ? 'checked' : null }}>
								<label class="form-check-label" for="vegetarian">Vegetariana</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="vegan" type="checkbox" id="vegan" {{ old('vegan') ? 'checked' : null }}>
								<label class="form-check-label" for="vegan">Vegana</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="bird" type="checkbox" id="bird" {{ old('bird') ? 'checked' : null }}>
								<label class="form-check-label" for="bird">Aves</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="pork" type="checkbox" id="pork" {{ old('pork') ? 'checked' : null }}>
								<label class="form-check-label" for="pork">Cerdo</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="mexican" type="checkbox" id="mexican" {{ old('mexican') ? 'checked' : null }}>
								<label class="form-check-label" for="mexican">Mexicana</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" name="shellfish" type="checkbox" id="shellfish" {{ old('shellfish') ? 'checked' : null }}>
								<label class="form-check-label" for="shellfish">Mariscos</label>
							</div>
							<div class="col-md-12">
								<hr>
							</div>
						</div>
						<div class="form-group col-md-6 mt-2">
							<label for="food_not_prefer">Alimentos que no son de su preferencia</label>
							<input type="text" class="form-control" id="food_not_prefer" placeholder="Ingrese los alimentos que no le gustan al paciente." value="{{ old('food_not_prefer') }}" name="food_not_prefer">
						</div>
						<div class="form-group col-md-6 mt-2">
							<label for="alimentary_habits">Habitos alimentarios diarios</label>
							<input type="text" class="form-control" id="alimentary_habits" placeholder="Ingrese los habitos alimentarios diarios." value="{{ old('alimentary_habits') }}" name="alimentary_habits">
						</div>
						<div class="form-group col-md-6 mt-2">
							<label for="food_belief">Creencia sobre algunos alimentos</label>
							<input type="text" class="form-control" id="food_belief" placeholder="Ingrese la creencia de algunos alimentos." value="{{ old('food_belief') }}" name="food_belief">
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
							<input type="text" class="form-control" id="oilseed_allergy" placeholder="Detalles de la alergia." value="{{ old('oilseed_allergy') }}" name="oilseed_allergy">
						</div>

						<div class="col-md-2 d-flex align-items-center justify-content-center">
							<label for="fruit_allergy" class="mb-3">Frutas</label>	
						</div>
						<div class="form-group col-md-10">
							<input type="text" class="form-control" id="fruit_allergy" placeholder="Detalles de la alergia." value="{{ old('fruit_allergy') }}" name="fruit_allergy">
						</div>

						<div class="col-md-2 d-flex align-items-center justify-content-center">
							<label for="vegetable_allergy" class="mb-3">Vegetales</label>	
						</div>
						<div class="form-group col-md-10">
							<input type="text" class="form-control" id="vegetable_allergy" placeholder="Detalles de la alergia." value="{{ old('vegetable_allergy') }}" name="vegetable_allergy">
						</div>

						<div class="col-md-2 d-flex align-items-center justify-content-center">
							<label for="AOA_allergy" class="mb-3">AOA</label>	
						</div>
						<div class="form-group col-md-10">
							<input type="text" class="form-control" id="AOA_allergy" placeholder="Detalles de la alergia." value="{{ old('AOA_allergy') }}" name="AOA_allergy">
						</div>

						<div class="col-md-12">
							<hr>
						</div>

						<div class="form-group col-md-6">
							<label for="intolerance">Intolerancia</label>
							<input type="text" class="form-control" id="intolerance" placeholder="Ingrese los alimentos que no tolera el paciente." value="{{ old('intolerance') }}" name="intolerance">
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
							<label for="max_weight">Maximo peso (KG)</label>
							<input type="text" class="form-control" id="max_weight" placeholder="Ingrese el peso maximo." value="{{ old('max_weight') }}" name="max_weight">
						</div>
						<div class="form-group col-md-6">
							<label for="min_weight">Minimo peso (KG)</label>
							<input type="text" class="form-control" id="min_weight" placeholder="Ingrese el peso mínimo." value="{{ old('min_weight') }}" name="min_weight">
						</div>
						<div class="form-group col-md-6">
							<label for="usual_weight">Peso habitual (KG)</label>
							<input type="text" class="form-control" id="usual_weight" placeholder="Ingrese el peso habitual." value="{{ old('usual_weight') }}" name="usual_weight">
						</div>
						<div class="form-group col-md-6">
							<label for="lastMonth">Peso del ultimo mes (KG)</label>
							<input type="text" class="form-control" id="lastMonth" placeholder="Ingrese el peso del ultimo mes." value="{{ old('lastMonth') }}" name="lastMonth">
						</div>
						<div class="form-group col-md-6">
							<label for="lastThreeMonths">Peso de los ultimos 3 meses (KG)</label>
							<input type="text" class="form-control" id="lastThreeMonths" placeholder="Ingrese el peso de los ultimos 3 meses." value="{{ old('lastThreeMonths') }}" name="lastThreeMonths">
						</div>
						<div class="form-group col-md-6">
							<label for="lastSixMonths">Peso de los ultimos 6 meses (KG)</label>
							<input type="text" class="form-control" id="lastSixMonths" placeholder="Ingrese el peso de los ultimos seis meses." value="{{ old('lastSixMonths') }}" name="lastSixMonths">
						</div>
						<div class="col-md-12">
							<hr>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<button type="submit" class="btn btn-success">Guardar Datos</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
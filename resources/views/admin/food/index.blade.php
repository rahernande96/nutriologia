@extends('layouts.admin')

@section('title')
Alimentos
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card card-primary mt-4">
			<div class="card-header">
				<h3 class="card-title">Alimentos</h3>
			</div>
			<div class="card-body">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Grupo de alimento</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<div class="row">
							<div class="col-md-12 d-flex justify-content-end mb-4">
								<button type="button" class="btn btn-success mx-2" data-toggle="modal" data-target="#AddFood">
									Nuevo Alimento
								</button>
								<button type="button" class="btn btn-info mx-2" data-toggle="modal" data-target="#AddFoodGroup">
									Nuevo Grupo de Alimento
								</button>
								<!-- Modal alimento -->
								<div class="modal fade" id="AddFood" tabindex="-1" role="dialog" aria-labelledby="AddFood" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Nuevo Alimento</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<form action="{{ route('food.store') }}" method="POST">
												@csrf
												<div class="modal-body">
													<div class="row">
														<div class="col-md-12">
															<div class="form-group">
																<label for="food">Ingrese un nuevo alimento</label>
																<input type="text" class="form-control" id="food" placeholder="Ingrese un nuevo alimento" required name="name">
															</div>
															<div class="form-group">
																@if($food_group->isNotEmpty())
																<label for="foodGroup">Seleccione un grupo de alimento</label>
																<select class="form-control" id="foodGroup" name="id">
																	@foreach($food_group as $food)
																	<option value="{{ $food->id }}">{{ $food->name }}</option>
																	@endforeach
																</select>
																@else
																<p>
																No se ha ingresado ningun grupo de alimento.
																</p>
																@endif
																
															</div>
														</div>
													</div>
												</div>
												
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary">Guardar</button>
												</div>
											</form>
										</div>
									</div>

									<button class="btn btn-info">Agregar grupo de alimento</button>
								</div>
								<!-- Modal grupo de alimento -->
								<div class="modal fade" id="AddFoodGroup" tabindex="-1" role="dialog" aria-labelledby="AddFoodGroup" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Nuevo Grupo de Alimento</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<form action="{{ route('foodGroup.store') }}" method="POST">
												@csrf
												<div class="modal-body">
													<div class="row">
														<div class="col-md-12">
															<div class="form-group">
																<label for="food">Ingrese un nuevo gruo de alimento</label>
																<input type="text" class="form-control" id="food" placeholder="Ingrese un nuevo gruo de alimento" name="name" required>
															</div>
														</div>
													</div>
												</div>
												
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary">Guardar</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							@foreach($foods as $food)
							<tr class="text-center">
								<td>{{ $food->name }}</td>
								<td>{{ $food->FoodGroup->name }}</td>
								<td>
									<form action="#" method="POST">
										@csrf

									</div>
									<button type="submit" class="btn btn-success text-white">Eliminar alimento</button>
								</form>
							</td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>
	@endsection
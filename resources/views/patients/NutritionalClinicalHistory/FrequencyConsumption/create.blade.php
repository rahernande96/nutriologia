@extends('layouts.admin')

@section('title')
Frecuencia de consumo
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card card-primary mt-4">
			<div class="card-body">

				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Frecuencia de consumo</h3>

						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fas fa-minus"></i></button>
							</div>
						</div>
						<div class="card-body">
							{{-- Componente Draggable --}}
							<div id="foods">
								<foods :foods-group="{{ $foodsGroup }}" :foods="{{ $foods }}" :patient="{{ $patient }}"></foods>
							</div>
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
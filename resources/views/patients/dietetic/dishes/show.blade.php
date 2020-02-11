@extends('layouts.admin')

@section('title')
Platillos
@endsection

@section('extra-css')
<!-- easyautocomplete -->
<link rel="stylesheet" href="{{ asset('js/easyautocomplete/css/easy-autocomplete.min.css') }}">
@endsection

@section('content')

<div class="row">
	<div class="col-md-10 px-4">
		<h2 class="mt-5 mb-4">Diseño de Platillos de {{ $patient->name }}</h2>
	</div>
  
	{{-- Inicia tabla de platillos --}}
	<div class="col-md-12">
		<div class="card">
            <div class="card-header">
              <h3 class="card-title">Detalle de {{ $dish->name }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <h4 class="text-center m-4">{{ $dish->name }}</h4>
                                <div class="text-center mb-4">
                                    <img src="@if($dish->image != null){{ asset('storage/dishes/'.$dish->image) }}@else {{ asset('images/platillo.png')  }} @endif" class="rounded" alt="..." width="250px">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                                    <div class="attachment-block clearfix block-detail">
                                            
                                            <div class="attachment">
                                              <h5 class="attachment-heading">Preparación/notas</h5>
                          
                                              <div class="attachment-text mt-3">
                                                {{ $dish->notes }}
                                              </div>
                                              <!-- /.attachment-text -->
                                            </div>
                                            <!-- /.attachment-pushed -->
                                          </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                                <h5 class="text-center mt-4">Información de los ingredientes</h5>
                                <table class="table table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                                <th class="text-center">Ingrediente</th>
                                                <th class="text-center">Cantidad</th>
                                                <th class="text-center">Eq</th>
                                                <th class="text-center">Gr</th>
                                                <th class="text-center">Unidad</th>
                                                <th class="text-center">Grupo de Alimento</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($dish->details as $detail)
                                            <tr>
                                                <td>{{ $detail->ingredient->food }}</td>
                                                <td>{{ $detail->ingredient->quantity }}</td>
                                                <td>{{ $detail->ingredient->energy }}</td>
                                                <td>{{ $detail->gr }}</td>
                                                <td>{{ $detail->ingredient->unity }}</td>
                                                <td>{{ $detail->ingredient->group->name }}</td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-md-8 offset-md-2">
                                        <h5 class="text-center mt-4">Información de macronutrientes</h5>
                                    <table class="table table-bordered" width="100%">
                                        <thead>
                                            <tr>
                                                    <th class="text-center">Macro</th>
                                                    <th class="text-center">Gr</th>
                                                    <th class="text-center">Kcal</th>
                                                    <th class="text-center">%</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Proteinas</td>
                                                <td>{{ $protein }}</td>
                                                <td>{{ $kcal_proteins }}</td>
                                                <td>{{ $porcent_protein }}</td>
                                            </tr>
                                            <tr>
                                                <td>Hidratos de Carbono</td>
                                                <td>{{ $carbohydrate }}</td>
                                                <td>{{ $kcal_carbohydrates }}</td>
                                                <td>{{ $porcent_carbohydrate }}</td>
                                            </tr>
                                            <tr>
                                                <td>Lipidos</td>
                                                <td>{{ $lipid }}</td>
                                                <td>{{ $kcal_lipids }}</td>
                                                <td>{{ $porcent_lipid }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <a class="btn btn-primary" href="{{ route('dishes.index', $patient->slug) }}">Atras</a>
                            </div>
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

@section('extra-js')

@endsection

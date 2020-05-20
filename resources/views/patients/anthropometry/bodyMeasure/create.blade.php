@extends('layouts.admin')
@section('title')
Paciente: {{ $patient->name }}
@endsection
@section('extra-css')
    
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card mt-4">
            <div class="card-header">
                <div class="card-title">Medidas Corporales de {{ $patient->name }}
                    
                    <div class="dropdown show right">

                        <a href="{{ route('anthropometry.index', $patient->slug) }}" class="btn btn-primary">
                            Antropometría
                        </a>
                    
                        <a href="{{ route('ClinicHistoryPatient', $patient->slug) }}" class="btn btn-primary">
                            Historia Clínica
                        </a>
                        <a href="{{ route('dietetic.history.index', $patient->slug) }}" class="btn btn-primary">
                            Dietética
                        </a>
    
                    </div>

                </div>
            </div>
            
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::open(['route'=>'anthropometry.bodyMeasurePost','method'=>'POST','class'=>'form'])!!}
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="impedancia_biolectrica-tab" data-toggle="tab" href="#impedancia_biolectrica" role="tab" aria-controls="impedancia_biolectrica" aria-selected="true">Impedancia bioeléctrica</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="detail-tab" data-toggle="tab" href="#pliegue" role="tab" aria-controls="pliegue" aria-selected="false">Pliegues</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="detail-tab" data-toggle="tab" href="#perimetro" role="tab" aria-controls="perimetro" aria-selected="false">Perimetros</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="detail-tab" data-toggle="tab" href="#diametro" role="tab" aria-controls="diametro" aria-selected="false">Diametros</a>
                                </li>
                            </ul>
                            
                              <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade show active p-4" id="impedancia_biolectrica" role="tabpanel" aria-labelledby="impedancia_biolectrica-tab">
                                    @include('patients.anthropometry.bodyMeasure.fields_impedancia_bioelectrica')    
                                </div>
                                <div class="tab-pane fade p-4" id="pliegue" role="tabpanel" aria-labelledby="pliegue">
                                    @include('patients.anthropometry.bodyMeasure.fields_pliegues')    
                                </div>
                                <div class="tab-pane fade p-4" id="perimetro" role="tabpanel" aria-labelledby="perimetro">
                                    @include('patients.anthropometry.bodyMeasure.fields_perimetros') 
                                </div>
                                <div class="tab-pane fade p-4" id="diametro" role="tabpanel" aria-labelledby="diametro">
                                    <div class="col-10 offset-md-2">
                                        @include('patients.anthropometry.bodyMeasure.fields_diametros') 
                                    </div>
                                </div>
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <a href="{{ route('anthropometry.index', $patient->slug) }}" class="btn btn-danger">Cancelar</a>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div><!-- ./col -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-js')

@endsection
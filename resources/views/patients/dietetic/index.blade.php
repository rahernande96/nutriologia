@extends('layouts.admin')

@section('title')
Paciente: {{ $patient->name }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 mt-4">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h5 class="left">Ditetica de: <strong>{{ $patient->name }}</strong></h5>
                    <div class="dropdown show right">
                        <a href="{{ route('ClinicHistoryPatient', $patient->slug) }}" class="btn btn-primary">
                            Historia Clínica
                        </a>
                        <a href="{{ route('anthropometry.index', $patient->slug) }}" class="btn btn-primary">
                            Antropometría
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row d-flex justify-content-around">
                    <div class="card col-md-3">
                        <img src="{{ asset('Iconos/con_circulo/grafica_evolucion.png') }}" class="card-img-top mx-auto d-block" alt="Historia Clínica" style="width: 50%; object-fit: cover;">
                        <div class="card-body">
                            
                            <div class="info-menu mb-2">

                                <h5 class="card-title">Requerimiento Energético</h5>
                                <p class="card-text">Requerimiento de energía.</p>
                                

                            </div>

                            <a href="{{ route('dietetic.energyRequirement', $patient->slug) }}" class="btn btn-primary text-white ml-1" type="button" class="btn btn-info">@if($patient->EnergyRequirement) Editar Datos  @else Capturar Datos @endif</a>
                        </div>
                    </div>
                    <div class="card col-md-3">
                        <img src="{{ asset('Iconos/con_circulo/distribucion_equivalentes.png') }}" class="card-img-top mx-auto d-block" alt="Analisis Bioquímicos" style="width: 50%; object-fit: cover;">
                        <div class="card-body">
                            
                            <div class="info-menu mb-2">
                            
                                <h5 class="card-title">Distribución de Equivalentes</h5>
                            
                                <p class="card-text">Equivalentes de grupo de alimentos para tiempo de comida.</p>
                                
                            </div>
                            
                            <a href="{{ route('dietetic.equivalentDistribution', $patient->slug) }}" class="btn btn-primary text-white ml-1" type="button" class="btn btn-info">@if($patient->EquivalentDistribution) Editar Datos  @else Capturar Datos @endif</a>
                        </div>
                    </div>
                    <div class="card col-md-3">
                        <img src="{{ asset('Iconos/con_circulo/menu.png') }}" class="card-img-top mx-auto d-block" alt="Signos Vitales" style="width: 50%; object-fit: cover;">
                        <div class="card-body">
                            
                            <div class="info-menu mb-2">

                                <h5 class="card-title">Menú</h5>
                                <p class="card-text">Menú.</p>
                                

                            </div>

                            <a href="{{ route('dietetic.menu', $patient->slug) }}" class="btn btn-primary text-white ml-1" type="button" class="btn btn-info">Ver información</a>
                        </div>
                    </div>
                    <div class="card col-md-3">
                        <img src="{{ asset('Iconos/con_circulo/diseño_platillos.png') }}" class="card-img-top mx-auto d-block" alt="Historia Clínica Nutricional" style="width: 50%; object-fit: cover;">
                        <div class="card-body">
                       
                            <div class="info-menu mb-2">
                       
                                <h5 class="card-title">Diseño de Platillos</h5>
                       
                                <p class="card-text">Diseño de los platillos para las dietoterapias de los pacientes.</p>
                           
                            </div>

                            <a href="{{ route('dishes.index', $patient->slug) }}" class="btn btn-primary text-white ml-1" type="button" class="btn btn-info">Ver</a>
                       
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
    $('.dropdown-toggle').dropdown();
</script>
<script src="{{ asset('js/autoheight.js') }}"></script>
@endsection

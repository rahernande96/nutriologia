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
                        <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-undo mr-2"></i>Ir a
                        </a>
                      
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a href="{{ route('ClinicHistoryPatient', $patient->slug) }}" class="dropdown-item">
                                Historia Clínica
                            </a>
                            <a href="{{ route('anthropometry.index', $patient->slug) }}" class="dropdown-item">
                                Antropometría
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row d-flex justify-content-around">
                    <div class="card col-md-3">
                        <img src="{{ asset('images/clinic_history.png') }}" class="card-img-top" alt="Historia Clínica" style="width: 100%; height: 15vw; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Requerimiento Energético</h5>
                            <p class="card-text">Requerimiento de energía.</p>
                                <a href="{{ route('dietetic.energyRequirement', $patient->slug) }}" class="btn btn-primary text-white ml-1" type="button" class="btn btn-info">@if($patient->EnergyRequirement) Editar Datos  @else Capturar Datos @endif</a>
                        </div>
                    </div>
                    <div class="card col-md-3">
                        <img src="{{ asset('images/chemistry.jpg') }}" class="card-img-top" alt="Analisis Bioquímicos" style="width: 100%; height: 15vw; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Distribución de Equivalentes</h5>
                            <p class="card-text">Equivalentes de grupo de alimentos para tiempo de comida.</p>
                            <a href="{{ route('dietetic.equivalentDistribution', $patient->slug) }}" class="btn btn-primary text-white ml-1" type="button" class="btn btn-info">@if($patient->EquivalentDistribution) Editar Datos  @else Capturar Datos @endif</a>
                        </div>
                    </div>
                    <div class="card col-md-3">
                        <img src="{{ asset('images/vital_signs.png') }}" class="card-img-top" alt="Signos Vitales" style="width: 85%; height: 15vw; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Menú</h5>
                            <p class="card-text">Menú.</p>
                            <a href="{{ route('dietetic.menu', $patient->slug) }}" class="btn btn-primary text-white ml-1" type="button" class="btn btn-info">Ver información</a>
                        </div>
                    </div>
                    <div class="card col-md-3 w-25">
                        <img src="{{ asset('images/clinic_history_nutritional.jpg') }}" class="card-img-top" alt="Historia Clínica Nutricional" style="width: 100%; height: 15vw; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Diseño de Platillos</h5>
                            <p class="card-text">Diseño de los platillos para las dietoterapias de los pacientes.</p>
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
    $('.dropdown-toggle').dropdown()
</script>
@endsection

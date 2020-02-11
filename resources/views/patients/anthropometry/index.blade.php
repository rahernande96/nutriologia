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
                    <h5 class="left">Antropometría de:  <strong>{{ $patient->name }}</strong></h5>
                    <div class="dropdown show right">
                        <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-undo mr-2"></i> Ir a
                        </a>
                      
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a href="{{ route('ClinicHistoryPatient', $patient->slug) }}" class="dropdown-item">
                                Historia Clínica
                            </a>
                            <a href="{{ route('dietetic.index', $patient->slug) }}" class="dropdown-item">
                                Dietética
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
                            <h5 class="card-title">Medidas Básicas</h5>
                            <p class="card-text">Medidas Básicas Y Fórmulas Antropométricas</p>
                                <a href="{{ route('anthropometry.basicMeasure', $patient->slug) }}" class="btn btn-primary text-white ml-1" type="button" class="btn btn-info">@if($patient->BasicMeasure) Editar Datos  @else Capturar Datos @endif</a>
                        </div>
                    </div>
                    <div class="card col-md-3">
                        <img src="{{ asset('images/chemistry.jpg') }}" class="card-img-top" alt="Analisis Bioquímicos" style="width: 100%; height: 15vw; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Medidas Corporales</h5>
                            <p class="card-text">Medidas de la composición corporal del paciente.</p>
                            <a href="{{ route('anthropometry.bodyMeasure', $patient->slug) }}" class="btn btn-primary text-white ml-1" type="button" class="btn btn-info">@if($patient->BodyMeasure) Editar Datos  @else Capturar Datos @endif</a>
                        </div>
                    </div>
                    <div class="card col-md-3">
                        <img src="{{ asset('images/vital_signs.png') }}" class="card-img-top" alt="Signos Vitales" style="width: 85%; height: 15vw; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Composición Corporal</h5>
                            <p class="card-text">Composición corporal y formulas antropométricas.</p>
                            <a href="{{ route('anthropometry.bodyComposition', $patient->slug) }}" class="btn btn-primary text-white ml-1" type="button" class="btn btn-info">Ver información</a>
                        </div>
                    </div>
                    <div class="card col-md-3 w-25">
                        <img src="{{ asset('images/clinic_history_nutritional.jpg') }}" class="card-img-top" alt="Historia Clínica Nutricional" style="width: 100%; height: 15vw; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Somatocarta</h5>
                            <p class="card-text">Carta Somatográfica.</p>
                            <a href="{{ route('anthropometry.somatocard', $patient->slug) }}" class="btn btn-primary text-white ml-1" type="button" class="btn btn-info">@if($patient->Medition_corporate) Editar Datos  @else Capturar Datos @endif</a>
                        </div>
                    </div>
                    <!--
                    <div class="card col-md-3">
                        <img src="{{ asset('images/clinic_history_nutritional.jpg') }}" class="card-img-top" alt="Historia Clínica Nutricional" style="width: 100%; height: 15vw; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Grafica de Evolución</h5>
                            <p class="card-text">Gafica d el aevolución del paciente en sus medidas antropometricas.</p>
                            <a href="{{ route('anthropometry.evolutionCard', $patient->slug) }}" class="btn btn-primary text-white ml-1" type="button" class="btn btn-info">@if($patient->Medition_corporate) Editar Datos  @else Capturar Datos @endif</a>
                        </div>
                    </div>
                    -->
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

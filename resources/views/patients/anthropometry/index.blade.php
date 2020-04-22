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
                <div class="row d-flex justify-content-around">
                    <div class="card col-md-3">
                        <img src="{{ asset('Iconos/con_circulo/medidas_basicas.png') }}" class="card-img-top mx-auto d-block" alt="Historia Clínica" style="width: 50%; object-fit: cover;">
                        <div class="card-body">
                            
                            <div class="info-menu mb-2">
                                
                                <h5 class="card-title">Medidas Básicas</h5>
                                <p class="card-text">Medidas Básicas Y Fórmulas Antropométricas</p>
                            
                            </div>
                            
                            <a href="{{ route('anthropometry.basicMeasure', $patient->slug) }}" class="btn btn-primary text-white ml-1" type="button" class="btn btn-info">@if($patient->BasicMeasure) Editar Datos  @else Capturar Datos @endif</a>
                        
                        </div>
                    </div>
                    <div class="card col-md-3">
                        <img src="{{ asset('Iconos/con_circulo/medidas_corporales.png') }}" class="card-img-top mx-auto d-block" alt="Analisis Bioquímicos" style="width: 50%; object-fit: cover;">
                        <div class="card-body">
                            
                            <div class="info-menu mb-2">

                                <h5 class="card-title">Medidas Corporales</h5>
                                <p class="card-text">Medidas de la composición corporal del paciente.</p>

                            </div>

                            <a href="{{ route('anthropometry.bodyMeasure', $patient->slug) }}" class="btn btn-primary text-white ml-1" type="button" class="btn btn-info">@if($patient->BodyMeasure) Editar Datos  @else Capturar Datos @endif</a>
                        </div>
                    </div>
                    <div class="card col-md-3">
                        <img src="{{ asset('Iconos/con_circulo/composicion_corporal.png') }}" class="card-img-top mx-auto d-block" alt="Signos Vitales" style="width: 50%; object-fit: cover;">
                        <div class="card-body">
                            
                            <div class="info-menu mb-2">

                                <h5 class="card-title">Composición Corporal</h5>
                                <p class="card-text">Composición corporal y formulas antropométricas.</p>

                            </div>

                            <a href="{{ route('anthropometry.bodyComposition', $patient->slug) }}" class="btn btn-primary text-white ml-1" type="button" class="btn btn-info">Ver información</a>
                        </div>
                    </div>
                    <div class="card col-md-3">
                        <img src="{{ asset('Iconos/con_circulo/Somatocarta.png') }}" class="card-img-top mx-auto d-block" alt="Historia Clínica Nutricional" style="width: 50%; object-fit: cover;">
                        <div class="card-body">
                            
                            <div class="info-menu mb-2">

                                <h5 class="card-title">Somatocarta</h5>
                                <p class="card-text">Carta Somatográfica.</p>

                            </div>
                            
                            <a href="{{ route('anthropometry.somatocard', $patient->slug) }}" class="btn btn-primary text-white ml-1" type="button" class="btn btn-info">@if($patient->Medition_corporate) Editar Datos  @else Capturar Datos @endif</a>
                        </div>
                    </div>
                    
                    {{-- <div class="card col-md-3">
                        <img src="{{ asset('images/clinic_history_nutritional.jpg') }}" class="card-img-top mx-auto d-block" alt="Historia Clínica Nutricional" style="width: 50%; height: 15vw; object-fit: cover;">
                        <div class="card-body">

                            <div class="info-menu mb-2">
                                
                                <h5 class="card-title">Grafica de Evolución</h5>
                                <p class="card-text">Gafica d el aevolución del paciente en sus medidas antropometricas.</p>
                            
                            </div>
                            <a href="{{ route('anthropometry.evolutionCard', $patient->slug) }}" class="btn btn-primary text-white ml-1" type="button" class="btn btn-info">@if($patient->Medition_corporate) Editar Datos  @else Capturar Datos @endif</a>
                        </div>
                    </div> --}}
                    
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

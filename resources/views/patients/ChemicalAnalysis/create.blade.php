@extends('layouts.admin')

@section('title')
Analisis Químicos
@endsection

@section('extra-css')
<style>
    [data-toggle="collapse"] .fa:before {   
    content: "\f068";
  }
  
  [data-toggle="collapse"].collapsed .fa:before {
    content: "\f067";
  }
  
</style>
@endsection

@section('content')
<div class="container flex">
    <div class="row">
        {{-- Card Química Sanguinea --}}
        @if($patient->BloodChemistry)
            @include('partials.patients.bloodChemistry.editBloodChemistry')
            @else
            <div class="col-md-12">
                <div class="card card-primary mt-4">
                    <div class="card-header">
                        <h3 class="card-title">Química Sanguinea</h3>
                        <div class="card-tools">
                            <button class="btn btn-link text-white btn-block collapsed" type="button" data-toggle="collapse" data-target="#BloodChemistry" aria-expanded="true" aria-controls="BloodChemistry">
                                <i class="fa fa-plus fa-md"></i>
                            </button>
                        </div>
                    </div>
                    <div id="BloodChemistry" class="collapse show" aria-labelledby="BloodChemistry" data-parent="#BloodChemistry">
                        <div class="card-body">
                            <form action="{{ route('bloodChemistry.store', $patient->slug) }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="glucose">Glucosa en ayuno</label>
                                        <input type="number" min="0" step="0.1" min="0" step="0.1" class="form-control" id="glucose" placeholder="Glucosa en ayuno Glucosa" value="{{ old('glucose') }}" name="glucose" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                            data-placement="top" data-title="70 a 100 mg/dl< 140 mg/dl">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="glucose_pp">Glucosa en ayuno a 2h PP</label>
                                        <input type="number" min="0" step="0.1" min="0" step="0.1" class="form-control" id="glucose_pp" placeholder="Glucosa en ayuno Glucosa a 2 h PP" value="{{ old('glucose_pp') }}" name="glucose_pp" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                            data-placement="top" data-title="70 a 100 mg/dl< 140 mg/dl">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="proteins">Proteinas Totales</label>
                                        <input type="number" min="0" step="0.1" id="proteins" class="form-control" placeholder="Proteinas Totales" value="{{ old('proteins') }}" name="proteins" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                            data-placement="top" data-title="6.4 a 8.3 mg/dl">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="albumin">Albúmina Sérica</label>
                                        <input type="number" min="0" step="0.1" class="form-control" id="albumin" placeholder="Albúmina Sérica" value="{{ old('albumin') }}" name="albumin" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                            data-title="3.5 a 5.0 g/dl">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="transferrin">Transferina Sérica</label>
                                        <input type="number" min="0" step="0.1" class="form-control" id="transferrin" placeholder="Transferina Sérica" value="{{ old('transferrin') }}" name="transferrin" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                            data-placement="top" data-title="200 a 400 mg/dl">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="prealbumin">Prealbúmina</label>
                                        <input type="number" min="0" step="0.1" class="form-control" id="prealbumin" placeholder="Prealbúmina" value="{{ old('prealbumin') }}" name="prealbumin" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                            data-placement="top" data-title="10 a 40 mg/dl">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="globulin">Globulina</label>
                                        <input type="number" min="0" step="0.1" class="form-control" id="globulin" placeholder="Globulina" value="{{ old('globulin') }}" name="globulin" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                            data-title="2 a 3.5 g/dl">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="reason_alb">Razón alb./glob.</label>
                                        <input type="number" min="0" step="0.1" class="form-control" id="reason_alb" placeholder="Razón alb./glob." value="{{ old('reason_alb') }}" name="reason_alb" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top" data-title="1.5:1 a 2.5:1">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="BUN">BUN</label>
                                        <input type="number" min="0" step="0.1" class="form-control" id="BUN" placeholder="BUN" value="{{ old('BUN') }}" name="BUN" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top" data-title="8 a 22 mg/dl">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="creatinine">Creatinina</label>
                                        <input type="number" min="0" step="0.1" class="form-control" id="creatinine" placeholder="Creatinina" value="{{ old('creatinine') }}" name="creatinine" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                            data-title="0.5 a 1.2 mg/dl">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="uric_acid">Ácido Úrico</label>
                                        <input type="number" min="0" step="0.1" class="form-control" id="uric_acid" placeholder="Ácido Úrico" value="{{ old('uric_acid') }}" name="uric_acid" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                            data-title="< 6 mujeres < 8 hombres">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="total_ammonium">Amonio Total</label>
                                        <input type="number" min="0" step="0.1" class="form-control" id="total_ammonium" placeholder="Amonio Total" value="{{ old('total_ammonium') }}" name="total_ammonium" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                            data-placement="top" data-title="10 a 70 μg/dl en suero(60-100 μg /dl en sangre tot.)">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="Ca">Calcio</label>
                                        <input type="number" min="0" step="0.1" class="form-control" id="Ca" placeholder="Calcio" value="{{ old('Ca') }}" name="Ca" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top" data-title="9 a 10 mg/dl">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="Na">Sodio</label>
                                        <input type="number" min="0" step="0.1" class="form-control" id="Na" placeholder="Sodio" value="{{ old('Na') }}" name="Na" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                            data-title="135 a 145 mg/dl">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="K">Potasio</label>
                                        <input type="number" min="0" step="0.1" class="form-control" id="K" placeholder="Potasio" value="{{ old('Ka') }}" name="Ka" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                            data-title="3.5 a 5 meq/dl">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="P">Fosforo</label>
                                        <input type="number" min="0" step="0.1" class="form-control" id="P" placeholder="Fosforo" value="{{ old('P') }}" name="P" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top" data-title="2.2 a 4.3 meq/L">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="Cl">Cloro</label>
                                        <input type="number" min="0" step="0.1" class="form-control" id="Cl" placeholder="Cloro" value="{{ old('Cl') }}" name="Cl" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top" data-title="98 a 2.8 meq/L">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="Mg">Magnesio</label>
                                        <input type="number" min="0" step="0.1" class="form-control" id="Mg" placeholder="Magnesio" value="{{ old('Mg') }}" name="Mg" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                            data-title="1.7 a 2.8 meq/L">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="CO2">Dioxido de Carbono</label>
                                        <input type="number" min="0" step="0.1" class="form-control" id="CO2" placeholder="Dioxido de Carbono" value="{{ old('CO2') }}" name="CO2" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                            data-title="23 a 30 meq/L">
                                    </div>
                                    
                                </div>
                                <div class="form-group col-md-3 ml-auto">
                                    <button type="submit" class="btn btn-success btn-block">
                                        Guardar Datos
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            {{-- Termina Card Química Sanguinea --}}

            {{-- Card Biometría Hemática --}}
            @if($patient->HematicBiometry)
                @include('partials.patients.hematicBiometry.editHematicBiometry')
                @else
                <div class="col-md-12">
                    <div class="card card-primary mt-4">
                        <div class="card-header">
                            <h3 class="card-title">Biometría Hemática</h3>
                            <div class="card-tools">
                                {{--<button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="collapse" title="Collapse">
                                    <i class="fa"></i></button>--}}
                                    <button class="btn btn-link text-white btn-block" type="button" data-toggle="collapse" data-target="#HematicBiometry" aria-expanded="true" aria-controls="HematicBiometry">
                                        <i class="fa fa-plus fa-md"></i>
                                    </button>
                            </div>
                        </div>
                        <div id="HematicBiometry" class="collapse " aria-labelledby="HematicBiometry" data-parent="#HematicBiometry">
                            <div class="card-body">
                                <form action="{{ route('hematicBiometry.store', $patient->slug) }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="WBC">Células Blancas</label>
                                            <input type="number" min="0" step="0.1" class="form-control" id="WBC" placeholder="Células Blancas" value="{{ old('WBC') }}" name="WBC" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                                data-title="5,000 a 10,000/mm³">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="RBC">Eritrocitos</label>
                                            <input type="number" min="0" step="0.1" id="RBC" class="form-control" placeholder="Eritrocitos" value="{{ old('RBC') }}" name="RBC" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                                data-title="4.7 a 6.1 x 106/μg♂ 4.2 a 5.4 x 106μg ♀">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="HGB">Hemoglobina</label>
                                            <input type="number" min="0" step="0.1" class="form-control" id="HGB" placeholder="Hemoglobina" value="{{ old('HGB') }}" name="HGB" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                                data-title="14 a 18 g/dl♂ 12 a 16 g/dl♀">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="HCT">Hematocrito</label>
                                            <input type="number" min="0" step="0.1" class="form-control" id="HCT" placeholder="Hematocrito" value="{{ old('HCT') }}" name="HCT" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                                data-title="42 a 52%♂ 37 a 47 %♀">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="VCM">Volúmen Corporal Medio</label>
                                            <input type="number" min="0" step="0.1" class="form-control" id="VCM" placeholder="Volúmen Corporal Medio" value="{{ old('VCM') }}" name="VCM" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                                data-title="82 a 98 fl">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="HCM">Hemoglobina Corporal Media</label>
                                            <input type="number" min="0" step="0.1" class="form-control" id="HCM" placeholder="Hemoglobina Corporal Media" value="{{ old('HCM') }}" name="HCM" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                                data-title="27 a 33 pg">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="HCM_promedy">Hemoglobina Corporal Promedio</label>
                                            <input type="number" min="0" step="0.1" class="form-control" id="HCM_promedy" placeholder="Hemoglobina Corporal Promedio" value="{{ old('HCM_promedy') }}" name="HCM_promedy" data-trigger="focus" data-toggle="tooltip"
                                                data-container="body" data-placement="top" data-title="32 a 36 %">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="neutrophils">Neutrófilos</label>
                                            <input type="number" min="0" step="0.1" class="form-control" id="neutrophils" placeholder="Neutrófilos" value="{{ old('neutrophils') }}" name="neutrophils" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                                data-placement="top" data-title="55 a 70 %">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="lymphocytes">Linfocitos</label>
                                            <input type="number" min="0" step="0.1" class="form-control" id="lymphocytes" placeholder="Linfocitos" value="{{ old('lymphocytes') }}" name="lymphocytes" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                                data-placement="top" data-title="20 a 40 %">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="monocytes">Monocitos</label>
                                            <input type="number" min="0" step="0.1" class="form-control" id="monocytes" placeholder="Monocitos" value="{{ old('monocytes') }}" name="monocytes" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                                data-title="2 a 8 %">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="eosinophils">Eosinófilos</label>
                                            <input type="number" min="0" step="0.1" class="form-control" id="eosinophils" placeholder="Eosinófilos" value="{{ old('eosinophils') }}" name="eosinophils" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                                data-placement="top" data-title="1 a 4 %">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="basophils">Basófilos</label>
                                            <input type="number" min="0" step="0.1" class="form-control" id="basophils" placeholder="Basófilos" value="{{ old('basophils') }}" name="basophils" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                                data-title="0.5 a 1 %">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="PLT">Plaquetas</label>
                                            <input type="number" min="0" step="0.1" class="form-control" id="PLT" placeholder="Plaquetas" value="{{ old('PLT') }}" name="PLT" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                                data-title="150,000 a 400,000 por mm3">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <button type="submit" class="btn btn-success btn-block">
                                                Guardar Datos
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                {{-- Termina Card Biometría Hemática --}}

                {{-- Card Vitaminas y minerales --}}
                @if($patient->VitaminMineral)
                    @include('partials.patients.vitaminMineral.editVitaminMineral')
                    @else
                    <div class="col-md-12">
                        <div class="card card-primary mt-4">
                            <div class="card-header">
                                <h3 class="card-title">Vitaminas Y Minerales</h3>
                                <div class="card-tools">
                                    {{--<button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>--}}
                                    <button class="btn btn-link text-white btn-block" type="button" data-toggle="collapse" data-target="#VitaminMineral" aria-expanded="true" aria-controls="VitaminMineral">
                                        <i class="fa fa-plus fa-md"></i>
                                    </button>
                                </div>
                            </div>
                            <div id="VitaminMineral" class="collapse" aria-labelledby="VitaminMineral" data-parent="#VitaminMineral">
                                <div class="card-body">
                                    <form action="{{ route('vitaminMineral.store', $patient->slug) }}" method="post">
                                        @csrf

                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="thiamin">Tiamina sérica</label>
                                                <input type="number" min="0" step="0.1" class="form-control" id="thiamin" placeholder="Tiamina sérica actividad de transcetolasa eritrocitaria" value="{{ old('thiamin') }}" name="thiamin" data-trigger="focus"
                                                    data-toggle="tooltip" data-container="body" data-placement="top" data-title="10 a 64 ng/ml Déficit > 20%">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="pyridoxine">Piridoxina</label>
                                                <input type="number" min="0" step="0.1" id="pyridoxine" class="form-control" placeholder="Piridoxina" value="{{ old('pyridoxine') }}" name="pyridoxine" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                                    data-placement="top" data-title="5 a 64 ng/ml Déficit < 3 ng/ml">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="cobalamin">Cobalamina</label>
                                                <input type="number" min="0" step="0.1" class="form-control" id="cobalamin" placeholder="Cobalamina" value="{{ old('cobalamin') }}" name="cobalamin" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                                    data-placement="top" data-title="200 - 1000pg/ml Déficit < 200pg/ml">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="B12">Vitamina B12 Homosisteína</label>
                                                <input type="number" min="0" step="0.1" class="form-control" id="B12" placeholder="Vitamina B12 Homosisteína" value="{{ old('B12') }}" name="B12" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                                    data-placement="top" data-title="210 a 911 pg/ml 4 a 12 μmol/L">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="folate">Foltato Eritrocitario</label>
                                                <input type="number" min="0" step="0.1" class="form-control" id="folate" placeholder="Foltato Eritrocitario" value="{{ old('folate') }}" name="folate" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                                    data-placement="top" data-title="280 a 291 ng/ml Déficit < 227 nmol/L">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="iron">Hierro Sérico</label>
                                                <input type="number" min="0" step="0.1" class="form-control" id="iron" placeholder="Hierro Sérico" value="{{ old('iron') }}" name="iron" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                                    data-title="Varones 15 a 200 Mujeres 12 a 150 Déficit <50 μg/dl">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="ferritin">Ferritina</label>
                                                <input type="number" min="0" step="0.1" class="form-control" id="ferritin" placeholder="Hierro Sérico" value="{{ old('ferritin') }}" name="ferritin" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                                    data-placement="top" data-title="Déficit < 20 ng/ml">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="vitamin_a">Vitamina A (retinol plasmático)</label>
                                                <input type="number" min="0" step="0.1" class="form-control" id="vitamin_a" placeholder="Vitamina A (retinol plasmático)" value="{{ old('vitamin_a') }}" name="vitamin_a" data-trigger="focus" data-toggle="tooltip"
                                                    data-container="body" data-placement="top" data-title="27 a 80 μg/dl">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="OH">25 (OH) D</label>
                                                <input type="number" min="0" step="0.1" class="form-control" id="OH" placeholder="25 (OH) D" value="{{ old('OH') }}" name="OH" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                                    data-title="25 a 40 ng/ml Déficit < 20 ng/ml">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="vitamin_e">Vitamina E (α-tocoferol plasmático)</label>
                                                <input type="number" min="0" step="0.1" class="form-control" id="vitamin_e" placeholder="Vitamina E (α-tocoferol plasmático)" value="{{ old('vitamin_e') }}" name="vitamin_e" data-trigger="focus" data-toggle="tooltip"
                                                    data-container="body" data-placement="top" data-title="5 a 20 μg/dl Déficit <5 μg/dl">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="vitamin_k">Vitamina K (TP)</label>
                                                <input type="number" min="0" step="0.1" class="form-control" id="vitamin_k" placeholder="Vitamina K (TP)" value="{{ old('vitamin_k') }}" name="vitamin_k" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                                    data-placement="top" data-title="10 a 13 segundos.">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="zinc">Zinc (en plasma)</label>
                                                <input type="number" min="0" step="0.1" class="form-control" id="zinc" placeholder="Zinc (en plasma)" value="{{ old('zinc') }}" name="zinc" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                                    data-title="1 a 4 %">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="selenium">Selenio</label>
                                                <input type="number" min="0" step="0.1" class="form-control" id="selenium" placeholder="Selenio" value="{{ old('selenium') }}" name="selenium" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                                    data-title="0.5 a 1 %">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <button type="submit" class="btn btn-success btn-block">
                                                    Guardar Datos
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    {{-- Termina Card Vitaminas y minerales --}}

                    {{-- Card Perfil del Lípidos --}}
                    @if($patient->LipidProfile)
                        @include('partials.patients.lipidProfile.editLipidProfile')
                        @else
                        <div class="col-md-12">
                            <div class="card card-primary mt-4">
                                <div class="card-header">
                                    <h3 class="card-title">Perfil de Lípidos</h3>
                                    <div class="card-tools">
                                        {{--<button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                            <i class="fa fa-minus"></i>
                                        </button>--}}
                                        <button class="btn btn-link text-white btn-block" type="button" data-toggle="collapse" data-target="#LipidProfile" aria-expanded="true" aria-controls="LipidProfile">
                                            <i class="fa fa-plus fa-md"></i>
                                        </button>
                                    </div>
                                </div>
                                <div id="LipidProfile" class="collapse" aria-labelledby="LipidProfile" data-parent="#LipidProfile">
                                    <div class="card-body">
                                        <form action="{{ route('lipidProfile.store', $patient->slug) }}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label for="total_cholesterol">Colesterol total</label>
                                                    <input type="number" min="0" step="0.1" class="form-control" id="total_cholesterol" placeholder="Colesterol total" value="{{ old('total_cholesterol') }}" name="total_cholesterol" data-trigger="focus" data-toggle="tooltip"
                                                        data-container="body" data-placement="top" data-title="< 200 mg/dl">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="HDL_cholesterol">Colesterol HDL</label>
                                                    <input type="number" min="0" step="0.1" id="HDL_cholesterol" class="form-control" placeholder="Colesterol HDL" value="{{ old('HDL_cholesterol') }}" name="HDL_cholesterol" data-trigger="focus" data-toggle="tooltip"
                                                        data-container="body" data-placement="top" data-title="40 mg/dl ♂ >50 mg/dl ♀">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="LDL_cholesterol">Colesteroal LDL</label>
                                                    <input type="number" min="0" step="0.1" class="form-control" id="LDL_cholesterol" placeholder="Colesteroal LDL" value="{{ old('LDL_cholesterol') }}" name="LDL_cholesterol" data-trigger="focus" data-toggle="tooltip"
                                                        data-container="body" data-placement="top" data-title="< 100 mg/dl">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="triglycerides">Triglicéridos</label>
                                                    <input type="number" min="0" step="0.1" class="form-control" id="triglycerides" placeholder="Triglicéridos" value="{{ old('triglycerides') }}" name="triglycerides" data-trigger="focus" data-toggle="tooltip"
                                                        data-container="body" data-placement="top" data-title="40 a 160 mg/dl ♂ 35 a 135 mg/dl ♀">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <button type="submit" class="btn btn-success btn-block">
                                                        Guardar Datos
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        {{-- Termina Card Perfil del Lípidos --}}

                        {{-- Card Perfil Tiroideo --}}
                        @if($patient->ThyroidProfile)
                            @include('partials.patients.thyroidProfile.editThyroidProfile')
                            @else
                            <div class="col-md-12">
                                <div class="card card-primary mt-4">
                                    <div class="card-header">
                                        <h3 class="card-title">Perfil Tiroideo</h3>
                                        <div class="card-tools">
                                            {{--<button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                <i class="fa fa-minus"></i>
                                            </button>--}}
                                            <button class="btn btn-link text-white btn-block" type="button" data-toggle="collapse" data-target="#ThyroidProfile" aria-expanded="true" aria-controls="ThyroidProfile">
                                                <i class="fa fa-plus fa-md"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div id="ThyroidProfile" class="collapse" aria-labelledby="ThyroidProfile" data-parent="#ThyroidProfile">
                                        <div class="card-body">
                                            <form action="{{ route('thyroidProfile.store', $patient->slug) }}" method="post">
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <label for="T4">Tiroxina (T4)</label>
                                                        <input type="number" min="0" step="0.1" class="form-control" id="T4" placeholder="Tiroxina (T4)" value="{{ old('T4') }}" name="T4" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                                            data-title="5 a 12 μg/dl">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="T4_free">T4 Libre</label>
                                                        <input type="number" min="0" step="0.1" id="T4_free" class="form-control" placeholder="T4 Libre" value="{{ old('T4_free') }}" name="T4_free" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                                            data-placement="top" data-title="0.8 a 2.8 ng/dl">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="T3_total">Triyodotironina (T3 total)</label>
                                                        <input type="number" min="0" step="0.1" class="form-control" id="T3_total" placeholder="Triyodotironina (T3 total)" value="{{ old('T3_total') }}" name="T3_total" data-trigger="focus" data-toggle="tooltip"
                                                            data-container="body" data-placement="top" data-title="< 100 mg/dl">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="TSH">TSH</label>
                                                        <input type="number" min="0" step="0.1" class="form-control" id="TSH" placeholder="TSH" value="{{ old('TSH') }}" name="TSH" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                                            data-title="40 a 160 mg/dl ♂ 35 a 135 mg/dl ♀">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-3">
                                                        <button type="submit" class="btn btn-success btn-block">
                                                            Guardar Datos
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            {{-- Termina Card Perfil Tiroideo --}}

                            {{-- Card Orina --}}
                            @if($patient->Urine)
                                @include('partials.patients.urine.editUrine')
                                @else
                                <div class="col-md-12">
                                    <div class="card card-primary mt-4">
                                        <div class="card-header">
                                            <h3 class="card-title">Orina de 24 Horas</h3>
                                            <div class="card-tools">
                                                {{--<button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                    <i class="fa fa-minus"></i>
                                                </button>--}}
                                                <button class="btn btn-link text-white btn-block" type="button" data-toggle="collapse" data-target="#Urine" aria-expanded="true" aria-controls="Urine">
                                                    <i class="fa fa-plus fa-md"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div id="Urine" class="collapse" aria-labelledby="Urine" data-parent="#Urine">
                                            <div class="card-body">
                                                <form action="{{ route('urine.store', $patient->slug) }}" method="post">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="form-group col-md-4">
                                                            <label for="amylase">Amilasa</label>
                                                            <input type="number" min="0" step="0.1" class="form-control" id="amylase" placeholder="Amilasa" value="{{ old('amylase') }}" name="amylase" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                                                data-placement="top" data-title="6.5 a 48.1 U/h">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="creatinine">Creatinina</label>
                                                            <input type="number" min="0" step="0.1" id="creatinine" class="form-control" placeholder="Creatinina" value="{{ old('creatinine') }}" name="creatinine" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                                                data-placement="top" data-title="0.8 a 2g/d">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="urea">Urea</label>
                                                            <input type="number" min="0" step="0.1" class="form-control" id="urea" placeholder="Urea" value="{{ old('urea') }}" name="urea" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                                                data-title="20 a 40 g/d">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="Ca">Calcio</label>
                                                            <input type="number" min="0" step="0.1" class="form-control" id="Ca" placeholder="Calcio" value="{{ old('Ca') }}" name="Ca" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                                                data-title="20 a 40 g/d">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="Na">Sodio</label>
                                                            <input type="number" min="0" step="0.1" class="form-control" id="Na" placeholder="Sodio" value="{{ old('Na') }}" name="Na" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                                                data-title="40 a 220 meq/L/d">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="K">Potasio</label>
                                                            <input type="number" min="0" step="0.1" class="form-control" id="K" placeholder="Potasio" value="{{ old('K') }}" name="K" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                                                data-title="25 a 100 meq/L/d">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-3">
                                                            <button type="submit" class="btn btn-success btn-block">
                                                                Guardar Datos
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                {{-- Termina Card Orina --}}

                                {{-- Card General de Orina --}}
                                @if($patient->UrineTest)
                                    @include('partials.patients.urineTest.editUrineTest')
                                    @else
                                    <div class="col-md-12">
                                        <div class="card card-primary mt-4">
                                            <div class="card-header">
                                                <h3 class="card-title">Exámen General de Orina (EGO)</h3>
                                                <div class="card-tools">
                                                    {{--<button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                        <i class="fa fa-minus"></i>
                                                    </button>--}}
                                                    <button class="btn btn-link text-white btn-block" type="button" data-toggle="collapse" data-target="#UrineTest" aria-expanded="true" aria-controls="UrineTest">
                                                        <i class="fa fa-plus fa-md"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div id="UrineTest" class="collapse" aria-labelledby="UrineTest" data-parent="#UrineTest">
                                                <div class="card-body">
                                                    <form action="{{ route('urineTest.store', $patient->slug) }}" method="post">
                                                        @csrf

                                                        <div class="row">
                                                            <div class="form-group col-md-4">
                                                                <label for="pH">pH</label>
                                                                <input type="number" min="0" step="0.1" class="form-control" id="pH" placeholder="pH" value="{{ old('pH') }}" name="pH" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                                                    data-title="4.6 a 8">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="protein">Proteína</label>
                                                                <input type="number" min="0" step="0.1" id="protein" class="form-control" placeholder="Proteína" value="{{ old('protein') }}" name="protein" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                                                    data-placement="top" data-title="Negativo">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="specific_gravity">Gravedad Específica</label>
                                                                <input type="number" min="0" step="0.1" class="form-control" id="specific_gravity" placeholder="Gravedad Específica" value="{{ old('specific_gravity') }}" name="specific_gravity" data-trigger="focus"
                                                                    data-toggle="tooltip" data-container="body" data-placement="top" data-title="1.005 a 1.030">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="glucose">Glucosa</label>
                                                                <input type="number" min="0" step="0.1" class="form-control" id="glucose" placeholder="Glucosa" value="{{ old('glucose') }}" name="glucose" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                                                    data-placement="top" data-title="Negativa">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="whites_cells">Células blancas</label>
                                                                <input type="number" min="0" step="0.1" class="form-control" id="whites_cells" placeholder="Células blancas" value="{{ old('whites_cells') }}" name="whites_cells" data-trigger="focus" data-toggle="tooltip"
                                                                    data-container="body" data-placement="top" data-title="20 a 40 g/d">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="erythrocytes">Eritrocitos</label>
                                                                <input type="number" min="0" step="0.1" class="form-control" id="erythrocytes" placeholder="Eritrocitos" value="{{ old('erythrocytes') }}" name="erythrocytes" data-trigger="focus" data-toggle="tooltip"
                                                                    data-container="body" data-placement="top" data-title="40 a 220 meq/L/d">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <button type="submit" class="btn btn-success btn-block">
                                                                    Guardar Datos
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    {{-- Termina Card General de Orina --}}
    </div>
    <br>
    <div class="col-md-6 offset-md-4">
        <a href="{{ route('ClinicHistoryPatient', $patient->slug) }}" class="btn btn-primary">Continua con la consulta</a>
        <a href="{{ route('patients.show', $patient->slug) }}" class="btn btn-info">Ver Paciente</a>
    </div>
    <br>
</div>
@endsection
@section('extra-js')
<script>
    $("input[data-toggle='tooltip']").on('focus', function() {
        $(this).tooltip('show');
    });
</script>
@endsection
    
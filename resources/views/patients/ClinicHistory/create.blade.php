@extends('layouts.admin')
@section('title')
Paciente: {{ $patient->name }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary mt-4">
            <div class="card-header">
                <h3 class="mb-0">Historia Clínica</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('BriefClinicHistory.store', $patient->slug) }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="symptom">Signos y síntomas</label>
                            <input type="text" class="form-control" id="symptom" placeholder="Ingrese signos y síntomas del paciente" value="{{ old('symptom') }}" name="symptom">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="current_pathology">Patología Actual</label>
                            <select class="custom-select" name="current_pathology" id="current_pathology">
                                <option selected disabled>Seleccione una opción...</option>
                                <option value="DM1">DM 1</option>
                                <option value="DM2">DM 2</option>
                                <option value="HAS">HAS</option>
                                <option value="Cardiopatías">Cardiopatías</option>
                                <option value="Hipotiroidismo">Hipotiroidismo</option>
                                <option value="Hipertiroidismo">Hipertiroidismo</option>
                                <option value="Gota">Gota</option>
                                <option value="Hepatitis">Hepatitis</option>
                                <option value="Cáncer">Cáncer</option>
                                <option value="Estreñimiento">Estreñimiento</option>
                                <option value="Gastritis">Gastritis</option>
                                <option value="Colitis">Colitis</option>
                                <option value="Sobrepeso">Sobrepeso</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="medicines">Medicamentos</label>
                            <input type="text" class="form-control" id="medicines" placeholder="Ingrese medicamentos del paciente" value="{{ old('medicines') }}" name="medicines">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="treatment_frequency">Tratamiento - frecuencia</label>
                            <input type="text" class="form-control" id="treatment_frequency" placeholder="Ingrese el tratamiento frecuente del paciente" value="{{ old('treatment_frequency') }}" name="treatment_frequency">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="treatment_quantity">Tratamiento - cantidad</label>
                            <input type="text" class="form-control" id="treatment_quantity" placeholder="Ingrese la cantidad del tratamiento del paciente" value="{{ old('treatment_quantity') }}" name="treatment_quantity">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="treatment_results">Resultados del tratamiento</label>
                            <select class="custom-select" name="treatment_results" id="treatment_results">
                                <option selected disabled>Seleccione una opción...</option>
                                <option value="Favorable">Favorable</option>
                                <option value="Desfavorable">Desfavorable</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <h5 class="mb-4">Antecedentes Heredofamiliares</h5>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="DM1" type="checkbox" id="DM1" value="DM 1">
                                <label class="form-check-label" for="DM1">DM 1</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="DM2" type="checkbox" id="DM2" value="DM 2">
                                <label class="form-check-label" for="DM2">DM 2</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="HAS" type="checkbox" id="HAS" value="HAS">
                                <label class="form-check-label" for="HAS">HAS</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="Cardiopatías" type="checkbox" id="Cardiopatías" value="Cardiopatías">
                                <label class="form-check-label" for="Cardiopatías">Cardiopatías</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="Aterosclerosis" type="checkbox" id="Aterosclerosis" value="Aterosclerosis">
                                <label class="form-check-label" for="Aterosclerosis">Aterosclerosis</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="Osteopenia" type="checkbox" id="Osteopenia" value="Osteopenia">
                                <label class="form-check-label" for="Osteopenia">Osteopenia</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="Obesidad" type="checkbox" id="Obesidad" value="Obesidad">
                                <label class="form-check-label" for="Obesidad">Obesidad</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="Hipotiroidismo" type="checkbox" id="Hipotiroidismo" value="Hipotiroidismo">
                                <label class="form-check-label" for="Hipotiroidismo">Hipotiroidismo</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="Hipertiroidismo" type="checkbox" id="Hipertiroidismo" value="Hipertiroidismo">
                                <label class="form-check-label" for="Hipertiroidismo">Hipertiroidismo</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="Gota" type="checkbox" id="Gota" value="Gota">
                                <label class="form-check-label" for="Gota">Gota</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="Hepatitis" type="checkbox" id="Hepatitis" value="Hepatitis">
                                <label class="form-check-label" for="Hepatitis">Hepatitis</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="Cáncer" type="checkbox" id="Cáncer" value="Cáncer">
                                <label class="form-check-label" for="Cáncer">Cáncer</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="Estreñimiento" type="checkbox" id="Estreñimiento" value="Estreñimiento">
                                <label class="form-check-label" for="Estreñimiento">Estreñimiento Crónico</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="Gastritis" type="checkbox" id="Gastritis" value="Gastritis">
                                <label class="form-check-label" for="Gastritis">Gastritis Crónica</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="Colitis" type="checkbox" id="Colitis" value="Colitis">
                                <label class="form-check-label" for="Colitis">Colitis</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="Insuficiencia" type="checkbox" id="Insuficiencia" value="Insuficiencia Renal">
                                <label class="form-check-label" for="Insuficiencia">Insuficiencia Renal</label>
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div>
                        </div>

                        {{-- Esto no aparecerá si el paciente es hombre --}}
                        @if($patient->gender === 'Femenino' )
                            <div class="col-md-6 mt-4">
                                <label>Embarazo </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pregnancy_option_checkbox" id="option1">
                                    <label class="form-check-label" for="option1">
                                        Si
                                    </label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pregnancy_option_checkbox" id="option2" checked>
                                    <label class="form-check-label" for="option2">
                                        No
                                    </label>
                                </div>

                                <select class="custom-select" name="pregnancy" id="pregnancy">
                                    <option selected disabled>Seleccione una opción...</option>
                                    <option value="1er trimestre (del mes 1 - 3; de la 1°  a la 13° SDG)">1er trimestre (del mes 1 - 3; de la 1° a la 13° SDG)</option>
                                    <option value="2° trimestre (del mes 4 - 6; 14 - 20 SDG)">2° trimestre (del mes 4 - 6; 14 - 20 SDG)</option>
                                    <option value="3° (del mes 7 - 9; 21 - 42 SDG)">3° (del mes 7 - 9; 21 - 42 SDG)</option>
                                </select>
                            </div>
                        @else

                        @endif



                            <div class="col-md-6 mt-4">
                                <label>Uso de anticonceptivos </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="contraceptive_option_checkbox" id="anticonceptivos_option1" name="contraceptive_option_checkbox">
                                    <label class="form-check-label" for="anticonceptivos_option1">
                                        Si
                                    </label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="contraceptive_option_checkbox" id="anticonceptivos_option2" name="contraceptive_option_checkbox" checked>
                                    <label class="form-check-label" for="anticonceptivos_option2">
                                        No
                                    </label>
                                </div>
                                <input type="text" class="form-control" id="contraceptive" placeholder="Ingrese el método anticonceptivo" value="{{ old('contraceptive') }}" name="contraceptive">
                            </div>

                            <div class="col-md-12">
                                <hr>
                            </div>

                            <div class="col-md-12">
                                <h5 class="mb-0">Antecedentes no patológicos</h5>
                            </div>
                            <div class="col-md-6 mt-4">
                                <label>Cirugías </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="surgery_option_checkbox" id="cirugia_option1">
                                    <label class="form-check-label" for="cirugia_option1">
                                        Si
                                    </label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="surgery_option_checkbox" id="cirugia_option2" checked>
                                    <label class="form-check-label" for="cirugia_option2">
                                        No
                                    </label>
                                </div>
                                <input type="text" class="form-control" id="surgery" placeholder="Ingrese el tipo de cirugía" value="{{ old('surgery') }}" name="surgery">
                            </div>

                            <div class="col-md-6 mt-4">
                                <label>Alergias </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="allergy_option_checkbox" id="allergy_option1">
                                    <label class="form-check-label" for="allergy_option1">
                                        Si
                                    </label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="allergy_option_checkbox" id="allergy_option2" checked>
                                    <label class="form-check-label" for="allergy_option2">
                                        No
                                    </label>
                                </div>
                                <input type="text" class="form-control" id="allergy" placeholder="Ingrese el tipo de alergia" value="{{ old('allergy') }}" name="allergy">
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <h5 class="mb-4">Hábitos Tóxicos</h5>
                            </div>

                            <div class="form-group col-md-2 pt-4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="tabaquism">
                                    <label class="form-check-label" for="tabaquism">Tabaquismo</label>
                                </div>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="tabaquism_quantity">Cantidad</label>
                                <input type="text" class="form-control" id="tabaquism_quantity" placeholder="Ingrese la cantidad en que fuma el pacinte" value="{{ old('tabaquism_quantity') }}" name="tabaquism_quantity" disabled>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="tabaquism_frequency">Frecuencia</label>
                                <input type="text" class="form-control" id="tabaquism_frequency" placeholder="Ingrese la frecuencia en que fuma el paciente" value="{{ old('tabaquism_frequency') }}" name="tabaquism_frequency" disabled>
                            </div>
                            
                            <div class="form-group col-md-2 pt-4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="alcoholism">
                                    <label class="form-check-label" for="alcoholism">Alcoholismo</label>
                                </div>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="alcoholism_quantity">Cantidad</label>
                                <input type="text" class="form-control" id="alcoholism_quantity" placeholder="Ingrese la cantidad en que bebe el pacinte" value="{{ old('alcoholism_quantity') }}" name="alcoholism_quantity" disabled>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="alcoholism_frequency">Frecuencia</label>
                                <input type="text" class="form-control" id="alcoholism_frequency" placeholder="Ingrese la frecuencia en que bebe el paciente" value="{{ old('alcoholism_frequency') }}" name="alcoholism_frequency" disabled>
                            </div>
                            
                            <div class="form-group col-md-2 pt-4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="drug">
                                    <label class="form-check-label" for="drug">Drogas</label>
                                </div>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="drugs_quantity">Cantidad</label>
                                <input type="text" class="form-control" id="drug_quantity" placeholder="Ingrese la cantidad de drogas que consume el pacinte" value="{{ old('drugs_quantity') }}" name="drug_quantity" disabled>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="drug_frequency">Frecuencia</label>
                                <input type="text" class="form-control" id="drug_frequency" placeholder="Ingrese la frecuencia en que consume drogas el paciente" value="{{ old('drug_frequency') }}" name="drug_frequency" disabled>
                            </div>
                            
                            <div class="form-group col-md-2 pt-4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="coffe">
                                    <label class="form-check-label" for="coffe">Café</label>
                                </div>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="coffe_quantity">Cantidad</label>
                                <input type="text" class="form-control" id="coffe_quantity" placeholder="Ingrese la cantidad de café que consume el pacinte" value="{{ old('coffe_quantity') }}" name="coffe_quantity" disabled>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="coffe_frequency">Frecuencia</label>
                                <input type="text" class="form-control" id="coffe_frequency" placeholder="Ingrese la frecuencia en que consume café el paciente" value="{{ old('coffe_frequency') }}" name="coffe_frequency" disabled>
                            </div>
                            
                            
                            <div class="col-md-3">
                                <button type="submit" name="clinic" value="on" class="btn btn-primary btn-block">Guardar e ir a Historia Clínica</button>
                            </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
<script>

    var gender = '{{$patient->gender}}';

    if(gender === 'Femenino')
    {
        document.getElementById('option1').onchange = function() {
            document.getElementById('pregnancy').disabled = !this.checked;
        };

        document.getElementById('option2').onchange = function() {
            document.getElementById('pregnancy').disabled = this.checked;
        };
    }


    document.getElementById('anticonceptivos_option1').onchange = function() {
        document.getElementById('contraceptive').disabled = !this.checked;
    };

    document.getElementById('anticonceptivos_option2').onchange = function() {
        document.getElementById('contraceptive').disabled = this.checked;
    };

    document.getElementById('cirugia_option1').onchange = function() {
        document.getElementById('surgery').disabled = !this.checked;
    };

    document.getElementById('cirugia_option2').onchange = function() {
        document.getElementById('surgery').disabled = this.checked;
    };

    document.getElementById('allergy_option1').onchange = function() {
        document.getElementById('allergy').disabled = !this.checked;
    };

    document.getElementById('allergy_option2').onchange = function() {
        document.getElementById('allergy').disabled = this.checked;
    };

    document.getElementById('tabaquism').onchange = function() {
        document.getElementById('tabaquism_frequency').disabled = !this.checked;
        document.getElementById('tabaquism_quantity').disabled = !this.checked;
    };

    document.getElementById('alcoholism').onchange = function() {
        document.getElementById('alcoholism_frequency').disabled = !this.checked;
        document.getElementById('alcoholism_quantity').disabled = !this.checked;
    };

    document.getElementById('drug').onchange = function() {
        document.getElementById('drug_frequency').disabled = !this.checked;
        document.getElementById('drug_quantity').disabled = !this.checked;
    };

    document.getElementById('coffe').onchange = function() {
        document.getElementById('coffe_frequency').disabled = !this.checked;
        document.getElementById('coffe_quantity').disabled = !this.checked;
    };
</script>
@endsection

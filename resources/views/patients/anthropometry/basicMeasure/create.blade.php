@extends('layouts.admin')
@section('title')
Paciente: {{ $patient->name }}
@endsection
@section('extra-css')
<!-- easyautocomplete -->

@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary mt-4">
            <div class="card-header">
                <div class="card-title">Medidas básicas</div>
                {{--<h3 class="mb-0">Medidas básicas</h3>--}}
            </div>
            
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 offset-md-2">
                            {!! Form::open(['route'=>'anthropometry.basicMeasurePost','method'=>'POST','class'=>'form'])!!}
                                @include('patients.anthropometry.basicMeasure.fields')
                            {!! Form::close() !!}
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
    var peso = $('input[name="weight"]');
    var talla = $('input[name="size"]');
    var imc;
    var gestation_week = $('input[name="gestation_week"]');
    var pregestational_weight = $('input[name="pregestational_weight"]');
    
    peso.keyup(function(){
       
        if(talla.val() != '' && peso.val() !='')
        {
            if(talla.val() > 2.5)
            {
                alert('La talla esta fuera de rango, debe ser maximo 2.5 mtrs');
            }
            else{

                imc = parseFloat(peso.val())/(parseFloat(talla.val()) * parseFloat(talla.val()));
                imc = imc.toFixed(2);
                console.log(imc);
                $('input[name="imc"]').val(imc);
                $('.content-info-imc').css('display', 'block');
            }
        }
        else
        {
            $('input[name="imc"]').val('');
            $('.content-info-imc').css('display', 'none');
        }
    });

    talla.keyup(function(){
        if(talla.val() != '' && peso.val() !='')
        {
            imc = parseFloat(peso.val())/(parseFloat(talla.val()) * parseFloat(talla.val()));
            imc = imc.toFixed(2);
            $('input[name="imc"]').val(imc);
            $('.content-info-imc').css('display', 'block');
        }
        else
        {
            $('input[name="imc"]').val('');
            $('.content-info-imc').css('display', 'none');
        }
        
    });

    $('input[name="pregnancy"]').click(function(){
        
            if($(this).val() == 1)
            {
                $('.content-pregnancy').css('display', 'block');
            }
            else
            {
                $('.content-pregnancy').css('display', 'none');
            }
        
    });

    //calculo de Peso Esperado de acuerdo con el IMC previo a la gestación y la edad de gestación
    gestation_week.keyup(function(){
        if(gestation_week.val() != '' && pregestational_weight.val() !='')
        {
            if(!imc)
            {
                alert('debe calcular el imc');
                gestation_week.val('');
    
            }
            else
            {
                var dataJson = {};
                dataJson.gestation_week = gestation_week.val();
                dataJson.pregestational_weight = pregestational_weight.val();
                dataJson.imc = imc;
                dataJson.weight = peso.val();
                
                $.ajax({
                    url     : siteUrl + "/patient/antropometria/pregestational-weight-ajax",
                    method  : 'post',
                    data: {dataJson: JSON.stringify(dataJson)},
                    success : function(returnedData){
                        console.log(returnedData);
                        $('input[name="PeIMCpgEG"]').val(returnedData.PeIMCpgEG);
                        $('input[name="%PeIMCpgEg"]').val(returnedData.PeIMCpgEg_porcent);
                    },
                    error: function() {
                        alert("No hay conexion con el servidor");
                    }
            });
            }
        }
        else
        {
            $('input[name="PeIMCpgEG"]').val('');
            $('input[name="%PeIMCpgEG"]').val('');
        }
    });

    pregestational_weight.keyup(function(){
        if(gestation_week.val() != '' && pregestational_weight.val() !='')
        {
            if(!imc)
            {
                alert('debe calcular el imc');
                pregestational_weight.val('');
    
            }
            else
            {
                var dataJson = {};
                dataJson.gestation_week = gestation_week.val();
                dataJson.pregestational_weight = pregestational_weight.val();
                dataJson.imc = imc;
                dataJson.weight = peso.val();
                
                $.ajax({
                    url     : siteUrl + "/patient/antropometria/pregestational-weight-ajax",
                    method  : 'post',
                    data: {dataJson: JSON.stringify(dataJson)},
                    success : function(returnedData){
                        console.log(returnedData);
                        $('input[name="PeIMCpgEG"]').val(returnedData.PeIMCpgEG);
                        $('input[name="%PeIMCpgEg"]').val(returnedData.PeIMCpgEg_porcent);
                    },
                    error: function() {
                        alert("No hay conexion con el servidor");
                    }
            });
            }
        }
        else
        {
            $('input[name="PeIMCpgEG"]').val('');
            $('input[name="%PeIMCpgEG"]').val('');
        }
    });
</script>
@endsection
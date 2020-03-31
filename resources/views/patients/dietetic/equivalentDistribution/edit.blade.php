@extends('layouts.admin')
@section('title')
Paciente: {{ $patient->name }}
@endsection
@section('extra-css')
<!-- easyautocomplete -->
<link rel="stylesheet" href="{{ asset('js/easyautocomplete/css/easy-autocomplete.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap-timepicker.min.css') }}">

@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary mt-4">
            <div class="card-header">
                <h3 class="card-title">Distribución de Equivalentes de {{ $patient->name }}</h3>
            </div>
            <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mt-3 tab-card">
                                    <div class="card-header tab-card-header" style="background-color:#FFFFFF;">
                                        <ul class="nav nav-tabs" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="impedancia_biolectrica-tab" data-toggle="tab" href="#distribution" role="tab" aria-controls="impedancia_biolectrica" aria-selected="true" style="color:#007bff!important">Distribution</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="detail-tab" data-toggle="tab" href="#scroll" role="tab" aria-controls="pliegue" aria-selected="false" style="color:#007bff!important">Scroll</a>
                                                    </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active p-4" id="distribution" role="tabpanel" aria-labelledby="distribution-tab">
                                                    {!! Form::model($equivalentDistribution, ['route' => ['dietetic.equivalentDistributionUpdate', $equivalentDistribution->id], 'method'=>'POST','class'=>'form']) !!}
                                                        @include('patients.dietetic.equivalentDistribution.fieldsEdit')
                                                    {!! Form::close() !!}
                                                </div>
                                                <div class="tab-pane fade p-4" id="scroll" role="tabpanel" aria-labelledby="scroll-tab">
                                                    <div class="row">
                                                        <div class="col-md-7" id="content_table_unity">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th>
                                                                            <select name="" id="scroll_unity" class="form-control">
                                                                                <option value="" selected hidden>Seleccione</option>
                                                                                <option value="1"><b>GRAMOS</b></option>
                                                                                <option value="2"><b>kCAL</b></option>
                                                                            </select>
                                                                        </th>
                                                                        <th>Proteinas</th>
                                                                        <th>Lipidos</th>
                                                                        <th>Hidratos de Carbonos</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>CONTADOS</td>
                                                                        <td>{{--{{ $contado_proteins }}--}}</td>
                                                                        <td>{{--{{ $contado_lipids }}--}}</td>
                                                                        <td>{{--{{ $contado_carbohydrates }}--}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>META</td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>ADECUACIÓN</td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>PORCENTAJES</td>
                                                                        <td><input class="form-control" name="porcent_proteins" type="number" min="0" step="0.1"/></td>
                                                                        <td><input class="form-control" name="porcent_lipids" type="number" min="0" step="0.1"/></td>
                                                                        <td><input class="form-control" name="porcent_carbohydrates" type="number" min="0" step="0.1"/></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div id="macro_chart"></div>
                                                        </div>   
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
<script src="{{ asset('js/bootstrap-timepicker.min.js')}}"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="{{ asset('js/sweetalert2@8.js') }}"></script>
<script>  
    $.fn.datepicker.dates['es'] = {
		days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"],
		daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb", "Dom"],
		daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa", "Do"],
		months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
		monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
		today: "Hoy",
		clear: "Borrar",
		format: "dd/mm/yyyy",
		titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
		weekStart: 0
	};
    $('.input-daterange').datepicker({
        language:'es',
    });
    //nuevo tiempo de alimento
    $('#btn-new-time-food').click(function(){
        var content = '<form id="form-new-food-time">\
                            <div class="form-row pb-2">\
                                <div class="col 12">\
                                    <input type="text" name="name" class="form-control input-sm" placeholder="Nuevo tiempo de comida">\
                                </div>\
                            </div>\
                            <div class="statusMsg"></div>\
                            <div class="form-row mx-auto">\
                                <buttom class="btn btn-success" id="btn-submit-new-time-food-rapid" onclick="submitNewFoodTime()" style="margin-right:5px;">Crear</buttom>\
                                <buttom id="btn-cancel-new-time-food" class="btn btn-danger">Cancelar</buttom>\
                            </div>\
                        </form>';
        if($('.new-time-food').is(':empty'))
        {
            $('.new-time-food').append(content);
        }
    });

    $('body').on('click', '#btn-cancel-new-time-food', function(){
        $('.new-time-food').html('');
    });


    $('body').on('click', '.plus-equivalent',function(){
        var input = $(this).parent().parent().siblings('div').children('input');
        var equivalent = parseFloat(0.5);
        var valor;
        if(input.val() == "")
        {
            valor = parseFloat(0);
        }
        else{
            valor = parseFloat(input.val());
        }
       
        input.val(valor + equivalent);
        
    });

    $('body').on('click', '.minus-equivalent', function(){
        var input = $(this).parent().parent().siblings('div').children('input');
        var equivalent = parseFloat(0.5);
        var valor;
        if(input.val() == "")
        {
            valor = parseFloat(0);
        }
        else{
            valor = parseFloat(input.val());
        }
       
       if(valor > 0)
       {
        input.val(valor - equivalent);
       }        
    });

    //boton para eliminar item de distribucion de equivalentes
    $('body').on('click', '.btn-delete-equivalent', function(e){
        e.preventDefault();
        var food_id = $(this).data('food');
        if($('input[name="food_group[]"]:checked').length > 1)
        {
            if($(this).parent().parent().parent().remove())
            {
                $('input#food_group'+food_id).attr('checked', false);
            }
        }
        else
        {
            alert('Debe seleccionar al menos un grupo de alimentos');
        }
        
    });

    
    /*-----------------------------------------
    FUNCION PARA GENERAR FORMULARIO DE EQUIVALENTES 
    ------------------------------------------*/

    function showEquivalentFoodTime(){
        var inputs = $('input.food-check:checked');
        var valido = true;
       
        if($('input[name="food_time[]"]:checked').length == 0 && $('input[name="days[]"]:checked').length == 0 && $('input[name="food_group[]"]:checked').length == 0) {
            alert('Debe seleccionar al menos un dia, un grupo de alimento y un tiempo de comida');
            valido = false;
            return valido;
        }
        else if($('input[name="food_time[]"]:checked').length == 0)
        {
            alert('Debe seleccionar al menos un tiempo de comida');
            valido = false;
            return valido;
        }
        else if($('input[name="days[]"]:checked').length == 0)
        {
            alert('Debe seleccionar al menos un dia');
            valido = false;
            return valido;
        }
        else if($('input[name="food_group[]"]:checked').length == 0)
        {
            alert('Debe seleccionar al menos un grupo de alimentos');
            valido = false;
            return valido;
        }

        if(valido){
            var dataJson = inputs.serialize();
            var id = $('input[name="equivalent_distribution_id"]').val();

            $.ajax({
                            
                        url: siteUrl + "patient/dietetica/distribucion-equivalentes-ajax",
                        method: 'POST',
                        data: {dataJson: dataJson, id:id},
                        success: function(returnedData) { 
                            console.log(returnedData);       
                            var content = $('#content-table-equivalent-distribution');
                            content.html(returnedData);  
                            $('#group-button-fields').css('display', 'block');                     
                        },
                        error: function() {
                                alert("No hay conexion con el servidor");
                            }
                        });//fin Ajax
        }
    }

    /*-----------------------------------------
    FUNCION PARA NUEVO TIEMPO DE COMIDA 
    ------------------------------------------*/
    function submitNewFoodTime(){
        var form = $('#form-new-food-time');
        var valido = true;

        form.find(':input').each(function(){
            if($(this).val() == "")
            {
                alert('todos los campos son requeridos');
                $(this).focus();
                valido = false;
                return valido;
            }
        });

        if(valido)
        {
            var dataJson = form.serialize();
            $('#btn-cancel-new-time-food-rapid').attr("disabled","disabled");
            $('#btn-submit-new-time-food-rapid').attr("disabled","disabled");
            form.css('opacity', '.5');

            $.ajax({
                            
                            url: siteUrl + "food-times",
                            method: 'POST',
                            data: {dataJson: dataJson},
                            success: function(returnedData) {          
                                if(returnedData.status == 1)
                                {
                                    form.find(':input').each(function(){
                                        $(this).val('');
                                    });
            
                                    Swal.fire({
                                        type: 'success',
                                        title: 'El nuevo tiempo de comida se ha creado satisfactoriamente',
                                        showConfirmButton: false,
                                        timer: 2500
                                    });

                                    var food_time = '<div class="custom-control custom-checkbox pb-2">\
                                                        <input type="checkbox" class="custom-control-input food-check" name="food_time_'+returnedData.foodTime.id+'" value="'+returnedData.foodTime.id+'" id="food_time_'+returnedData.foodTime.id+'">\
                                                        <label class="custom-control-label label-food-time" for="food_time_'+returnedData.foodTime.id+'">'+returnedData.foodTime.name+'</label>\
                                                        <div class="content-fields"></div>\
                                                    </div>';
                                    $('.content-food-times').append(food_time);

                                    $('#btn-cancel-new-time-food-rapid').removeAttr("disabled");
                                    $('#btn-submit-new-time-food-rapid').removeAttr("disabled");
                                    form.css('opacity', '');
                                }
                                else
                                {
                                    $('.statusMsg').html('<span style="color:red;"><b>'+returnedData.message+'</b></span>');
                                    $('#btn-cancel-new-time-food-rapid').removeAttr("disabled");
                                    $('#btn-submit-new-time-food-rapid').removeAttr("disabled");
                                    form.css('opacity', '');
                                }
                                	                            
                            },
                            error: function() {
                                alert("No hay conexion con el servidor");
                                $('#btn-cancel-new-time-food-rapid').removeAttr("disabled");
                                $('#btn-submit-new-time-food-rapid').removeAttr("disabled");
                                form.css('opacity', '');
                            }
                        });//fin Ajax
        }
    }

    $('body').on('change', '#scroll_unity',function(){
        var porcent_proteins = $('input[name="porcent_proteins"]');
        var porcent_lipids = $('input[name="porcent_lipids"]');;
        var porcent_carbohydrates = $('input[name="porcent_carbohydrates"]');

        if(porcent_carbohydrates.val() == '' || porcent_lipids.val() == '' || porcent_proteins.val() == '')
        {
            alert('Debe ingresar los porcentajes de macronutrientes');
            return false;
        }
//alert(parseFloat(porcent_carbohydrates.val()) + parseFloat(porcent_lipids.val()) + parseFloat(porcent_proteins.val()));
        if(parseFloat(porcent_carbohydrates.val()) + parseFloat(porcent_lipids.val()) + parseFloat(porcent_proteins.val()) != 100)
        {
            alert('La suma de los porcentaes debe ser igual a 100%');
            return false;
        }
        var unity = $(this).val();
        var patient_id = $('input[name="patient_id"]').val();
        var history_id = $('input[name="history_id"]').val();
        var dataJson = {};
        dataJson.unity = unity;
        dataJson.patient_id = patient_id;
        dataJson.history_id = history_id;
        dataJson.porcent_carbohydrates = parseFloat(porcent_carbohydrates.val());
        dataJson.porcent_lipids = parseFloat(porcent_lipids.val());
        dataJson.porcent_proteins = parseFloat(porcent_proteins.val());
        $.ajax({
                url     : siteUrl + "patient/dietetica/distribucion-equivalentes-unidad-ajax",
                method  : 'post',
                data: {dataJson: JSON.stringify(dataJson)},
                success : function(returnedData){
                    //console.log(returnedData);
                    var content = $('#content_table_unity');
                    content.html('');
                    content.append(returnedData);
                },
                error: function() {
                    alert("No hay conexion con el servidor");
                }
        });
    });

    /*---------------------------------------------------------
    FUNCION PARA COLOREAR LA COLUMNA DEL DIA EN QUE SE TRABAJA 
    -----------------------------------------------------------*/

    $('body').on('click', 'input[type="number"]', function(){
        var dia = $(this).parent().data('day');

        $('tbody tr td').each(function(){
            if($(this).data('day') == dia)
            {
                $(this).css('background-color', '#007bff');
            }
            else
            {
                $(this).css('background-color', 'white');
            }
        });
    });
</script>
<script>
    "use strict";
    // Class definition
    var ChartsFrequencyComsumption = function() {
    
        // Private functions
    
        var main = function() {
            // GOOGLE CHARTS INIT
            google.load('visualization', '1', {
                packages: ['corechart', 'bar']
            });
    
            google.setOnLoadCallback(function() {
                ChartsFrequencyComsumption.runCharts();
            });
        }

        var PieChartsMacros = function() {

        var equivalent_macro = <?php echo $equivalent_macro; ?>;
        var data =  google.visualization.arrayToDataTable(equivalent_macro);
            
            var options = {
                title: 'Grafica de consumo de MacroNutientes',
                is3D: false,
                'width':400,
                'height':300
            }

            var chart = new google.visualization.PieChart(document.getElementById('macro_chart'));

            chart.draw(data, options);

        }

        
    
        return {
            // public functions
            init: function() {
                main();
            },
    
            runCharts: function() {
                PieChartsMacros();
            }
        };
    }();
    
    ChartsFrequencyComsumption.init();
</script>

@endsection
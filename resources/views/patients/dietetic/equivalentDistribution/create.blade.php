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
                <h3 class="card-title">Distribución de Equivalentes</h3>
            </div>
            <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                {!! Form::open(['route' => 'dietetic.equivalentDistributionStore', 'method'=>'POST','class'=>'form']) !!}
                                    @include('patients.dietetic.equivalentDistribution.fields')
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="card-footer">
            <div class="col-md-6 offset-md-5">
                <a href="{{ route('dietetic.index', ['slug'=>$patient->slug,'history_id'=>$history->id]) }}" class="btn btn-primary">Ir a Dietetica</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
<script src="{{ asset('js/bootstrap-timepicker.min.js')}}"></script>
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

            $.ajax({
                            
                        url: siteUrl + "patient/dietetica/distribucion-equivalentes-ajax",
                        method: 'POST',
                        data: {dataJson: dataJson},
                        success: function(returnedData) { 
                            //console.log(returnedData);       
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
                                  console.log(returnedData);          
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
@endsection
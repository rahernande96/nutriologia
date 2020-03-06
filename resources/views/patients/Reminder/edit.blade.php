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
                <h3 class="mb-0">Recordatorio 24Hrs</h3>
            </div>
        </div>
        <div class="card-body">
            <div class="container">
                    <div class="row">
                            <div class="col-md-12">
                                    {{--<a href="{{ route('reminder.change', $patient->slug) }}" id="change_reminder" class="btn btn-success right mb-6">Cambiar Recordatorio</a>--}}
                                    <button id="change_reminder" class="btn btn-success right mb-6">Cambiar recordatorio</button>
                            </div>
                        </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mt-3 tab-card">
                            <div class="card-header tab-card-header">
                                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                    @if($reminder->type == \App\Reminder::RAPID)
                                    <li class="nav-item">
                                        <a class="nav-link active" id="rapid-tab" data-toggle="tab" href="#rapid" role="tab" aria-controls="home" aria-selected="true">Rápido</a>
                                    </li>
                                    @else
                                    <li class="nav-item">
                                        <a class="nav-link" id="detail-tab" data-toggle="tab" href="#detail" role="tab" aria-controls="profile" aria-selected="false">Detallado</a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                            <!-- tab content -->
                            <div class="tab-content" id="myTabContent">
                                @if($reminder->type == \App\Reminder::RAPID)
                                <div class="tab-pane fade show active p-4" id="rapid" role="tabpanel" aria-labelledby="home-tab">
                                    <form action="{{ route('reminder.update', $reminder->id) }}" method="POST">
                                        @method('PUT')
					                    @csrf
                                        @include('patients.Reminder.fields_rapid_edit')
                                    </form>
                                </div>
                                @else
                                <div class="tab-pane fade show active p-4" id="detail" role="tabpanel" aria-labelledby="profile-tab">
                                    <form action="{{ route('reminder.update', $reminder->id) }}" method="POST">
                                        @method('PUT')
                                        @csrf 
                                        @include('patients.Reminder.fields_detail_edit')
                                    </form>   
                                </div>
                                @endif
                            </div>
                            <!-- ./tab content -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal nueva comida -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Alimento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="form-modal-new-food">
                    <legend>Información del Alimento</legend>
                    <hr>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="food_modal_name">Nombre:</label>
                            <input type="text" class="form-control" name="name" id="food_modal_name" placeholder="Nombre del alimento" required>
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationServer023">Grupo al que pertenece:</label>
                            <select id="food_modal_group" name="group_id" class="form-control" required>
                                <option value="" selected hidden> Seleccione Grupo</option>
                                @foreach($food_group as $foodG)
                                    <option value="{{ $foodG->id }}">{{ $foodG->name }}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                            </div>
                        </div>
                    </div>
                    <legend>Información de Macro Nutrientes</legend>
                    <hr>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                                <label for="food_modal_protein">Proteinas:</label>
                                <input type="number" name="protein" min="0" class="form-control" id="food_modal_protein" placeholder="Proteinas" required>
                        </div>
                        <div class="col-md-4 mb-3">
                                <label for="food_modal_lipids">Lipidos:</label>
                                <input type="number" name="lipids" min="0" class="form-control" id="food_modal_lipids" placeholder="Lipidos" required>
                        </div>
                        <div class="col-md-4 mb-3">
                                <label for="food_modal_carbohydrates">Hidratos de Carbono:</label>
                                <input type="number" name="carbohydrates" min="0" class="form-control" id="food_modal_carbohydrates" placeholder="Hidratos de Carbono" required>
                        </div>
                    </div>
                    <legend>Información de Micro Nutrientes</legend>
                    <hr>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                                <label for="food_modal_energy">Energia:</label>
                                <input type="number" name="energy" min="0" class="form-control" id="food_modal_energy" placeholder="Energia" required>
                        </div>
                        <div class="col-md-6 mb-3">
                                <label for="food_modal_fiber">Fibra:</label>
                                <input type="number" name="fiber" min="0" class="form-control" id="food_modal_fiber" placeholder="Fibra" required>
                        </div>
                    </div>
                    <legend>Información de Minerales</legend>
                    <hr>
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                                <label for="food_modal_hierroNO">Hierro NO:</label>
                                <input type="number" name="hierro_NO" min="0" class="form-control" id="food_modal_hierroNO" placeholder="hierroNO" required>
                        </div>
                        <div class="col-md-3 mb-3">
                                <label for="food_modal_potasio">Potasio:</label>
                                <input type="number" name="potasio" min="0" class="form-control" id="food_modal_potasio" placeholder="Potasio" required>
                        </div>
                        <div class="col-md-3 mb-3">
                                <label for="food_modal_hierro">Hierro:</label>
                                <input type="number" name="hierro" min="0" class="form-control" id="food_modal_hierro" placeholder="Hierro" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="food_modal_sodio">Sodio:</label>
                            <input type="number" name="sodio" min="0" class="form-control" id="food_modal_sodio" placeholder="Sodio" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="food_modal_calcio">Calcio:</label>
                            <input type="number" name="calcio" min="0" class="form-control" id="food_modal_calcio" placeholder="Calcio" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="food_modal_fosforo">Fósforo:</label>
                            <input type="number" name="fosforo" min="0" class="form-control" id="food_modal_fosforo" placeholder="Fósforo" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="food_modal_selenio">Selenio:</label>
                            <input type="number" name="selenio" min="0" class="form-control" id="food_modal_selenio" placeholder="Selenio" required>
                        </div>
                    </div>
                    <legend>Información de Vitaminas</legend>
                    <hr>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="food_modal_vitaminaA">Vitamina A:</label>
                            <input type="number" name="vitamina_A" min="0" class="form-control" id="food_modal_vitaminaA" placeholder="Vitamina A" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="food_modal_acidoA">Acido Ascorbico:</label>
                            <input type="number" name="acido_ascorbico" min="0" class="form-control" id="food_modal_acidoA" placeholder="Acido Ascorbico" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="food_modal_acidoF">Acido Folico:</label>
                            <input type="number" name="acido_folico" min="0" class="form-control" id="food_modal_acidoF" placeholder="Acido Fólico" required>
                        </div>
                    </div>
                    <div class="statusMsg"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-modal-submit-food" class="btn btn-primary" onclick="submitRegisterProduct()">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<div class="row">
	<div class="col-lg-3 offset-lg-5">
		<a href="{{ route('ClinicHistoryPatient', $patient->slug) }}" class="btn btn-primary">Ir a Historia del paciente</a>
	</div>
</div>
<br>
@endsection

@section('extra-js')
<!-- easycomplete -->
<script src="{{ asset('js/easyautocomplete/js/jquery.easy-autocomplete.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2@8.js') }}"></script>
<script src="{{ asset('js/bootstrap-timepicker.min.js')}}"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>

    //accion cuando el checkbox de alimento es seleccionado o deseleccionado
    $("body").on('change', '.food-check-detail', function() {
        var data_id = $(this).val();
        var data_name = $(this).data('name');
        var dataJson        = {};
        dataJson.id = data_id;
        if( $(this).is(':checked') ) {
            
            var content = '<div class="form-row">\
                                <label for="inputEmail3" class="col-sm-5 control-label">Hora:</label>\
                                <div class="col-sm-7">\
                                    <input type="text" name="food_hour[]" class="form-control timepicker" id="inputEmail3" placeholder="Hora" required>\
                                </div>\
                            </div>\
                            <div class="form-row">\
                                <label for="inputEmail3" class="col-sm-5 control-label">Lugar:</label>\
                                <div class="col-sm-7">\
                                    <input type="text" name="food_site[]" class="form-control" id="inputEmail3" placeholder="Lugar" required>\
                                </div>\
                            </div>\
                            <div class="form-row">\
                                <label for="inputEmail3" class="col-sm-5 control-label">Quien prepara:</label>\
                                <div class="col-sm-7">\
                                    <input type="text" name="food_who[]" class="form-control" id="inputEmail3" placeholder="Quien prepara?" required>\
                                </div>\
                            </div>';

                            var content_food_group ='<div class="content-food" data-id="'+data_id+'">\
                                            <div class="form-row bg-light-blue ml-1">\
                                                <div class="col-5">\
                                                    <label class="form-label mb-0 pt-1 white" for=""><b>Alimento</b></label>\
                                                </div>\
                                                <div class="col-7">\
                                                    <label class="form-label mb-0 pt-1 white" for=""><b>Cantidad</b></label>\
                                                </div>\
                                            </div>\
                                            <div class="border-light-blue ml-1 food-list" style="width:100%"></div>\
                                        </div><br>';
            
            
            $(this).siblings('.content-fields').append(content);
            $('.content-food-details').append(content_food_group);

            //Timepicker
            $('.timepicker').timepicker({
                showInputs: false
            })

        }
        else
        {
            $(this).siblings('.content-fields').html('');

            $('.content-group-rapid').find('.content-food').each(function(){

                if($(this).data('id') == data_id)
                {
                    $(this).remove();
                }
            });    
        }
    });

    //nuevo tiempo de alimento rapido
    $("body").on('change', '.food-check-rapid', function() {
        var data_id = $(this).data('id');
        var data_name = $(this).data('name');
        var dataJson = {};
        dataJson.id = data_id;

        if( $(this).is(':checked') ) {
            
            var content = '<div class="form-row">\
                                <label for="inputEmail3" class="col-sm-5 control-label">Hora:</label>\
                                <div class="col-sm-7">\
                                    <input type="text" name="food_hour[]" class="form-control timepicker" id="inputEmail3" placeholder="Hora" required>\
                                </div>\
                            </div>\
                            <div class="form-row">\
                                <label for="inputEmail3" class="col-sm-5 control-label">Lugar:</label>\
                                <div class="col-sm-7">\
                                    <input type="text" name="food_site[]" class="form-control" id="inputEmail3" placeholder="Lugar" required>\
                                </div>\
                            </div>\
                            <div class="form-row">\
                                <label for="inputEmail3" class="col-sm-5 control-label">Quien prepara:</label>\
                                <div class="col-sm-7">\
                                    <input type="text" name="food_who[]" class="form-control" id="inputEmail3" placeholder="Quien prepara?" required>\
                                </div>\
                            </div>';
            
            
            $(this).siblings('.content-fields').append(content);

            $.ajax({
                url     : siteUrl + "food-groups-ajax",
                method  : 'post',
                data: {dataJson: JSON.stringify(dataJson)},
                success : function(returnedData){
                    //console.log(returnedData);
                    $('.content-group-rapid').append(returnedData);
                },
                error: function() {
                    alert("No hay conexion con el servidor");
                }
            });

            //Timepicker
            $('.timepicker').timepicker({
                showInputs: false
            })

        }
        else
        {
            $(this).siblings('.content-fields').html('');

            $('.content-group-rapid').find('.content-food').each(function(){

                if($(this).data('id') == data_id)
                {
                    $(this).remove();
                }
            });    
        }
    });

    //nuevo tiempo de alimento rapido
    $('#btn-new-time-food-rapid').click(function(){
        var content = '<form id="form-new-food-time-rapid">\
                            <div class="form-row pb-2">\
                                <div class="col 12">\
                                    <input type="text" name="name" class="form-control input-sm" placeholder="Nuevo tiempo de comida">\
                                </div>\
                            </div>\
                            <div class="statusMsg"></div>\
                            <div class="form-row mx-auto">\
                                <buttom class="btn btn-success" id="btn-submit-new-time-food-rapid" onclick="submitNewFoodTime()" style="margin-right:5px;">Crear</buttom>\
                                <buttom id="btn-cancel-new-time-food-rapid" class="btn btn-danger">Cancelar</buttom>\
                            </div>\
                        </form>';
        if($('.new-time-food-rapid').is(':empty'))
        {
            $('.new-time-food-rapid').append(content);
        }
    });

    $('body').on('click', '#btn-cancel-new-time-food-rapid', function(){
        $('.new-time-food-rapid').html('');
    });

    //nuevo tiempo de alimento detallado
    $('#btn-new-time-food-detail').click(function(){
        var content = '<form id="form-new-food-time-detail">\
                        <div class="form-row mb-2">\
                            <div class="col 12">\
                                <input type="text" name="name" class="form-control input-sm" placeholder="Nuevo tiempo de comida">\
                            </div>\
                        </div>\
                        <div class="form-row mx-auto">\
                            <buttom class="btn btn-success" onclick="submitNewFoodTimeDetail()" style="margin-right:5px;">Crear</buttom>\
                            <buttom id="btn-cancel-new-time-food-detail" class="btn btn-danger">Cancelar</buttom>\
                        </div>\
                        </form>';
        if($('.new-time-food-detail').is(':empty'))
        {
            $('.new-time-food-detail').append(content);
        }
    });

    $('body').on('click', '#btn-cancel-new-time-food-detail', function(){
        $('.new-time-food-detail').html('');
    });

    $('body').on('click', '.plus-equivalent', function(){
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

    //search autocomplete
    $(".search-food-detail").easyAutocomplete({
        url: function(search) {
            return "{{route('foods.ajax')}}?search=" + search;
        },
         
         placeholder: "Busque un Alimento",

         getValue: "name",

         template: {
                         type: "custom",
                         method: function(value, item) {
                             return "<div class='item_producto_complete'><span>"+ value +"</span></div>";
                         }
                     },

         list: {
             onClickEvent: function() {
                 //alert("Click !");
                 var value = $("#search-food-detail").getSelectedItemData().name;
                 var id = $("#search-food-detail").getSelectedItemData().id;
                 var contenedor = $('.content-food:last .food-list:last');
                 var content_id = $('.content-food:last').data('id');
                 var time_name = $('.content-food:last').data('name');

                 var item = '<div class="form-row" style="margin-bottom:10px">\
                                                    <div class="col-4">\
                                                        <fieldset disabled>\
                                                            <input type="text" class="form-control" placeholder="Alimento" value="'+value+'">\
                                                        </fieldset>\
                                                        <input name="field['+content_id+'][food][]" type="hidden" value="'+id+'">\
                                                    </div>\
                                                    <div class="col-3">\
                                                        <input type="number" min="0" class="form-control" name="field['+content_id+'][cantidad][]" placeholder="Cantidad" value="" required="required">\
                                                    </div>\
                                                    <div class="col-3">\
                                                        <div class="form-check-inline mt-2">\
                                                            <label class="customradio mr-1 pl-4"><span class="radiotextsty">gr</span>\
                                                              <input type="radio" checked="checked" name="field['+content_id+']['+id+'][unity][]" value="1">\
                                                              <span class="checkmark mt-1"></span>\
                                                            </label>\
                                                            <label class="customradio mr-1 pl-4"><span class="radiotextsty">eq</span>\
                                                              <input type="radio" name="field['+content_id+']['+id+'][unity][]" value="2">\
                                                              <span class="checkmark mt-1"></span>\
                                                            </label>\
                                                        </div>\
                                                    </div>\
                                                    <div class="col-2 center">\
                                                        <button class="btn btn-sm btn-outline-danger btn-delete-item-food mt-2">\
                                                            <i class="fas fa-trash"></i>\
                                                        </button>\
                                                    </div>\
                                                </div>';    
                 contenedor.append(item);
                 $("#search-food-detail").val('');
             }    
         }
     });

     /*-----------------------------------------
     REMOVE SEARCH FOODS
     ------------------------------------------- */ 
     $(document).on('click', '.btn-delete-item-food', function(event){

        event.preventDefault();

        $(this).parent().parent().remove();

    });

    /*-----------------------------------------
    FUNCION PARA NUEVO ALIMENTO 
    ------------------------------------------*/
    function submitRegisterProduct(){
        var form = $('#form-modal-new-food');
        var valido = true;

        /*form.find(':input').each(function(){
            if($(this).val() == "")
            {
                alert('todos los campos son requeridos');
                $(this).focus();
                valido = false;
                return valido;
            }
        });*/

        if(valido)
        {
            var dataJson = form.serialize();
            $('#btn-modal-submit-food').attr("disabled","disabled");
            $('.modal-body').css('opacity', '.5');

            $.ajax({
                            
                url: siteUrl + "food/created",
                method: 'POST',
                data: {dataJson: dataJson},
                success: function(returnedData) {
                      console.log(returnedData);          
                    if(returnedData.status == 1)
                    {
                        form.find(':input').each(function(){
                            $(this).val('');
                        });

                        $('.bd-example-modal-lg').modal('hide');
                        Swal.fire({
                            type: 'success',
                            title: 'El producto se ha creado satisfactoriamente',
                            showConfirmButton: false,
                            timer: 2500
                        });
                    }
                    else
                    {
                        $('.statusMsg').html('<span style="color:red;"><b>'+returnedData.message+'</b></span>');
                    }
                    $('#btn-modal-submit-food').removeAttr("disabled");
                    $('.modal-body').css('opacity', '');	                            
                },
                error: function() {
                    alert("No hay conexion con el servidor");
                    $('#btn-modal-submit-food').removeAttr("disabled");
                    $('.modal-body').css('opacity', '');
                }
            });//fin Ajax
        }
        
    }

    /*-----------------------------------------
    FUNCION PARA NUEVO TIEMPO DE COMIDA 
    ------------------------------------------*/
    function submitNewFoodTime(){
        var form = $('#form-new-food-time-rapid');
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
                                    $('.content-food-times-rapid').append(food_time);
                                    $('.content-food-times-detail').append(food_time);

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

    //funcion de nuevo tiempo detalle
    function submitNewFoodTimeDetail(){
        var form = $('#form-new-food-time-detail');
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
            $('#btn-cancel-new-time-food-detail').attr("disabled","disabled");
            $('#btn-submit-new-time-food-detail').attr("disabled","disabled");
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
                                                        <input type="checkbox" class="custom-control-input food-check" name="food_time_'+returnedData.foodTime.id+'" value="'+returnedData.foodTime.id+'" id="food_time_'+returnedData.foodTime.id+'-detail">\
                                                        <label class="custom-control-label label-food-time" for="food_time_'+returnedData.foodTime.id+'-detail">'+returnedData.foodTime.name+'</label>\
                                                        <div class="content-fields"></div>\
                                                    </div>';
                                    $('.content-food-times-rapid').append(food_time);
                                    $('.content-food-times-detail').append(food_time);

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

    $('body').on('click', '.btn-foodtime-chart', function(event){
        event.preventDefault();
        var food_time_id = $(this).data('foodtime');
        var patient_id = $(this).data('patientid');
        var reminder_id = $(this).data('reminderid');

        var dataJson = {};
        dataJson.food_time_id = food_time_id;
        dataJson.patient_id = patient_id;
        dataJson.reminder_id = reminder_id;

        $.ajax({
                url     : siteUrl + "chart-food-groups-ajax",
                method  : 'post',
                data: {dataJson: JSON.stringify(dataJson)},
                success : function(returnedData){
                    console.log(returnedData);
                    $('.content-chart').html('');
                    $('.content-chart').append(returnedData);
                },
                error: function() {
                    alert("No hay conexion con el servidor");
                }
            });
    });

    $('#change_reminder').click(function(){
        $patient_slug = '{{ $patient->slug }}';
        swal.fire({
                    title: 'La informacíon se eliminara, Esta seguro?',
                    text: "El cambio es definitivo!",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si!'
                    }).then((result) => {
                    if (result.value) {
                        window.location.href=siteUrl+'patient/reminder/'+$patient_slug+'/change';
                    }
                });
    });
</script>
@if(isset($reminder_macro))
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

			var reminder_macro = <?php echo $reminder_macro; ?>;
			console.log(reminder_macro);
			var data =  google.visualization.arrayToDataTable(reminder_macro);
			
			var options = {
				title: 'Grafica de consumo de MacroNutientes',
                is3D: true,
                'width':400,
                'height':300
			}

			var chart = new google.visualization.PieChart(document.getElementById('chart_reminder_macro'));

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
    @endif
@endsection
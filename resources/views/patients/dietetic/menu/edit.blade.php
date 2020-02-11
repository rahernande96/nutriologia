@extends('layouts.admin')
@section('title')
Paciente: {{ $patient->name }}
@endsection
@section('extra-css')
<!-- easyautocomplete -->
<link rel="stylesheet" href="{{ asset('js/easyautocomplete/css/easy-autocomplete.min.css') }}">

@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Dietoterapia</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('menu.update', $menu->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('patients.dietetic.menu.fieldsEdit')
                </form>
            </div>
            <div class="card-footer">
                <div class="col-md-6 offset-md-5">
                    <a href="{{ route('dietetic.index', $patient->slug) }}" class="btn btn-primary">Ir a Dietetica</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal new dish -->
@include('patients.dietetic.menu.modalNewDish')
 <!-- /. modal new dish -->

@endsection

@section('extra-js')
<!-- easycomplete -->
<script src="{{ asset('js/easyautocomplete/js/jquery.easy-autocomplete.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2@8.js') }}"></script>
<script src="{ asset('js/laravel.js') }}"></script>
<script>
        function deleteMenu(e) {
            if (!confirm("Desea Eliminar Menu?")){
              e.preventDefault();
            }
          }
      </script>
<script>
    //seleccionar dias de la dietoterapia
    $('.check-day').click(function(){
        var day = $(this).val();
        var name = '';
        var tbody = $('#content-days tbody:first');

        switch(day) {
            case '1':
                name = 'Lunes';
                break;
            case '2':
                name = 'Martes';
                break
            case '3':
                name = 'Miercoles';
                break;
            case '4':
                name = 'Jueves';
                break;
            case '5':
                name = 'Viernes';
                break;
            case '6':
                name = 'Sábado';
                break;
            case '7':
                name = 'Domingo';
                break;
        }
        var item = '<tr class="content_'+day+'">\
                        <td colspan="1">\
                            <div class="card card-day mt-3" data-id="'+day+'">\
                                    <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#'+day+'" area-expanded="true">'+name+'</button>\
                                    <div id="'+day+'" class="collapse pt-4 pb-4 pr-2 pl-4 collapse show">\
                                        <div class="card">\
                                            <div class="card-header d-flex p-0">\
                                                <h5 class="card-title p-3">Tiempos de Comida</h5>\
                                                <ul class="nav nav-pills ml-auto p-2">\
                                                </ul>\
                                            </div><!-- /.card-header -->\
                                            <div class="card-body">\
                                                <div class="tab-content">\
                                                </div><!-- /.tab-content -->\
                                            </div><!-- /.card-body -->\
                                        </div>\
                                    </div>\
                            </div>\
                        </td>\
                    </tr>';
        
        if( $(this).is(':checked') )
        {
            tbody.append(item);
            add_food_times();
        }
        else
        {
            $('tr.content_'+day).remove();
            
            if($('.card-day').length == 0)
            {
                $('input[name="food_time[]"]:checked').each(function(){
                    $(this).removeAttr('checked');
                });
            }
        }
    });

    $('#btn-new-time-food').click(function(){
        var content = '<form id="form-new-food-time-rapid">\
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

    /*------------------------------------------
    FUNCION PARA BUSCAR INGREDIENTES EN EDICION 
    -------------------------------------------*/
    $(".search_ingredient").each(function(){
                    var $self = $(this);
                    $self.easyAutocomplete({
                        url: function(search) {
                            return "{{route('dishes.ajax')}}?search=" + search;
                        },
                        
                        placeholder: "Busque un platillo",

                        getValue: "name",

                        template: {
                                        type: "custom",
                                        method: function(value, item) {
                                            return "<div class='item_producto_complete'><img src/><span>"+ value +"</span></div>";
                                        }
                                    },

                        list: {
                            onClickEvent: function() {
                                var name = $self.getSelectedItemData().name;
                                var id = $self.getSelectedItemData().id;
                                var kcal = $self.getSelectedItemData().kcal;
                                //var image = $self.getSelectedItemData().image;
                                var image;
                                if($self.getSelectedItemData().image == null)
                                {
                                    image = siteUrl+'images/platillo.png';
                                }
                                else{
                                    image = siteUrl+'storage/dishes/'+$self.getSelectedItemData().image;
                                }
                                var day = $self.parent().parent().data('day');
                                var foodtime = $self.parent().parent().data('foodtime');
                                var contenedor = $self.parent().parent().siblings('div').children('table').children('tbody');

                                var item_complete = '<tr>\
                                                        <input type="hidden" name="dishes['+day+']['+foodtime+'][dish][]" value="'+id+'"/>\
                                                        <td class="text-center"><img width="40px" src="'+image+'"\></td>\
                                                        <td class="text-center">'+name+'</td>\
                                                        <td class="text-center">'+kcal+'</td>\
                                                        <td class="text-center">\
                                                            <button type="button" class="btn btn-sm btn-danger btn-delete-item"><i class="fa fa-trash"></i></button>\
                                                        </td>\
                                                    </tr>';  
                                
                                    contenedor.append(item_complete);
                                    $self.val('');
                            }    
                        }
                    });

                });
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

                                    $('#btn-cancel-new-time-food').removeAttr("disabled");
                                    $('#btn-submit-new-time-food-rapid').removeAttr("disabled");
                                    form.css('opacity', '');
                                }
                                else
                                {
                                    $('.statusMsg').html('<span style="color:red;"><b>'+returnedData.message+'</b></span>');
                                    $('#btn-cancel-new-time-food').removeAttr("disabled");
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

    //funcion para agregar tiempos de comidas ya seleccionados a dias
    function add_food_times(){
        $('input[name="food_time[]"]:checked').each(function(){
            var name = $(this).data('name');
                var id = $(this).val();
                
                $('.card-day:last').each(function(){
                    var day = $(this).data('id');

                    var header = '<li class="nav-item" id="item_'+day+'_'+id+'"><a class="nav-link" href="#day_'+day+'_food_time_'+id+'" data-toggle="tab">'+name+'</a></li>';
                    var tab_panel = '<div class="tab-pane" id="day_'+day+'_food_time_'+id+'">\
                                                        <div class="row">\
                                                            <div class="col-md-11" data-day="'+day+'" data-foodtime="'+id+'">\
                                                                    <input class="form-control search_ingredient" type="text" placeholder="Busque ingrediente o receta">\
                                                            </div>\
                                                            <div class="col-md-12 mt-4">\
                                                                <table class="table table-bordered">\
                                                                    <thead>\
                                                                        <tr>\
                                                                            <th class="text-center">Imagen</th>\
                                                                            <th class="text-center">Nombre</th>\
                                                                            <th class="text-center">Kcal</th>\
                                                                            <th class="text-center">Acción</th>\
                                                                        </tr>\
                                                                    </thead>\
                                                                    <tbody class="item-content">\
                                                                    </tbody>\
                                                                </table>\
                                                            </div>\
                                                        </div><!-- /. row -->\
                                                    <div><!-- /.tab-pane -->';
                    $(this).find('.card-header ul').append(header);
                    $(this).find('.card-body .tab-content').append(tab_panel);
                });

                $(".search_ingredient").each(function(){
                    var $self = $(this);
                    $self.easyAutocomplete({
                        url: function(search) {
                            return "{{route('dishes.ajax')}}?search=" + search;
                        },
                        
                        placeholder: "Busque un platillo",

                        getValue: "name",

                        template: {
                                        type: "custom",
                                        method: function(value, item) {
                                            return "<div class='item_producto_complete'><img src/><span>"+ value +"</span></div>";
                                        }
                                    },

                        list: {
                            onClickEvent: function() {
                                var name = $self.getSelectedItemData().name;
                                var id = $self.getSelectedItemData().id;
                                var kcal = $self.getSelectedItemData().kcal;
                                //var image = $self.getSelectedItemData().image;
                                var image;
                                if($self.getSelectedItemData().image == null)
                                {
                                    image = siteUrl+'images/platillo.png';
                                }
                                else{
                                    image = siteUrl+'storage/dishes/'+$self.getSelectedItemData().image;
                                }
                                var day = $self.parent().parent().data('day');
                                var foodtime = $self.parent().parent().data('foodtime');
                                var contenedor = $self.parent().parent().siblings('div').children('table').children('tbody');

                                var item_complete = '<tr>\
                                                        <input type="hidden" name="dishes['+day+']['+foodtime+'][dish][]" value="'+id+'"/>\
                                                        <td class="text-center"><img width="40px" src="'+image+'"\></td>\
                                                        <td class="text-center">'+name+'</td>\
                                                        <td class="text-center">'+kcal+'</td>\
                                                        <td class="text-center">\
                                                            <button type="button" class="btn btn-sm btn-danger btn-delete-item"><i class="fa fa-trash"></i></button>\
                                                        </td>\
                                                    </tr>';  
                                
                                    contenedor.append(item_complete);
                                    $self.val('');
                            }    
                        }
                    });

                });
        });
    }
    $('input[name="food_time[]"]').click(function(e){
        if($('input[name="days[]"]:checked').length > 0)
        {
            if($(this).is(':checked'))
            {
                
                var name = $(this).data('name');
                var id = $(this).val();
                
                $('.card-day').each(function(){
                    var day = $(this).data('id');

                    var header = '<li class="nav-item" id="item_'+day+'_'+id+'"><a class="nav-link" href="#day_'+day+'_food_time_'+id+'" data-toggle="tab">'+name+'</a></li>';
                    var tab_panel = '<div class="tab-pane" id="day_'+day+'_food_time_'+id+'">\
                                                        <div class="row">\
                                                            <div class="col-md-11" data-day="'+day+'" data-foodtime="'+id+'">\
                                                                    <input class="form-control search_ingredient" type="text" placeholder="Busque ingrediente o receta">\
                                                            </div>\
                                                            <div class="col-md-12 mt-4">\
                                                                <table class="table table-bordered">\
                                                                    <thead>\
                                                                        <tr>\
                                                                            <th class="text-center">Imagen</th>\
                                                                            <th class="text-center">Nombre</th>\
                                                                            <th class="text-center">Kcal</th>\
                                                                            <th class="text-center">Acción</th>\
                                                                        </tr>\
                                                                    </thead>\
                                                                    <tbody class="item-content">\
                                                                    </tbody>\
                                                                </table>\
                                                            </div>\
                                                        </div><!-- /. row -->\
                                                    <div><!-- /.tab-pane -->';
                    $(this).find('.card-header ul').append(header);
                    $(this).find('.card-body .tab-content').append(tab_panel);
                });

                $(".search_ingredient").each(function(){
                    var $self = $(this);
                    $self.easyAutocomplete({
                        url: function(search) {
                            return "{{route('dishes.ajax')}}?search=" + search;
                        },
                        
                        placeholder: "Busque un platillo",

                        getValue: "name",

                        template: {
                                        type: "custom",
                                        method: function(value, item) {
                                            //return "<div class='item_producto_complete'><span>"+ value +"</span></div>";
                                            return "<div class='item_producto_complete'><img src/><span>"+ value +"</span></div>";
                                        }
                                    },

                        list: {
                            onClickEvent: function() {
                                var name = $self.getSelectedItemData().name;
                                var id = $self.getSelectedItemData().id;
                                var kcal = $self.getSelectedItemData().kcal;
                                //var image = $self.getSelectedItemData().image;
                                var image;
                                if($self.getSelectedItemData().image == null)
                                {
                                    image = siteUrl+'images/platillo.png';
                                }
                                else{
                                    image = siteUrl+'storage/dishes/'+$self.getSelectedItemData().image;
                                }
                                var day = $self.parent().parent().data('day');
                                var foodtime = $self.parent().parent().data('foodtime');
                                var contenedor = $self.parent().parent().siblings('div').children('table').children('tbody');

                                var item_complete = '<tr>\
                                                        <input type="hidden" name="dishes['+day+']['+foodtime+'][dish][]" value="'+id+'"/>\
                                                        <td class="text-center"><img width="40px" src="'+image+'"\></td>\
                                                        <td class="text-center">'+name+'</td>\
                                                        <td class="text-center">'+kcal+'</td>\
                                                        <td class="text-center">\
                                                            <button type="button" class="btn btn-sm btn-danger btn-delete-item"><i class="fa fa-trash"></i></button>\
                                                        </td>\
                                                    </tr>';  
                                
                                    contenedor.append(item_complete);
                                    $self.val('');
                            }    
                        }
                    });

                });
            }
            else
            {
                var id = $(this).val();

                $('.card-day').each(function(){
                    var day = $(this).data('id');
                    $(this).find('.card-header ul li#item_'+day+'_'+id).remove();
                    $(this).find('.card-body .tab-content div#day_'+day+'_food_time_'+id).remove();
                });
            }
            
        }
        else
        {
           e.preventDefault(); 
            alert('Debe seleccionar dias');
        }
    });

    $('body').on('click', '.btn-delete-item', function(e){
        $(this).parent('td').parent('tr').remove();
    });

    $("#searchFood").easyAutocomplete({
                        url: function(search) {
                            return "{{route('ingredients.ajax')}}?search=" + search;
                        },
                        
                        placeholder: "Busque ingredientes",

                        getValue: "food",

                        template: {
                                        type: "custom",
                                        method: function(value, item) {
                                            return "<div class='item_producto_complete'><span>"+ value +"</span></div>";
                                        }
                                    },

                        list: {
                            onClickEvent: function() {
                                
                                var food = $("#searchFood").getSelectedItemData().food;
                                var id = $("#searchFood").getSelectedItemData().id;
                                var energy = $("#searchFood").getSelectedItemData().energy;
                                var quantity = $("#searchFood").getSelectedItemData().quantity;
                                var unity = $("#searchFood").getSelectedItemData().unity;
                                var contenedor = $('#modalTableDish tbody');
                                var item_complete = '<tr>\
                                                        <input type="hidden" name="food_id[]" value="'+id+'"/>\
                                                        <td class="text-center">'+food+'</td>\
                                                        <td class="text-center"><input class="form-control" type="number" min="0" step="0.5" name="quantity[]" value="'+quantity+'" /></td>\
                                                        <td class="text-center"><input class="form-control" type="number" min="0" step="0.5" name="eq[]" value="'+energy+'" /></td>\
                                                        <td class="text-center"><input type="text" name="gr[]" class="form-control" required/></td>\
                                                        <td class="text-center">'+unity+'</td>\
                                                        <td class="text-center">\
                                                            <button class="btn btn-sm btn-danger btn-delete-item"><i class="fa fa-trash"></i></button>\
                                                        </td>\
                                                    </tr>';  
                                
                                    contenedor.append(item_complete);
                                                              
                                $("#searchFood").val('');
                            }    
                        }
    });

    //guardar nuevo platillo
    $('#btn-save-dish').click(function(){
        var name = $('input[name="dish_name"]').val();
        var note = $('textarea[name="note"]').val();
        var patient_id = $('input[name="patient_id"]').val();
        
        var foods = new Array(); 
        var grs = new Array();
        var quantitys = new Array();
        var eqs = new Array();

        $('input[name="food_id[]"]').each(function() { foods.push($(this).val()); });

        $('input[name="gr[]"]').each(function() { 
            if($(this).val() == '')
            {
                $('#alert-foods span').text('Debe agregar todos los gramos');
                $('#alert-foods').show().delay(3000).fadeOut();
                return false;
            } 
        });

        $('input[name="quantity[]"]').each(function() { 
            if($(this).val() == '')
            {
                $('#alert-foods span').text('Debe agregar todas las cantidades');
                $('#alert-foods').show().delay(3000).fadeOut();
                return false;
            } 
        });

        $('input[name="eq[]"]').each(function() { 
            if($(this).val() == '')
            {
                $('#alert-foods span').text('Debe agregar todas las equivalencias');
                $('#alert-foods').show().delay(3000).fadeOut();
                return false;
            } 
        });

        $('input[name="gr[]"]').each(function() { grs.push($(this).val()); });
        $('input[name="quantity[]"]').each(function() { quantitys.push($(this).val()); });
        $('input[name="eq[]"]').each(function() { eqs.push($(this).val()); });
        
        var dataJson = {};

        dataJson.name = name;
        dataJson.patient_id = patient_id;
        dataJson.foods = foods;
        dataJson.note = note;
        dataJson.grs = grs;
        dataJson.quantitys = quantitys;
        dataJson.eqs = eqs;
        
        if(name == '')
        {
            $('#alert-name span').text('El nombre es obligatorio');
            $('#alert-name').show().delay(3000).fadeOut();
            return false;
        }
        else if(foods == '')
        {
            $('#alert-foods span').text('debe seleccionar al menos un ingrediente');
            $('#alert-foods').show().delay(3000).fadeOut();
            return false;
        }
        else if(note == '')
        {
            $('#alert-note span').text('debe agregar la preparacion  o nota');
            $('#alert-note').show().delay(3000).fadeOut();
            return false;
        }
        else{
            $('#btn-save-dish').attr('disabled', true);
            $('.modal-body').css('opacity', 0.5);

                $.ajax({
                            
                    url: "{{ route('dishes.store')}}",
                    method: 'POST',
                    data: {dataJson: dataJson},
                            success: function(returnedData) {
                                console.log(returnedData);
                                if(returnedData.status == 1)
                                {
                                    $('#newDishModal').modal('hide');
                                    
                                    Swal.fire({
                                        type: 'success',
                                        title: returnedData.message,
                                        showConfirmButton: false,
                                        timer: 2500
                                    });
                                }
                                else
                                {
                                    Swal.fire({
                                        type: 'danger',
                                        title: returnedData.message,
                                        showConfirmButton: false,
                                        timer: 2500
                                    });
                                }
                                $('#btn-save-dish').removeAttr("disabled");
                                $('.modal-body').css('opacity', '');	                            
                            },
                            error: function() {
                                alert("No hay conexion con el servidor");
                                $('#btn-save-dish').removeAttr("disabled");
                                $('.submitBtn').removeAttr("disabled");
                                $('.modal-body').css('opacity', '');
                            }
                });//fin Ajax
        }
    });

    //funcion cuando se cierra el modal
    $('#newDishModal').on('hide.bs.modal', function(e){
      $(e.currentTarget).find('input[name="dish_name"]').val('');
      $(e.currentTarget).find('input[name="status"]').val('');
      $(e.currentTarget).find('textarea[name="note"]').val('');
      $(e.currentTarget).find('tbody').html('');
  });

  //validar for modal
  function validate()
  {
      var radio = $('input[name="menu_id"]');

      if(radio.is(':checked'))
      {
          return true;
      }
      else{
          alert('debe seleccionar una dietoterapia');
          return false;
      }
  }

  $('#form_create_menu').submit(function(){
    var name = $('input[name="name"]');
        var tbodys = $('tbody.item-content');
        var days = $('div.card-day');
        var validate = true;

        if (name.val() == '') 
        {	
            Swal.fire({
                type: 'error',
                title: 'Debe ingresa el nombre del menu',
                showConfirmButton: false,
                timer: 2500
            });	
            return false;
        }

        if(days.length == 0)
        {
            Swal.fire({
                type: 'error',
                title: 'Debe seleccionar dias del menu',
                showConfirmButton: false,
                timer: 2500
            });	
            return false;
        }
        else
        {
            if(tbodys.length == 0)
            {	
                Swal.fire({
                    type: 'error',
                    title: 'Debe Seleccionar al menos un tiempo de comida',
                    showConfirmButton: false,
                    timer: 2500
                });	
                return false;
            }
            else
            {
                tbodys.each(function(){
                    if($(this).children().length == 0)
                    {
                        Swal.fire({
                            type: 'error',
                            title: 'Debe Seleccionar al menos un alimento en los tiempos de comida',
                            showConfirmButton: false,
                            timer: 2500
                        });		
                        //return false;
                        validate = 'false';
                    }
                    else
                    {
                        validate = 'true';
                    }
                });

                if(validate == 'true')
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
        } 
  });

  $('.dropdown-toggle').dropdown();
</script>
@endsection
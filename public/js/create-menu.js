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



     

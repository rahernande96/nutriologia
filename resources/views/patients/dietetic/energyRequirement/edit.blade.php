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
        <div class="card mt-3 tab-card">
            <div class="card-header tab-card-header">
                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                    @if($energy_requirement->type_get == 1)
                    <li class="nav-item">
                        <a class="nav-link active" id="rapid-tab" data-toggle="tab" href="#rapid" role="tab" aria-controls="home" aria-selected="true">Rapido (regla del pulgar)</a>
                    </li>
                    @elseif($energy_requirement->type_get == 2)
                    <li class="nav-item">
                        <a class="nav-link" id="formula-tab" data-toggle="tab" href="#formula" role="tab" aria-controls="profile" aria-selected="false">Formulas</a>
                    </li>
                    @elseif($energy_requirement->type_get == 3)
                    <li class="nav-item">
                        <a class="nav-link" id="manual-tab" data-toggle="tab" href="#manual" role="tab" aria-controls="profile" aria-selected="false">Manual</a>
                    </li>
                    @endif
                </ul>
            </div>
            <!-- tab content -->
            <div class="tab-content" id="myTabContent">
                {!! Form::model($total_energy_expenditure,['route'=> ['dietetic.getUpdate', $total_energy_expenditure->id],'method'=>'PUT','class'=>'form'])!!}
                @if($energy_requirement->type_get == 1)
                <div class="tab-pane fade show active p-4" id="rapid" role="tabpanel" aria-labelledby="home-tab">
                    @include('patients.dietetic.energyRequirement.get.fields_rapid')
                </div>
                @elseif($energy_requirement->type_get == 2)
                <div class="tab-pane fade show active p-4" id="formula" role="tabpanel" aria-labelledby="home-tab">
                    @include('patients.dietetic.energyRequirement.get.fields_formula')
                </div>
                @elseif($energy_requirement->type_get == 3)
                <div class="tab-pane fade show active p-4" id="manual" role="tabpanel" aria-labelledby="profile-tab">
                    @include('patients.dietetic.energyRequirement.get.fields_manual') 
                </div>
                @endif
                {!! Form::close() !!}
            </div>
            <!-- ./tab content -->
        </div>
    </div>
</div>

@endsection

@section('extra-js')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- easycomplete -->
<script src="{{ asset('js/easyautocomplete/js/jquery.easy-autocomplete.min.js') }}"></script>
<script>

    @if($energy_requirement->type_get == 1 || $energy_requirement->type_get == 2)
    
    $('[name="percentage_carbohydrates"]').val({{ $total_energy_expenditure->percentage_carbohydrates }});
    $('[name="percentage_protein"]').val({{ $total_energy_expenditure->percentage_protein }});
    $('[name="percentage_lipids"]').val({{ $total_energy_expenditure->percentage_lipids }});

    $('.percentage_rapid').bind('keyup mouseup wheel', function (e) {

        var event_control = true;

        if(e.type == "keyup"){
            if( e.which != 9 ) {
                event_control = false;
            }
        }
        

        if(event_control){

            var count = 0;
            var elements = [];
            var element_empty;
            elements.push($('[name="percentage_carbohydrates"]'));

            if(elements[0].val() == ""){

                element_empty = $('[name="percentage_carbohydrates"]');

                count++;

            }

            elements.push($('[name="percentage_protein"]'));

            if(elements[1].val() == ""){

                element_empty = $('[name="percentage_protein"]');

                count++;

            }

            elements.push($('[name="percentage_lipids"]'));

            if(elements[2].val() == ""){

                element_empty = $('[name="percentage_lipids"]');

                count++;

            }

            var value = 0;
            var percentage = 100;
            
            if(count==1 && e.target.name == element_empty.attr('name')){
                
                for(var i=0; i < elements.length; i++ ){

                    if(elements[i].attr('name') != element_empty.attr('name')){
                        console.log(elements[i].val());
                        value = value + parseFloat(elements[i].val());
                    }

                }
                console.log(value);
                if(value <= percentage){

                }
                    element_empty.val(percentage-value);

            }
                

        }

        


         
    });
    
        
    @endif

    $('input[name="supplement"]').click(function(){
        if( $(this).is(':checked') )
        {
            $('input[name="supplement_value"]').attr('disabled', false);
        }
        else
        {
            $('input[name="supplement_value"]').attr('disabled', true);
        }
    });

    $('input[name="method_water_requirement"]').change(function(){

        $('input[name="water_requirement"]').removeAttr('disabled');
    });

    $(function () {
    $('[data-toggle="tooltip"]').tooltip()
    });

     /*-----------------------------------------
     REMOVE SEARCH FOODS
     ------------------------------------------- */ 
     $(document).on('click', '.btn-delete-item-food', function(event){

        event.preventDefault();

        $(this).parent().parent().remove();

    });

    /*-------------------------------------------------------
     SELECION DE TIPO DE FACTOR DE ESTRESS (GET CON FORMULA)
     ------------------------------------------------------ */ 
     $(document).on('click', 'input[name="stress_factor_type"]', function(event){
        var fisic_activity_items = $('#fisic_activity_items');
        var methabolic_stress_items = $('#methabolic_stress_items');

        if($(this).val() == 1)
        {
            fisic_activity_items.css('display', 'block');
            methabolic_stress_items.css('display', 'none');
        }
        else
        {
            fisic_activity_items.css('display', 'none');
            methabolic_stress_items.css('display', 'block');
        }

    });

    /*-------------------------------------------------------
     SELECION DE FACTOR DE ESTRESS O MET'S(GET CON FORMULA)
     ------------------------------------------------------ */
     var content_stress_factor_mets = $('#content-estress-factor-mets');
     var item_stress_met;
     $(document).on('click', 'input[name="stress_factor"]', function(){
        if($(this).val() == 1)
        {
            item_stress_met = '<label for="patient" class="col-sm-4 col-form-label text-right"></label>\
                    <div class="form-check form-check-inline mt-2 col-sm-8 pl-0 mr-0" id="box_stress_factor">\
                        <div class="card bg-light" style="width:100%;">\
                            <div class="card-header text-muted border-bottom-0">\
                                <h3 class="card-title">Factor de Estres</h3>\
                            </div>\
                            <div class="card-body pl-0 pr-0">\
                            <table class="table">\
                                <thead>\
                                    <tr>\
                                        <th style="width:40%;">\
                                                <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Actividad Fisica</span>\
                                                    <input type="radio" name="stress_factor_type" value="1" checked>\
                                                    <span class="checkmark mt-1"></span>\
                                                </label>\
                                        </th>\
                                        <th style="width:0%;">\
                                                <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Estres Metabolico</span>\
                                                    <input type="radio" name="stress_factor_type" value="2">\
                                                    <span class="checkmark mt-1"></span>\
                                                </label>\
                                        </th>\
                                    </tr>\
                                </thead>\
                                <tbody>\
                                        <tr>\
                                            <td>\
                                                <div class="form-group" id="fisic_activity_items" style="display:block;">\
                                                    <div class="form-check p-0">\
                                                        <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Sedentario 1</span>\
                                                            <input type="radio" name="fisic_activity" value="1">\
                                                            <span class="checkmark mt-1"></span>\
                                                        </label>\
                                                    </div>\
                                                    <div class="form-check p-0">\
                                                        <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Poco Activo 1.14</span>\
                                                            <input type="radio" name="fisic_activity" value="2">\
                                                            <span class="checkmark mt-1"></span>\
                                                        </label>\
                                                    </div>\
                                                    <div class="form-check p-0">\
                                                        <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Activo 1.27</span>\
                                                            <input type="radio" name="fisic_activity" value="3">\
                                                            <span class="checkmark mt-1"></span>\
                                                        </label>\
                                                    </div>\
                                                    <div class="form-check p-0">\
                                                        <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Muy Activo 1.45</span>\
                                                            <input type="radio" name="fisic_activity" value="4">\
                                                            <span class="checkmark mt-1"></span>\
                                                        </label>\
                                                    </div>\
                                                    <div class="form-check p-0">\
                                                        <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Factor Añadido</span>\
                                                            <input type="radio" name="fisic_activity" value="5">\
                                                            <span class="checkmark mt-1"></span>\
                                                        </label>\
                                                    </div>\
                                                </div>\
                                            </td>\
                                            <td>\
                                                <div class="form-group" id="methabolic_stress_items">\
                                                    <div class="form-check p-0">\
                                                        <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Inanición simple 0.85</span>\
                                                            <input type="radio" name="methabolic_stress" value="1">\
                                                            <span class="checkmark mt-1"></span>\
                                                        </label>\
                                                    </div>\
                                                    <div class="form-check p-0">\
                                                        <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Lesión cefálica cerrada 1.3</span>\
                                                            <input type="radio" name="methabolic_stress" value="2">\
                                                            <span class="checkmark mt-1"></span>\
                                                        </label>\
                                                    </div>\
                                                    <div class="form-check p-0">\
                                                        <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Posoperatorio con complicaciones 1.05 - 1.15</span>\
                                                            <input type="radio" name="methabolic_stress" value="3">\
                                                            <span class="checkmark mt-1"></span>\
                                                        </label>\
                                                    </div>\
                                                    <div class="form-check p-0">\
                                                        <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Quemaduras mayores 1.8 - 1.14</span>\
                                                            <input type="radio" name="methabolic_stress" value="4">\
                                                            <span class="checkmark mt-1"></span>\
                                                        </label>\
                                                    </div>\
                                                    <div class="form-check p-0">\
                                                        <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Septicemia 1.2 - 1.4</span>\
                                                            <input type="radio" name="methabolic_stress" value="5">\
                                                            <span class="checkmark mt-1"></span>\
                                                        </label>\
                                                    </div>\
                                                    <div class="form-check p-0">\
                                                        <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Sindrome de reacción inflamatorio sistem</span>\
                                                            <input type="radio" name="methabolic_stress" value="6">\
                                                            <span class="checkmark mt-1"></span>\
                                                        </label>\
                                                    </div>\
                                                    <div class="form-check p-0">\
                                                        <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Sindrome de realimentación</span>\
                                                            <input type="radio" name="methabolic_stress" value="7">\
                                                            <span class="checkmark mt-1"></span>\
                                                        </label>\
                                                    </div>\
                                                    <div class="form-check p-0">\
                                                        <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Traumatismo múltiple</span>\
                                                            <input type="radio" name="methabolic_stress" value="8">\
                                                            <span class="checkmark mt-1"></span>\
                                                        </label>\
                                                    </div>\
                                                    <div class="form-check p-0">\
                                                        <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Úlceras por decúbito</span>\
                                                            <input type="radio" name="methabolic_stress" value="9">\
                                                            <span class="checkmark mt-1"></span>\
                                                        </label>\
                                                    </div>\
                                                    <div class="form-check p-0">\
                                                        <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Etapa I</span>\
                                                            <input type="radio" name="methabolic_stress" value="10">\
                                                            <span class="checkmark mt-1"></span>\
                                                        </label>\
                                                    </div>\
                                                    <div class="form-check p-0">\
                                                        <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Etapa II 1.3 - 1.4</span>\
                                                            <input type="radio" name="methabolic_stress" value="11">\
                                                            <span class="checkmark mt-1"></span>\
                                                        </label>\
                                                    </div>\
                                                    <div class="form-check p-0">\
                                                        <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Etapa III 1.5 - 1.</span>\
                                                            <input type="radio" name="methabolic_stress" value="12">\
                                                            <span class="checkmark mt-1"></span>\
                                                        </label>\
                                                    </div>\
                                                    <div class="form-check p-0">\
                                                        <label class="customradio mr\-1 ml-1 pl-4"><span class="radiotextsty">Etapa IV</span>\
                                                            <input type="radio" name="methabolic_stress" value="13">\
                                                            <span class="checkmark mt-1"></span>\
                                                        </label>\
                                                    </div>\
                                                </div>\
                                            </td>\
                                        </tr>\
                                </tbody>\
                            </table>\
                            </div>\
                        </div>\
                    </div>';
 
                    content_stress_factor_mets.html('');
                    content_stress_factor_mets.append(item_stress_met);
        }
        else
        {
            item_stress_met = '<label for="patient" class="col-sm-4 col-form-label text-right"></label>\
                    <div class="form-check form-check-inline mt-2 col-sm-8 pl-0 mr-0" id="box_mets">\
                        <div class="card bg-light" style="width:100%;">\
                            <div class="card-header text-muted border-bottom-0">\
                                <h3 class="card-title">METs</h3>\
                            </div>\
                            <div class="card-body pl-0 pr-0">\
                                <div class="col-sm-8">\
                                    <input class="form-control" id="search_mets" type="text">\
                                </div>\
                                <div class="col-sm-12">\
                                    <table class="table table-responsive" id="table-mets">\
                                        <thead>\
                                            <tr>\
                                                <th style="width:50%;">\
                                                        Categoría\
                                                </th>\
                                                <th style="width:50%;">\
                                                        Actividad\
                                                </th>\
                                                <th>Tiempo (hrs/min)</th>\
                                                <th>METs</th>\
                                                <th>Acción</th>\
                                            </tr>\
                                        </thead>\
                                        <tbody>\
                                        </tbody>\
                                    </table>\
                                </div>\
                            </div>\
                        </div>\
                    </div>';

                    
                    content_stress_factor_mets.html('');
                    content_stress_factor_mets.append(item_stress_met);

                    //search autocomplete
                                        
                    $("#search_mets").easyAutocomplete({
                        url: function(search) {
                            return "{{route('mets.ajax')}}?search=" + search;
                        },
                        
                        placeholder: "Busque un Met",

                        getValue: "actividad",

                        template: {
                                        type: "custom",
                                        method: function(value, item) {
                                            //return "<div class='item_producto_complete'><span>"+ value +"</span></div>";
                                            return "<div class='item_producto_complete'><span>"+ item.categoria +" - "+ value +"</span></div>";
                                        }
                                    },

                        list: {
                            onClickEvent: function() {
                                
                                var actividad = $("#search_mets").getSelectedItemData().actividad;
                                var id = $("#search_mets").getSelectedItemData().id;
                                var met = $("#search_mets").getSelectedItemData().met;
                                var categoria = $("#search_mets").getSelectedItemData().categoria;
                                console.log(met);
                                var contenedor = $('#table-mets tbody');
                                var filas = $('#table-mets tbody tr').length;

                                var item_complete = '<tr>\
                                                <td>'+categoria+'</td>\
                                                <td>\
                                                    <span>'+actividad+'<span>\
                                                    <input type="hidden" name="met_id" value="'+id+'">\
                                                </td>\
                                                <td>\
                                                    <input type="number" steep="0.1" min="0" name="activity_time" class="form-control" required>\
                                                </td>\
                                                <td>\
                                                    <input type="text" name="met" class="form-control-plaintext" step="1" min="0" class="form-control" value="'+met+'">\
                                                </td>\
                                                <td>\
                                                <button class="btn btn-sm btn-outline-danger btn-delete-item-food mt-2">\
                                                    <i class="fas fa-trash"></i>\
                                                </button>\
                                                </td>\
                                            </tr>';  
                                if(filas == 0)
                                {
                                    contenedor.append(item_complete);
                                }  
                                
                                $("#search_mets").val('');
                            }    
                        }
                    });

        }
     });

     /*-------------------------------------------------------
     LIMPIAR RADIO BUTONS
     ------------------------------------------------------ */

     $('#clear-radio').click(function(event){
        $('form input[type="radio"]').each(function(){
            $(this).prop('checked', false);
         });

         $('#box_stress_factor').remove();
         $('#box_mets').remove();
     });

     /*-------------------------------------------------------
     REQUERIMIENTO HIDRICO
     ------------------------------------------------------ */
     $('input[name="method_water_requirement"]').change(function(){
    
        var requirement_h_ml_kcal = $('#requirement_h_ml_kcal');
        var requirement_h_manual = $('#requirement_h_manual');
        if($(this).val() == 2)
        {
            requirement_h_ml_kcal.css('display', 'flex');
            requirement_h_manual.css('display', 'none');
        }
        else if($(this).val() == 3)
        {
            requirement_h_ml_kcal.css('display', 'none');
            requirement_h_manual.css('display', 'flex');
        }
        else
        {
            requirement_h_ml_kcal.css('display', 'none');
            requirement_h_manual.css('display', 'none');
        }
     });
</script>
@if(isset($macro_chart))
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

            var reminder_macro = <?php echo $macro_chart; ?>;
            console.log(reminder_macro);
            var data =  google.visualization.arrayToDataTable(reminder_macro);
            
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
@endif
@endsection

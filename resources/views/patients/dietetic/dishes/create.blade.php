@extends('layouts.admin')

@section('title')
Platillos
@endsection

@section('extra-css')
<!-- easyautocomplete -->
<link rel="stylesheet" href="{{ asset('js/easyautocomplete/css/easy-autocomplete.min.css') }}">
@endsection

@section('content')

<div class="row">
	<div class="col-md-10 px-4">
		<h2 class="mt-5 mb-4">Diseño de Platillos de {{ $patient->name }}</h2>
	</div>
  
	{{-- Inicia tabla de platillos --}}
	<div class="col-md-12">
		<div class="card">
            <div class="card-header">
              <h3 class="card-title">Nuevo Platillo</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="post" action="{{ route('dishes.store') }}" enctype="multipart/form-data">
                    @csrf
                    @include('patients.dietetic.dishes.fields')
                </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
	</div>
</div>
@endsection

@section('extra-js')
<!-- easycomplete -->
<script src="{{ asset('js/easyautocomplete/js/jquery.easy-autocomplete.min.js') }}"></script>
<script>



  $("#searchFood").easyAutocomplete({
                        url: function(search) {
                            return "{{route('ingredients.ajax')}}?search=" + search;
                        },
                        
                        placeholder: "Busque ingredientes",

                        getValue: "food",

                        template: {
                                        type: "custom",
                                        method: function(value, item) {
                                            //return "<div class='item_producto_complete'><span>"+ value +"</span></div>";
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
                                var fiber = $("#searchFood").getSelectedItemData().fiber;
                                var vitamin_a = $("#searchFood").getSelectedItemData().vitamin_A;
                                var ascorbic_acid = $("#searchFood").getSelectedItemData().ascorbic_acid;
                                var folic_acid = $("#searchFood").getSelectedItemData().folic_acid;
                                var airon_NO = $("#searchFood").getSelectedItemData().airon_NO;
                                var potassium = $("#searchFood").getSelectedItemData().potassium;
                                var contenedor = $('#modalTableDish tbody.content-ingredient');
                                var item_complete = '<tr>\
                                                        <input type="hidden" name="food_id[]" value="'+id+'"/>\
                                                        <td class="text-center relative">'+food+'<a href="" class="info-ingredient">\
                                                        <i class="fas fa-info-circle"></i>\
                                                        <div class="bubble me">\
                                                            <table class="table table-bordered">\
                                                                <thead>\
                                                                    <th>Estado Nutricional</th>\
                                                                    <th>Imc</th>\
                                                                </thead>\
                                                                <tbody>\
                                                                    <tr>\
                                                                        <td>Fibra</td>\
                                                                        <td>'+fiber+'</td>\
                                                                    </tr>\
                                                                    <tr>\
                                                                        <td>Vitamina A</td>\
                                                                        <td>'+vitamin_a+'</td>\
                                                                    </tr>\
                                                                    <tr>\
                                                                        <td>Acido Ascorbico</td>\
                                                                        <td>'+ascorbic_acid+'</td>\
                                                                    </tr>\
                                                                    <tr>\
                                                                        <td>Acido Folico</td>\
                                                                        <td>'+folic_acid+'</td>\
                                                                    </tr>\
                                                                    <tr>\
                                                                        <td>Hierro NO</td>\
                                                                        <td>'+airon_NO+'</td>\
                                                                    </tr>\
                                                                    <tr>\
                                                                        <td>Potasio</td>\
                                                                        <td>'+potassium+'</td>\
                                                                    </tr>\
                                                                </tbody>\
                                                            </table>\
                                                        </div>\
                                                        </a>\
                                                        </td>\
                                                        <td class="text-center"><input class="form-control" type="number" step="0.1" min="0" name="quantity[]"/></td>\
                                                        <td class="text-center"><input class="form-control" type="number" step="0.1" min="0" name="eq[]"/></td>\
                                                        <td class="text-center"><input class="form-control" type="number" step="0.1" min="0" name="gr[]"/></td>\
                                                        <td class="text-center">'+quantity+'-'+unity+'</td>\
                                                        <td class="text-center">\
                                                            <button type="button" class="btn btn-sm btn-danger btn-delete-item"><i class="fa fa-trash"></i></button>\
                                                        </td>\
                                                    </tr>';  
                                
                                    contenedor.append(item_complete);
                                                              
                                $("#searchFood").val('');
                            }    
                        }
    });

    /*-----------------------------------------
     REMOVE SEARCH FOODS
     ------------------------------------------- */ 
     $(document).on('click', '.btn-delete-item', function(event){

        event.preventDefault();

        $(this).parent().parent().remove();

    });
</script>
@endsection

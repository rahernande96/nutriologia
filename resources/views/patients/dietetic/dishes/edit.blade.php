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
              <h3 class="card-title">Edición de Platillo</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              @include('patients.dietetic.dishes.fieldsEdit')
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
                                var contenedor = $('#modalTableDish tbody');
                                var item_complete = '<tr>\
                                                        <input type="hidden" name="food_id[]" value="'+id+'"/>\
                                                        <td class="text-center">'+food+'</td>\
                                                        <td class="text-center"><input class="form-control" type="number" step="0.1" min="0" name="quantity[]" required/></td>\
                                                        <td class="text-center"><input class="form-control" type="number" step="0.1" min="0" name="eq[]" required/></td>\
                                                        <td class="text-center">'+quantity+'-'+unity+'</td>\
                                                        <td class="text-center">\
                                                            <button class="btn btn-sm btn-danger btn-delete-item"><i class="fa fa-trash"></i></button>\
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

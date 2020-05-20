@extends('layouts.admin')

@section('title')
Platillos
@endsection

@section('content')

<div class="row">
	<div class="col-md-10 px-4">
		<h2 class="mt-5 mb-4">Diseño de Platillos de {{ $patient->name }}</h2>
	</div>
  @if(Auth::user()->role_id == \App\Rol::DOCTOR)
	<div class="col-md-2 mt-5 text-center">
		<a href="{{ route('dishes.create', ['slug'=>$patient->slug,'history_id'=>$history->id]) }}" class="btn btn-primary"><i class="fas fa-utensils mr-2"></i>Nuevo Platillo</a>
	</div>
  @endif
	{{-- Inicia tabla de platillos --}}
	<div class="col-md-12">
		<div class="card">
            <div class="card-header">
              <h3 class="card-title">Todos los Platillos</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              @include('patients.dietetic.dishes.table')
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
  </div>
  <div class="col-md-3 offset-md-5 mb-4">
    <a href="{{ route('dietetic.index', ['slug'=>$patient->slug,'history_id'=>$history->id]) }}" class="btn btn-primary">Ir a dietetica</a>
  </div>
</div>
@endsection

@section('extra-js')
<script>
  function deleteDish(e) {
      if (!confirm("Eliminar Platillo?")){
        e.preventDefault();
      }
    }
</script>
<script>
    $(function () {
      $("#example1").DataTable({
          "language":
          {
            "sProcessing":     "Procesando...",
                          "sLengthMenu":     "Mostrar _MENU_ registros",
                          "sZeroRecords":    "No se encontraron resultados",
                          "sEmptyTable":     "Ningún dato disponible en esta tabla =(",
                          "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                          "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                          "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                          "sInfoPostFix":    "",
                          "sSearch":         "Buscar:",
                          "sUrl":            "",
                          "sInfoThousands":  ",",
                          "sLoadingRecords": "Cargando...",
                          "oPaginate": {
                              "sFirst":    "Primero",
                              "sLast":     "Último",
                              "sNext":     "Siguiente",
                              "sPrevious": "Anterior"
                          },
                          "oAria": {
                              "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                          },
                          "buttons": {
                              "copy": "Copiar",
                              "colvis": "Visibilidad"
                          }
          }
        });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
      });
    });

    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
  </script>
@endsection

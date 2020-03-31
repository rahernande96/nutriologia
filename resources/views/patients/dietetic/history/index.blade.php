@extends('layouts.admin')

@section('title')
Historial
@endsection

@section('content')

<div class="row">
	<div class="col-md-10 px-4">
		
	</div>
  @if(Auth::user()->role_id == \App\Rol::DOCTOR)
	<div class="col-md-2 mt-5 text-center">
		<a href="{{ route('dietetic.history.create',$patient->slug) }}" class="btn btn-primary"><i class="fa fa-user-plus"></i> Nuevo Registro</a>
	</div>
  @endif
	{{-- Inicia tabla de pacientes --}}
	<div class="col-md-12 mt-3">
		<div class="card">
            <div class="card-header">
              <h3 class="card-title">Historial de dietetica</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Fecha de creacion</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($records as $history)
                  <tr class="text-center">
                    <td>{{ $history->id }}</td>
                    <td>{{ $history->created_at }}</td>
                    <td>
                    <a class="btn btn-primary" href="{{ route('dietetic.index',['slug'=>$patient->slug,'history_id'=>$history->id]) }}">Ir</a>
                    </td>
                  </tr>
                  @endforeach
                </table>

              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
	</div>
</div>

<script>
    function deletePatient(e) {
      if (!confirm("Eliminar Paciente?")){
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

  $('.dropdown-toggle').dropdown();
</script>

@endsection

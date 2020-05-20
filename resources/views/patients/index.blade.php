@extends('layouts.admin')

@section('title')
Pacientes
@endsection

@section('content')

<div class="row">
	<div class="col-md-10 px-4">
		
	</div>
  @if(Auth::user()->role_id == \App\Rol::DOCTOR)
	<div class="col-md-2 mt-5 text-center">
		<a href="{{ route('patients.create') }}" class="btn btn-primary"><i class="fa fa-user-plus"></i> Nuevo Paciente</a>
	</div>
  @endif
	{{-- Inicia tabla de pacientes --}}
	<div class="col-md-12 mt-3">
		<div class="card">
            <div class="card-header">
              <h3 class="card-title">Detalles de los pacientes</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>Telefono</th>
                    <th>Acciones de consulta</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($patients as $patient)
                  <tr class="text-center">
                    <td>{{ $patient->name }}</td>
                    <td>{{ $patient->age }}</td>
                    <td>{{ $patient->phone_1 }}</td>
                    <td>
                      @include('patients.consult_actions')
                    </td>
                    <td>
                    @include('patients.actions')
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

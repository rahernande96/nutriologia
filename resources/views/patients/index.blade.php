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
    $("#example1").DataTable();
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

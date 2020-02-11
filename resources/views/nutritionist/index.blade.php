@extends('layouts.admin')

@section('title')
Nutriologos
@endsection

@section('content')

<div class="row">
	<div class="col-md-10 px-4">
		<h1>Nutriologos</h1>
	</div>
	{{-- <div class="col-md-2 mt-2 text-center">
		<a href="#" class="btn btn-primary"><i class="fa fa-user"></i> Nuevo Paciente</a>
	</div> --}}
	{{-- Inicia tabla de pacientes --}}
	<div class="col-md-12">
		<div class="card">
            <div class="card-header">
              <h3 class="card-title">Detalles de los nutriologos</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Correo Electrónico</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($nutritionists as $nutriologist)
                <tr class="text-center">
                  <td>{{ $nutriologist->name }}</td>
                  <td>{{ $nutriologist->email }}</td>
                  <td>
                  <form action="{{ route('nutritionists.update', $nutriologist->slug) }}" method="POST">
                      @method('PUT')
                      @csrf
                      <a href="#" type="button" class="btn btn-warning text-white" data-toggle="modal" data-target="#exampleModal-{{ $nutriologist->slug }}">Mostrar</a>
                      <!-- Modal -->
                      <div class="modal fade" id="exampleModal-{{ $nutriologist->slug }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">{{ $nutriologist->name }}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="row d-flex justify-content-center">
                                    <div class="col-md-4">
                                      <img src="{{ asset($nutriologist->picture) }}" alt="User Image" class="img-fluid">
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <p><strong>Nombre: </strong> {{ $nutriologist->name }}</p>
                                </div>
                                <div class="col-md-6">
                                  <p><strong>Correo Electrónico: </strong> {{ $nutriologist->email }}</p>
                                </div>
                                <div class="col-md-6">
                                @if($nutriologist->status != true)
                                  <p><strong>Estado de la cuenta: </strong> 
                                    <span class="badge badge-danger">Suspendida</span>
                                  </p>
                                @else
                                  <p><strong>Estado de la cuenta: </strong> <span class="badge badge-success">Activa</span></p>
                                @endif
                                </div>
                                <div class="col-md-6">

                                @if($nutriologist->confirmed != false)
                                  <p><strong>Correo electrónico verificado: </strong>
                                    <span class="badge badge-success">Verificado</span>
                                  </p>
                                @else
                                  <p><strong>Correo electrónico verificado: </strong> 
                                    <span class="badge badge-danger">Sin verificar</span>
                                  </p>
                                @endif
                                </div>

                                <div class="col-md-6">
                                  <p><strong>No.Registro: </strong>{{ $nutriologist->no_registry }}</p>
                                </div>

                                <div class="col-md-6">
                                  <p><strong>Cédula: </strong>{{ $nutriologist->identification_card }}</p>
                                </div>

                                <div class="col-md-6">
                                  <p><strong>Fecha de registro: </strong>{{ $nutriologist->created_at->format('d-M-Y') }}</p>
                                </div>


                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      @if($nutriologist->status != true)
                      <button onclick="activeNutriologist(event)" type="submit" class="btn btn-success text-white">Activar cuenta</button>
                      @else
                      <button onclick="desactiveNutriologist(event)" type="submit" class="btn btn-danger text-white">Desactivar</button>
                      @endif
                  </form>
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
    function desactiveNutriologist(e) {
      if (!confirm("Restringir acceso al nutriologo?")){
        e.preventDefault();
      }
    }
</script>

<script>
    function activeNutriologist(e) {
      if (!confirm("Activar cuenta del nutriologo?")){
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
</script>

@endsection
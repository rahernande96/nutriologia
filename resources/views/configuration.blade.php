@extends('layouts.admin')

@section('title')
Configuración
@endsection

@section('content')

<!-- Modal -->
<div class="modal fade" id="updatePassword" tabindex="-1" role="dialog" aria-labelledby="CambiarContraseña" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="CambiarContraseña">Formulario de edición de contraseña</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('change_password', $user->slug) }}" method="POST">
          @method('PUT')
          @csrf
          <div class="row">
            <div class="form-group col-md-12">
              <input type="password" name="current_password" class="form-control" id="current_password" placeholder="Ingrese su contraseña actual">
            </div>
            <div class="form-group col-md-12">
              <input type="password" name="password" class="form-control" id="password" placeholder="Ingrese la nueva contraseña">
            </div>
            <div class="form-group col-md-12">
              <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirme su nueva contraseña nueva">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="card mt-4">
      <div class="card-header">
        <h3 class="card-title">Configuración de la cuenta</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <div class="row d-flex justify-content-center">
              <div class="col-md-3">
                <img src="{{ asset($user->picture) }}" alt="User Image" class="img-fluid">
              </div>
            </div>
          </div>

          <div class="col-md-12 mt-4">
            <div class="row d-flex justify-content-center">
              <div class="col-md-3">
                <div class="input-group mb-3">
                  <div class="custom-file">
                    <form action="{{ route('change_picture', $user->slug) }}" method="POST" enctype="multipart/form-data">
                      @method('PUT')
                      @csrf
                      <input type="file" class="custom-file-input" id="picture" name="picture">
                      <label class="custom-file-label" for="picture" aria-describedby="inputGroupFileAddon02">Seleccionar Fotografía</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="row d-flex justify-content-center">
                <div class="col-md-3">
                  <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">

                      <button type="submit" class="btn btn-success">Cambiar Imágen</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>


@if(auth()->)

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

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
		<a href="{{ route('dishes.create', $patient->slug) }}" class="btn btn-primary"><i class="fas fa-utensils mr-2"></i>Nuevo Platillo</a>
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
    <a href="{{ route('dietetic.index', $patient->slug) }}" class="btn btn-primary">Ir a dietetica</a>
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

    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
  </script>
@endsection

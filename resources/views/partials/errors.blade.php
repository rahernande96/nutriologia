@if(count($errors))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
	Error al ingresar datos al formulario.
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
	<ul class="mb-0">
		@foreach($errors->all() as $error)
			<li style="list-style: none;">{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif
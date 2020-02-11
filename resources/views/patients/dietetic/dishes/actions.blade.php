<!-- Example single danger button -->
<div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Acciones
    </button>
    <div class="dropdown-menu">
        <a href="{{ route('dishes.show', $dish->id) }}" class="dropdown-item">Detalle</a>
        <a href="{{ route('dishes.edit', $dish->id) }}" class="dropdown-item">Editar</a>
        <div class="dropdown-divider"></div>
        <form action="{{ route('dishes.destroy', $dish->id) }}" method="POST">
            @method('DELETE')
            @csrf
            <button onclick="deleteDish(event)" type="submit" class="dropdown-item">Eliminar</button>
        </form>
    </div>
  </div>
  {{--<a href="{{ route('dishes.edit', $dish->id) }}" class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></a>
  <a href="{{ route('dishes.edit', $dish->id) }}" class="btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
  
  <form action="{{ route('dishes.destroy', $dish->id) }}" method="POST" style="display:inline-block;">
      @method('DELETE')
      @csrf
      <button onclick="deleteDish(event)" type="submit" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-trash"></i></button>
  </form>--}}
<table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th class="text-center">Id</th>
        <th class="text-center">Imagen</th>
        <th class="text-center">Nombre</th>
        <th class="text-center"> Cant Ingredientes</th>
        <th class="text-center">Kcal</th>
        <th class="text-center">Notas</th>
        <th class="text-center">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($dishes as $dish)
    <tr>
        <td>{{ $dish->id }} </td>
        <td class="v-middle">
            <img src="@if($dish->image != null){{ asset('storage/dishes/'.$dish->image) }}@else {{ asset('images/platillo.png')  }} @endif" alt="{{ $dish->name }}" width="50px;">
        </td>
        <td>{{ $dish->name }}</td>
        <td class="text-center">
           {{ $dish->details->count() }}
        </td>
        <td>{{ $dish->kcal }}</td>
        <td>{{ $dish->notes }}</td>
        <td class="v-middle">
         @include('patients.dietetic.dishes.actions')
        </td>
    </tr>
    @endforeach
  </table>
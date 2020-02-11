<div class="col-md-8 offset-md-2">
        <form id="formNewDish" method="post" action="{{ route('dishes.update', $dish->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nombre del platillo</label>
                    <input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Ingrese nombre" value="{{ $dish->name }}">
                    <small id="nameHelp" class="form-text text-muted">Ingrese el nombre del platillo.</small>
                </div>
                <div class="form-group">
                        <label for="exampleInputEmail1">Seleccione Tipo</label>
                        <select name="type_id" id="" class="form-control">
                            <option value="" selected hidden>Seleccione tipo</option>
                            @foreach($types as $type)
                            <option value="{{ $type->id }}" @if($type->id == $dish->type_id) selected @endif>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Seleccione Costo</label>
                        <select name="cost_id" id="" class="form-control">
                            <option value="" selected hidden>Seleccione costo</option>
                            @foreach($costs as $cost)
                            <option value="{{ $cost->id }}" @if($cost->id == $dish->cost_id) selected @endif>{{ $cost->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Seleccione Temperatura</label>
                        <select name="temperature_id" id="" class="form-control">
                            <option value="" selected hidden>Seleccione temperatura</option>
                            @foreach($temperatures as $temperature)
                            <option value="{{ $temperature->id }}" @if($temperature->id == $dish->temperature_id) selected @endif>{{ $temperature->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Seleccione Estilo</label>
                        <select name="style_id" id="" class="form-control">
                            <option value="" selected hidden>Seleccione estilo</option>
                            @foreach($styles as $style)
                            <option value="{{ $style->id }}" @if($style->id == $dish->style_id) selected @endif>{{ $style->name }}</option>
                            @endforeach
                        </select>
                    </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Busque ingredientes</label>
                    <input type="text" class="form-control" id="searchFood" aria-describedby="searchHelp">
                    <small id="searchHelp" class="form-text text-muted">Busque los ingredientes del platilo.</small>
                </div>
                <div class="form-group">
                    <table class="table table-bordered" id="modalTableDish">
                        <thead>
                            <tr>
                                <th class="text-center">Ingrediente</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-center">Eq</th>
                                <th class="text-center">Gr</th>
                                <th class="text-center">Unidad</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dish->details as $detail)
                                <tr>
                                    <input type="hidden" name="food_id[]" value="{{ $detail->ingredient->id }}"/>
                                    <td class="relative">{{ $detail->ingredient->food }}
                                        <a href="" class="info-ingredient">
                                            <i class="fas fa-info-circle"></i>
                                            <div class="bubble me">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <th>Estado Nutricional</th>
                                                        <th>Imc</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Fibra</td>
                                                            <td>{{ $detail->ingredient->fiber }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Vitamina A</td>
                                                            <td>{{ $detail->ingredient->vitamin_A }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Acido Ascorbico</td>
                                                            <td>{{ $detail->ingredient->ascorbic_acid }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Acido Folico</td>
                                                            <td>{{ $detail->ingredient->folic_acid }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Hierro NO</td>
                                                            <td>{{ $detail->ingredient->airon_NO }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Potasio</td>
                                                            <td>{{ $detail->ingredient->potassium }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            </a>
                                    </td>
                                    <td><input class="form-control" type="number" step="0.1" min="0" name="quantity[]" value="{{ $detail->quantity }}" required></td>
                                    <td><input class="form-control" type="number" step="0.1" min="0" name="eq[]" value="{{ $detail->eq }}" required/></td>
                                    <td><input class="form-control" type="number" step="0.1" min="0" name="gr[]" value="{{ $detail->gr }}" required></td>
                                    <td>{{ $detail->ingredient->quantity.'-'.$detail->ingredient->unity }}</td>
                                    <td><button class="btn btn-sm btn-danger btn-delete-item"><i class="fa fa-trash"></i></button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Preparación o notas</label>
                    <textarea class="form-control" name="note" id="" cols="30" rows="6">{{ $dish->notes }}</textarea>
                </div>
                <div class="form-group mt-4">
                        <label for="exampleInputEmail1" class="text-center" style="width:100%;">Vista previa de la imagen</label>
                        <div class="text-center mb-4">
                                <img src="@if($dish->image != null){{ asset('storage/dishes/'.$dish->image) }}@else {{ asset('images/platillo.png')  }} @endif" class="rounded" alt="..." width="150px">
                        </div>
                        <label for="exampleInputEmail1">Imagen de la receta (opcional)</label>
                        <input type="file" class="form-control" name="image" id="" cols="30" rows="6"></textarea>
                    </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info" id="btn-save-dish">Guardar</button>
                    <a class="btn btn-danger" href="{{ route('dishes.index', $patient->slug) }}">Cancelar</a>
                </div>
            </form>
</div>
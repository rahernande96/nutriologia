<div class="col-md-8 offset-md-2">
        
                <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nombre del platillo</label>
                    <input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Ingrese nombre">
                    <small id="nameHelp" class="form-text text-muted">Ingrese el nombre del platillo.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Seleccione Tipo</label>
                    <select name="type_id" id="" class="form-control">
                        <option value="" selected hidden>Seleccione tipo</option>
                        @foreach($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Seleccione Costo</label>
                    <select name="cost_id" id="" class="form-control">
                        <option value="" selected hidden>Seleccione costo</option>
                        @foreach($costs as $cost)
                        <option value="{{ $cost->id }}">{{ $cost->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Seleccione Temperatura</label>
                    <select name="temperature_id" id="" class="form-control">
                        <option value="" selected hidden>Seleccione temperatura</option>
                        @foreach($temperatures as $temperature)
                        <option value="{{ $temperature->id }}">{{ $temperature->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Seleccione Estilo</label>
                    <select name="style_id" id="" class="form-control">
                        <option value="" selected hidden>Seleccione estilo</option>
                        @foreach($styles as $style)
                        <option value="{{ $style->id }}">{{ $style->name }}</option>
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
                        <tbody class="content-ingredient">
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Preparación o notas</label>
                    <textarea class="form-control" name="note" id="" cols="30" rows="6"></textarea>
                </div>
                <div class="form-group">
                        <label for="exampleInputEmail1">Imagen de la receta (opcional)</label>
                        <input type="file" class="form-control" name="image" id="" cols="30" rows="6"></textarea>
                    </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Guardar</button>
                    <a class="btn btn-danger" href="{{ route('dishes.index', $patient->slug) }}">Cancelar</a>
                </div>
            
</div>
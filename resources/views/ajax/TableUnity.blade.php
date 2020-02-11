<table class="table table-bordered">
    <thead>
        <tr>
            <th>
                <select name="" id="scroll_unity" class="form-control">
                    <option value="1" @if($unity == 1) selected @endif><b>GRAMOS</b></option>
                    <option value="2" @if($unity == 2) selected @endif><b>kCAL</b></option>
                </select>
            </th>
            <th>Proteinas</th>
            <th>Lipidos</th>
            <th>Hidratos de Carbonos</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>CONTADOS</td>
            <td>{{ $contado_proteins }}</td>
            <td>{{ $contado_lipids }}</td>
            <td>{{ $contado_carbohydrates }}</td>
        </tr>
        <tr>
            <td>META</td>
            <td>{{ $meta_proteins }}</td>
            <td>{{ $meta_lipids }}</td>
            <td>{{ $meta_carbohydrates }}</td>
        </tr>
        <tr>
            <td>ADECUACIÓN</td>
            <td>{{ $adecuacion_proteins }}</td>
            <td>{{ $adecuacion_lipids }}</td>
            <td>{{ $adecuacion_carbohydrates }}</td>
        </tr>
        <tr>
            <td>PORCENTAJES</td>
            <td><input class="form-control" name="porcent_proteins" type="number" min="0" step="0.1" value="{{ $porcent_proteins }}"/></td>
            <td><input class="form-control" name="porcent_lipids" type="number" min="0" step="0.1" value="{{ $porcent_lipids }}"/></td>
            <td><input class="form-control" name="porcent_carbohydrates" type="number" min="0" step="0.1" value="{{ $porcent_carbohydrates }}"/></td>
        </tr>
    </tbody>
</table>
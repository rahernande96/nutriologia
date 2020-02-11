<div class="form-group row">
    <label for="patient" class="col-sm-4 col-form-label text-right">Paciente:</label>
    <div class="col-sm-6">
        <input type="text" readonly class="form-control-plaintext" id="patient" value="{{ $patient->name }}">
        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
    </div>
</div>
@if($patient->gender == 'Femenino')
<div class="form-group row">
    <label for="imc" class="col-sm-4 col-form-label text-right">Periodo:</label>
    <div class="col-sm-6">
        <div class="form-check-inline mt-2">
            <label class="customradio mr-4 pl-4"><span class="radiotextsty">Lactancia</span>
              {!! Form::radio('period', '1') !!}
              <span class="checkmark mt-1"></span>
            </label>
            <label class="customradio mr-1 pl-4"><span class="radiotextsty">Embarazo</span>
              {!! Form::radio('period', '2') !!}
              <span class="checkmark mt-1"></span>
            </label>
            <div class="content-period"></div>
        </div>
    </div>
</div>
@endif
<div class="form-goup row period-semestry" style="display: none">
        <label for="imc" class="col-sm-4 col-form-label text-right">Semestre:</label>
        <div class="col-sm-6">
            <select name="semestry" class="form-control">
                <option value="" selected hidden>Seleccione semestre</option>
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
        </div>
</div>
<div class="form-goup row period-trimestry" style="display: none">
        <label for="imc" class="col-sm-4 col-form-label text-right">Trimestre:</label>
        <div class="col-sm-6">
            <select name="trimestry" class="form-control">
                <option value="" selected hidden>Seleccione trimestre</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
        </div>
</div>
<div class="form-group row mt-2">
<label for="imc" class="col-sm-4 col-form-label text-right">Como quieres obtener el GET?</label>
<div class="col-sm-6">
    {!! Form::select('type_get', [1 => 'Calculo rapido (regla del pulgar)', 2 => 'Formulas', 3 => 'Ingreso manual'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione']) !!}
</div>
</div>

<br>
<div class="form-group row">
    <div class="col-sm-6 offset-md-4">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('dietetic.index', $patient->slug) }}" class="btn btn-danger">Cancelar</a>
    </div>
</div>
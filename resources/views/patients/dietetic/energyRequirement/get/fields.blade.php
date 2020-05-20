<div class="col-md-6">
    <div class="form-group row">
        <label for="patient" class="col-sm-4 col-form-label text-right">Paciente:</label>
        <div class="col-sm-6">
            <input type="text" readonly class="form-control-plaintext" id="patient" value="{{ $patient->name }}">
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
            <input type="hidden" name="history_id" value="{{ $history->id }}">
        </div>
    </div>
    <div class="form-group row">
        <label for="patient" class="col-sm-4 col-form-label text-right">Kcal:</label>
        <div class="col-sm-6">
            {!!Form::text('kcal', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        <label for="patient" class="col-sm-4 col-form-label text-right">Get:</label>
        <div class="col-sm-6">
            {!!Form::text('kcal', null, ['class' => 'form-control-plaintext', 'readonly'  => 'readonly']) !!}
        </div>
    </div>
    <div class="form-group row">
        <label for="patient" class="col-sm-4 col-form-label text-right">Suplementos:</label>
        <div class="col-sm-1">
            <label class="check ">
                {!! Form::checkbox('supplement',null) !!}
                <span class="checkmark"></span>
            </label>
        </div>
        <div class="col-sm-5">
            {!!Form::text('supplement_value', null, ['class' => 'form-control', 'id' => 'supplement_value', 'disabled' => 'disabled']) !!}
        </div>
    </div>
    <div class="form-group row">
        <label for="patient" class="col-sm-4 col-form-label text-right">Seleccione Metodo de Requerimiento Hidrico:</label>
        <div class="form-check mt-2 col-sm-4 pl-0">
            <label class="customradio mr-1 pl-4"><span class="radiotextsty">Edad/ml/kg</span>
              {!! Form::radio('method_water_requirement', '1') !!}
              <span class="checkmark mt-1"></span>
            </label>
            <label class="customradio mr-1 pl-4"><span class="radiotextsty">ml/kcal</span>
              {!! Form::radio('method_water_requirement', '2') !!}
              <span class="checkmark mt-1"></span>
            </label>
            <label class="customradio mr-1 pl-4"><span class="radiotextsty">Manual</span>
                {!! Form::radio('method_water_requirement', '3') !!}
                <span class="checkmark mt-1"></span>
            </label>
        </div>
        <div class="col-sm-2 mt-4">
            {!!Form::text('water_requirement', null, ['class' => 'form-control', 'id' => 'supplement_value', 'disabled' => 'disabled']) !!}
        </div>
    </div>
</div>
<div class="col-md-6"></div>
<div class="col-md-6 offset-md-4">
    <button class="btn btn-primary" type="submit">Guardar</button>
    <a href="{{ route('dietetic.index', ['slug'=>$patient->slug,'history_id'=>$history->id]) }}" class="btn btn-danger">Cancelar</a>
</div>
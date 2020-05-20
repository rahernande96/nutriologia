<div class="form-group row">
        <label for="patient" class="col-sm-4 col-form-label text-right">Paciente:</label>
        <div class="col-sm-6">
            <input type="text" readonly class="form-control-plaintext" id="patient" value="{{ $patient->name }}">
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
        </div>
    </div>
    <div class="form-group row">
        <label for="size" class="col-sm-4 col-form-label text-right">Talla:</label>
        <div class="col-sm-4">
            {{--<input type="number" step="0.01" min="0" name="size" class="form-control" id="size" placeholder="Talla">--}}
            {!!Form::number('size',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Talla'])!!}
        </div>
        <div class="col-sm-2">
            Mtrs
        </div>
    </div>
    <div class="form-group row">
        <label for="weight" class="col-sm-4 col-form-label text-right">Peso:</label>
        <div class="col-sm-4">
            {{--<input type="number" step="0.01" min="0" name="weight" class="form-control" id="weight" placeholder="Peso">--}}
            {!!Form::number('weight',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Peso'])!!}
        </div>
        <div class="col-sm-2">
            Kgrs
        </div>
    </div>
    <div class="form-group row">
        <label for="imc" class="col-sm-4 col-form-label text-right">IMC:</label>
        <div class="col-sm-4">
            {{--<input type="text" readonly name="imc" class="form-control-plaintext" id="imc" placeholder="IMC">--}}
            {!!Form::text('imc',null,['class'=>'form-control-plaintext', 'readonly' => 'readonly', 'placeholder' => 'IMC'])!!}
        </div>
        <div class="col-md-1 content-info-imc" @if(!isset($basicMeasure)) style="display:none;" @endif>
            <i class="fas fa-info-circle"></i>
            <div class="bubble me">
                @include('patients.anthropometry.basicMeasure.tableNutritionalState')
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="imc" class="col-sm-4 col-form-label text-right">Embarazo:</label>
        <div class="col-sm-6">
            <div class="form-check-inline mt-2">
                <label class="customradio mr-1 pl-4"><span class="radiotextsty">Si</span>
                  {!! Form::radio('pregnancy', '1') !!}
                  <span class="checkmark mt-1"></span>
                </label>
                <label class="customradio mr-1 pl-4"><span class="radiotextsty">No</span>
                  {!! Form::radio('pregnancy', '0', ['checked' => 'checked']) !!}
                  <span class="checkmark mt-1"></span>
                </label>
            </div>
        </div>
    </div>
    <div class="content-pregnancy" @if(isset($basicMeasure) && $basicMeasure->pregnancy == 1) style="display:block;" @endif>
        <div class="form-group row">
            <label for="gestation_week" class="col-sm-4 col-form-label text-right">Semanas de Gestación:</label>
            <div class="col-sm-4">
                {!!Form::number('gestation_week',null,['class'=>'form-control', 'step' => '1', 'min' => 0, 'placeholder' => 'Semanas'])!!}
            </div>
            <div class="col-sm-2">Semanas</div>
        </div>
        <div class="form-group row">
            <label for="pregestational_weight" class="col-sm-4 col-form-label text-right">Peso pregestacional:</label>
            <div class="col-sm-4">
                {!!Form::number('pregestational_weight',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'peso pregestacional'])!!}
            </div>
            <div class="col-sm-2">Kgrs</div>
        </div>
        <div class="form-group row">
            <label for="PeIMCpgEG" class="col-sm-4 col-form-label text-right">PeIMCpgEG:</label>
            <div class="col-sm-4">
                {!!Form::number('PeIMCpgEG',null,['class'=>'form-control-plaintext', 'readonly' => 'readonly', 'step' => '0.01', 'min' => 0, 'placeholder' => 'PeIMCpgEG'])!!}
            </div>
            <div class="col-sm-2">Kgrs</div>
        </div>
        <div class="form-group row">
            <label for="%PeIMCpgEg" class="col-sm-4 col-form-label text-right">%PeIMCpgEg:</label>
            <div class="col-sm-4">
                {!!Form::number('%PeIMCpgEg',null,['class'=>'form-control-plaintext', 'readonly' => 'readonly', 'step' => '0.01', 'min' => 0, 'placeholder' => '%PeIMCpgEg'])!!}
            </div>
            <div class="col-sm-2">%</div>
        </div>
    </div>
    <br>
    <div class="form-group row">
        <div class="col-sm-6 offset-md-4">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('anthropometry.index', $patient->slug) }}" class="btn btn-danger">Cancelar</a>
        </div>
    </div>
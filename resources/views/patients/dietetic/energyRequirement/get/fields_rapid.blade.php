<div class="row mt-4 mb-5">
    <div class="col-md-12">
            <a href="{{ route('dietetic.energyRequirementEdit', $patient->slug) }}" class="btn btn-success right mb-6">Cambiar Requerimiento</a>
    </div>
</div>
<div class="row mt-5">
    <div class="col-md-5">
        <div class="form-group row">
            <label for="patient" class="col-sm-4 col-form-label text-right">Paciente:</label>
            <div class="col-sm-6">
                <input type="text" readonly class="form-control-plaintext" id="patient" value="{{ $patient->name }}">
                <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                <input type="hidden" name="energy_requirement_id" value="{{ $energy_requirement->id }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="patient" class="col-sm-4 col-form-label text-right">Kcal:</label>
            <div class="col-sm-6">
                {!!Form::number('kcal', null, ['class' => 'form-control', 'min' => 0, 'step' => 0.1]) !!}
            </div>
        </div>
        <div class="form-group row">
            <label for="patient" class="col-sm-4 col-form-label text-right">Get:</label>
            <div class="col-sm-6">
                {!!Form::number('get', null, ['class' => 'form-control-plaintext', 'readonly'  => 'readonly']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label for="patient" class="col-sm-4 col-form-label text-right">Suplementos:</label>
            <div class="col-sm-1">
                <label class="check ">
                    {!! Form::checkbox('supplement',1) !!}
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="col-sm-5">
                @if(isset($total_energy_expenditure) && $total_energy_expenditure->supplement_value != null)
                {!!Form::number('supplement_value', null, ['class' => 'form-control', 'id' => 'supplement_value', 'min' => 0, 'step' => 0.1, 'placeholder'=>'kcal']) !!}
                @else
                {!!Form::number('supplement_value', null, ['class' => 'form-control', 'id' => 'supplement_value', 'disabled' => 'disabled', 'min' => 0, 'step' => 0.1, 'placeholder'=>'kcal']) !!}
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="patient" class="col-sm-4 col-form-label text-right">Seleccione Metodo de Requerimiento Hidrico:</label>
            <div class="form-check mt-2 col-sm-4 pl-0">
                <label class="customradio mr-1 pl-4"><span class="radiotextsty">Edad/ml/kg</span>
                {!! Form::radio('method_water_requirement', '1', ['checked' => true]) !!}
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
        </div>
        <div class="form-group row" id="requirement_h_ml_kcal" @if(isset($total_energy_expenditure) && $total_energy_expenditure->method_water_requirement == 2) style="display:flex" @else style="display:none" @endif>
                <label for="patient" class="col-sm-4 col-form-label text-right">Ingrese ml/kcal:</label>
            <div class="col-sm-4">
                {!!Form::number('water_requirement_ml_kcal', null, ['class' => 'form-control', 'id' => '', 'min' => 0, 'step' => 0.1]) !!}
            </div>
        </div>
        <div class="form-group row" id="requirement_h_manual" @if(isset($total_energy_expenditure) && $total_energy_expenditure->method_water_requirement == 3) style="display:flex" @else style="display:none" @endif>
                <label for="patient" class="col-sm-4 col-form-label text-right">Ingrese Requerimiento Hidrico:</label>
            <div class="col-sm-4">
                {!!Form::number('water_requirement_manual', null, ['class' => 'form-control', 'id' => '', 'min' => 0, 'step' => 0.1]) !!}
            </div>
        </div>
        <div class="form-group row">
            <label for="patient" class="col-sm-4 col-form-label text-right">Requerimiento Hidrico:</label>
            <div class="col-sm-3 mt-4">
                {{--{!!Form::number('water_requirement', null, ['class' => 'form-control-plaintext', 'id' => 'supplement_value', 'min' => 0, 'step' => 0.1, 'readonly' => true]) !!}--}}
                @if(isset($total_energy_expenditure->water_requirement))
                    <span>{{ $total_energy_expenditure->water_requirement }}</span>
                @endif
            </div>
            @if(isset($total_energy_expenditure->water_requirement))
            <div class="col-sm-1 mt-4">
                ML
            </div>
            @endif
        </div>
    </div>
    <div class="col-md-7">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Macronutrientes</th>
                        <th>%</th>
                        <th>kcal/kg/día</th>
                        <th>gr</th>
                        <th>gr/kg</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Carbohidratos</td>
                        <td>
                            {!! Form::number('percentage_carbohydrates', null, ['class'   => 'form-control', 'step'   => '0.1', 'required'    => true]) !!}
                        </td>
                        <td>
                            @if(isset($carboHidrates))
                                {{ $carboHidrates }}
                            @endif
                        </td>
                        <td>
                            @if(isset($carboHidrates_gr))
                                {{ $carboHidrates_gr }}
                            @endif
                        </td>
                        <td>
                            {!! Form::number('gr_kg_carbohydrates', null, ['class'   => 'form-control', 'step'   => '0.1', 'required'    => false]) !!}
                        </td>
                    </tr>
                    <tr>
                        <td>Lipidos</td>
                        <td>
                            {!! Form::number('percentage_lipids', null, ['class'   => 'form-control', 'step'   => '0.1', 'required'    => true]) !!}
                        </td>
                        <td>
                            @if(isset($lipids))
                                {{ $lipids }}
                            @endif
                        </td>
                        <td>
                            @if(isset($lipids_gr))
                                {{ $lipids_gr }}
                            @endif
                        </td>
                        <td>
                            {!! Form::number('gr_kg_lipids', null, ['class'   => 'form-control', 'step'   => '0.1', 'required'    => false]) !!}
                        </td>
                    </tr>
                    <tr>
                        <td>Proteinas</td>
                        <td>
                            {!! Form::number('percentage_protein', null, ['class'   => 'form-control', 'step'   => '0.1', 'required'    => true]) !!}
                        </td>
                        <td>
                            @if(isset($protein))
                                {{ $protein }}
                            @endif
                        </td>
                        <td>
                            @if(isset($protein_gr))
                                {{ $protein_gr }}
                            @endif
                        </td>
                        <td>
                            {!! Form::number('gr_kg_proteins', null, ['class'   => 'form-control', 'step'   => '0.1', 'required'    => true]) !!}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        @if(isset($macro_chart))
        <div class="col-md-12">
            <div id="macro_chart"></div>
        </div>
        @endif
    </div>
    <div class="col-md-6 offset-md-4">
        <button class="btn btn-primary" type="submit">Generar</button>
        <a href="{{ route('dietetic.index', $patient->slug) }}" class="btn btn-danger">Cancelar</a>
    </div>
</div>
<div class="row mt-4 mb-5">
    <div class="col-md-12">
            <a href="{{ route('dietetic.energyRequirementEdit', $patient->slug) }}" class="btn btn-success right mb-6">Cambiar Requerimiento</a>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label for="patient" class="col-sm-4 col-form-label text-right">Paciente:</label>
            <div class="col-sm-6">
                <input type="text" readonly class="form-control-plaintext" id="patient" value="{{ $patient->name }}">
                <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                <input type="hidden" name="energy_requirement_id" value="{{ $energy_requirement->id }}">
            </div>
        </div>
        {{-- Peso a seleccionar --}}
        <div class="form-group row">
            <label for="patient" class="col-sm-4 col-form-label text-right">Selecciona el Peso con el que desea trabajar:</label>
            <div class="form-check form-check-inline mt-2 col-sm-7 pl-0">
                <label class="customradio mr-1 pl-4" data-toggle="tooltip" data-placement="left" title="Peso actual"><span class="radiotextsty">P.A</span>
                    {!! Form::radio('weight_type', '1', ['checked' => true]) !!}
                    <span class="checkmark mt-1"></span>
                </label>
                <label class="customradio mr-1 ml-2 pl-4" data-toggle="tooltip" data-placement="left" title="Peso ideal"><span class="radiotextsty">P.I</span>
                    {!! Form::radio('weight_type', '2') !!}
                    <span class="checkmark mt-1"></span>
                </label>
                <label class="customradio mr-1 ml-2 pl-4" data-toggle="tooltip" data-placement="left" title="Peso corregido para obesidad"><span class="radiotextsty">P.C.O</span>
                    {!! Form::radio('weight_type', '3') !!}
                    <span class="checkmark mt-1"></span>
                </label>
            </div>
        </div>

        {{-- Formula a seleccionar --}}
        <div class="form-group row">
            <label for="patient" class="col-sm-4 col-form-label text-right">Selecciona la formula con el que desea trabajar:</label>
            <div class="form-check form-check-inline mt-2 col-sm-7 pl-0">
                <label class="customradio mr-1 pl-4" data-toggle="tooltip" data-placement="left" title="Harris - Benedict"><span class="radiotextsty">H-B</span>
                    {!! Form::radio('formula', '1', ['checked' => true]) !!}
                    <span class="checkmark mt-1"></span>
                </label>
                <label class="customradio mr-1 ml-2 pl-4" data-toggle="tooltip" data-placement="left" title="Mifflin-St Jeor"><span class="radiotextsty">MF Y ST.J.</span>
                    {!! Form::radio('formula', '2') !!}
                    <span class="checkmark mt-1"></span>
                </label>
                <label class="customradio ml-1 pl-4" data-toggle="tooltip" data-placement="left" title="FAO/OMS"><span class="radiotextsty">FAO/OMS</span>
                    {!! Form::radio('formula', '3') !!}
                    <span class="checkmark mt-1"></span>
                </label>
            </div>
        </div>
        {{-- Efecto Termico de Alimentos ETA --}}
        <div class="form-group row">
            <label for="patient" class="col-sm-4 col-form-label text-right">Agregar ETA:</label>
            <div class="col-sm-1 mt-2">
                <label class="check "><span class="radiotextsty"></span>
                    {!! Form::checkbox('thermic_effect',1) !!}
                    <span class="checkmark"></span>
                </label>
            </div>
        </div>
        {{--Factor de estres --}}
        <div class="form-group row">
            <label for="patient" class="col-sm-4 col-form-label text-right">Seleccione para agregar factor de estres o MET'S:</label>
            <div class="form-check form-check-inline mt-2 col-sm-6 pl-0">
                <label class="customradio mr-1 pl-4"><span class="radiotextsty">Fact. Estres</span>
                    {!! Form::radio('stress_factor', '1', ['checked' => true]) !!}
                    <span class="checkmark mt-1"></span>
                </label>
                <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">METs</span>
                    {!! Form::radio('stress_factor', '2') !!}
                    <span class="checkmark mt-1"></span>
                </label>
            </div>
        </div>
        {{-- Opciones de factor de estress--}}
        @if(!isset($total_energy_expenditure))
        <div class="form-group row" id="content-estress-factor-mets">
            <label for="patient" class="col-sm-4 col-form-label text-right"></label>
            <div class="form-check form-check-inline mt-2 col-sm-8 pl-0 mr-0" id="box_stress_factor">
                <div class="card bg-light" style="width:100%;">
                    <div class="card-header text-muted border-bottom-0">
                        <h3 class="card-title">Factor de Estres</h3>
                    </div>
                    <div class="card-body pl-0 pr-0">
                       <table class="table">
                           <thead>
                               <tr>
                                   <th style="width:40%;">
                                        <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Actividad Fisica</span>
                                            {!! Form::radio('stress_factor_type', '1', ['checked' => true]) !!}
                                            <span class="checkmark mt-1"></span>
                                        </label>
                                   </th>
                                   <th style="width:0%;">
                                        <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Estres Metabolico</span>
                                            {!! Form::radio('stress_factor_type', '2') !!}
                                            <span class="checkmark mt-1"></span>
                                        </label>
                                   </th>
                               </tr>
                           </thead>
                           <tbody>
                                <tr>
                                    <td>
                                        <div class="form-group" id="fisic_activity_items" style="display:block;">
                                            <div class="form-check p-0">
                                                <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Sedentario 1</span>
                                                    {!! Form::radio('fisic_activity', '1') !!}
                                                    <span class="checkmark mt-1"></span>
                                                </label>
                                            </div>
                                            <div class="form-check p-0">
                                                <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Poco Activo 1.14</span>
                                                    {!! Form::radio('fisic_activity', '2') !!}
                                                    <span class="checkmark mt-1"></span>
                                                </label>
                                            </div>
                                            <div class="form-check p-0">
                                                <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Activo 1.27</span>
                                                    {!! Form::radio('fisic_activity', '3') !!}
                                                    <span class="checkmark mt-1"></span>
                                                </label>
                                            </div>
                                            <div class="form-check p-0">
                                                <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Muy Activo 1.45</span>
                                                    {!! Form::radio('fisic_activity', '4') !!}
                                                    <span class="checkmark mt-1"></span>
                                                </label>
                                            </div>
                                            <div class="form-check p-0">
                                                <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Factor Añadido</span>
                                                    {!! Form::radio('fisic_activity', '5') !!}
                                                    <span class="checkmark mt-1"></span>
                                                </label>
                                            </div>
                                                    
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group" id="methabolic_stress_items">
                                            <div class="form-check p-0">
                                                <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Posoperatorio con complicaciones 1.05 - 1.15</span>
                                                    {!! Form::radio('methabolic_stress', '1') !!}
                                                    <span class="checkmark mt-1"></span>
                                                </label>
                                            </div>
                                            <div class="form-check p-0">
                                                <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Quemaduras mayores 1.8 - 1.14</span>
                                                    {!! Form::radio('methabolic_stress', '2') !!}
                                                    <span class="checkmark mt-1"></span>
                                                </label>
                                            </div>
                                            <div class="form-check p-0">
                                                <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Septicemia 1.2 - 1.4</span>
                                                    {!! Form::radio('methabolic_stress', '3') !!}
                                                    <span class="checkmark mt-1"></span>
                                                </label>
                                            </div>
                                            <div class="form-check p-0">
                                                <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Sindrome de reacción inflamatorio sistem</span>
                                                    {!! Form::radio('methabolic_stress', '4') !!}
                                                    <span class="checkmark mt-1"></span>
                                                </label>
                                            </div>
                                            <div class="form-check p-0">
                                                <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Sindrome de realimentación</span>
                                                    {!! Form::radio('methabolic_stress', '5') !!}
                                                    <span class="checkmark mt-1"></span>
                                                </label>
                                            </div>
                                            <div class="form-check p-0">
                                                <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Traumatismo múltiple</span>
                                                    {!! Form::radio('methabolic_stress', '5') !!}
                                                    <span class="checkmark mt-1"></span>
                                                </label>
                                            </div>
                                            <div class="form-check p-0">
                                                <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Úlceras por decúbito</span>
                                                    {!! Form::radio('methabolic_stress', '5') !!}
                                                    <span class="checkmark mt-1"></span>
                                                </label>
                                            </div>
                                            <div class="form-check p-0">
                                                <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Etapa I</span>
                                                    {!! Form::radio('methabolic_stress', '5') !!}
                                                    <span class="checkmark mt-1"></span>
                                                </label>
                                            </div>
                                            <div class="form-check p-0">
                                                 <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Etapa II 1.3 - 1.4</span>
                                                    {!! Form::radio('methabolic_stress', '5') !!}
                                                    <span class="checkmark mt-1"></span>
                                                </label>
                                            </div>
                                            <div class="form-check p-0">
                                                <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Etapa III 1.5 - 1.</span>
                                                    {!! Form::radio('methabolic_stress', '5') !!}
                                                    <span class="checkmark mt-1"></span>
                                                </label>
                                            </div>
                                            <div class="form-check p-0">
                                                <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Etapa IV</span>
                                                    {!! Form::radio('methabolic_stress', '5') !!}
                                                    <span class="checkmark mt-1"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                           </tbody>
                       </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
           
        </div>
        @else
            @if($total_energy_expenditure->stress_factor == 1)
            <div class="form-group row" id="content-estress-factor-mets">
                <label for="patient" class="col-sm-4 col-form-label text-right"></label>
                <div class="form-check form-check-inline mt-2 col-sm-8 pl-0 mr-0" id="box_stress_factor">
                    <div class="card bg-light" style="width:100%;">
                        <div class="card-header text-muted border-bottom-0">
                            <h3 class="card-title">Factor de Estres</h3>
                        </div>
                        <div class="card-body pl-0 pr-0">
                           <table class="table">
                               <thead>
                                   <tr>
                                       <th style="width:40%;">
                                            <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Actividad Fisica</span>
                                                {!! Form::radio('stress_factor_type', '1', ['checked' => true]) !!}
                                                <span class="checkmark mt-1"></span>
                                            </label>
                                       </th>
                                       <th style="width:0%;">
                                            <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Estres Metabolico</span>
                                                {!! Form::radio('stress_factor_type', '2') !!}
                                                <span class="checkmark mt-1"></span>
                                            </label>
                                       </th>
                                   </tr>
                               </thead>
                               <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-group" id="fisic_activity_items" style="display:block;">
                                                <div class="form-check p-0">
                                                    <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Sedentario 1</span>
                                                        {!! Form::radio('fisic_activity', '1') !!}
                                                        <span class="checkmark mt-1"></span>
                                                    </label>
                                                </div>
                                                <div class="form-check p-0">
                                                    <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Poco Activo 1.14</span>
                                                        {!! Form::radio('fisic_activity', '2') !!}
                                                        <span class="checkmark mt-1"></span>
                                                    </label>
                                                </div>
                                                <div class="form-check p-0">
                                                    <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Activo 1.27</span>
                                                        {!! Form::radio('fisic_activity', '3') !!}
                                                        <span class="checkmark mt-1"></span>
                                                    </label>
                                                </div>
                                                <div class="form-check p-0">
                                                    <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Muy Activo 1.45</span>
                                                        {!! Form::radio('fisic_activity', '4') !!}
                                                        <span class="checkmark mt-1"></span>
                                                    </label>
                                                </div>
                                                <div class="form-check p-0">
                                                    <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Factor Añadido</span>
                                                        {!! Form::radio('fisic_activity', '5') !!}
                                                        <span class="checkmark mt-1"></span>
                                                    </label>
                                                </div>
                                                        
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group" id="methabolic_stress_items">
                                                <div class="form-check p-0">
                                                    <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Posoperatorio con complicaciones 1.05 - 1.15</span>
                                                        {!! Form::radio('methabolic_stress', '1') !!}
                                                        <span class="checkmark mt-1"></span>
                                                    </label>
                                                </div>
                                                <div class="form-check p-0">
                                                    <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Quemaduras mayores 1.8 - 1.14</span>
                                                        {!! Form::radio('methabolic_stress', '2') !!}
                                                        <span class="checkmark mt-1"></span>
                                                    </label>
                                                </div>
                                                <div class="form-check p-0">
                                                    <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Septicemia 1.2 - 1.4</span>
                                                        {!! Form::radio('methabolic_stress', '3') !!}
                                                        <span class="checkmark mt-1"></span>
                                                    </label>
                                                </div>
                                                <div class="form-check p-0">
                                                    <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Sindrome de reacción inflamatorio sistem</span>
                                                        {!! Form::radio('methabolic_stress', '4') !!}
                                                        <span class="checkmark mt-1"></span>
                                                    </label>
                                                </div>
                                                <div class="form-check p-0">
                                                    <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Sindrome de realimentación</span>
                                                        {!! Form::radio('methabolic_stress', '5') !!}
                                                        <span class="checkmark mt-1"></span>
                                                    </label>
                                                </div>
                                                <div class="form-check p-0">
                                                    <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Traumatismo múltiple</span>
                                                        {!! Form::radio('methabolic_stress', '5') !!}
                                                        <span class="checkmark mt-1"></span>
                                                    </label>
                                                </div>
                                                <div class="form-check p-0">
                                                    <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Úlceras por decúbito</span>
                                                        {!! Form::radio('methabolic_stress', '5') !!}
                                                        <span class="checkmark mt-1"></span>
                                                    </label>
                                                </div>
                                                <div class="form-check p-0">
                                                    <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Etapa I</span>
                                                        {!! Form::radio('methabolic_stress', '5') !!}
                                                        <span class="checkmark mt-1"></span>
                                                    </label>
                                                </div>
                                                <div class="form-check p-0">
                                                     <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Etapa II 1.3 - 1.4</span>
                                                        {!! Form::radio('methabolic_stress', '5') !!}
                                                        <span class="checkmark mt-1"></span>
                                                    </label>
                                                </div>
                                                <div class="form-check p-0">
                                                    <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Etapa III 1.5 - 1.</span>
                                                        {!! Form::radio('methabolic_stress', '5') !!}
                                                        <span class="checkmark mt-1"></span>
                                                    </label>
                                                </div>
                                                <div class="form-check p-0">
                                                    <label class="customradio mr-1 ml-1 pl-4"><span class="radiotextsty">Etapa IV</span>
                                                        {!! Form::radio('methabolic_stress', '5') !!}
                                                        <span class="checkmark mt-1"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                               </tbody>
                           </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            @else
            <div class="form-group row" id="content-estress-factor-mets">
                <label for="patient" class="col-sm-4 col-form-label text-right"></label>
                <div class="form-check form-check-inline mt-2 col-sm-8 pl-0 mr-0">
                    <div class="card bg-light" style="width:100%;">
                        <div class="card-header text-muted border-bottom-0">
                            <h3 class="card-title">MET's</h3>
                        </div>
                        <div class="card-body pl-0 pr-0">
                            <div class="col-sm-8">
                                <input class="form-control" id="search_mets" type="text">
                            </div>
                        <table class="table table-responsive" id="table-mets">
                            <thead>
                                <tr>
                                    <th style="width:50%;">
                                            Categoría
                                    </th>
                                    <th style="width:50%;">
                                            Actividad
                                    </th>
                                    <th>Tiempo (hrs/min)</th>
                                    <th>MET's</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $total_energy_expenditure->Met->categoria }}</td>
                                    <td>
                                        {{ $total_energy_expenditure->Met->actividad }}
                                        {!! Form::hidden('met_id', null) !!}
                                    </td>
                                    <td>
                                            {!! Form::number('activity_time', null, ['step'=>'1',  'min'=>'0', 'class'=>'form-control']) !!}
                                    </td>
                                    <td>
                                        {!! Form::text('met', null, ['class'=>'form-control-plaintext']) !!}
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-danger btn-delete-item-food mt-2">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @endif
      
        {{-- Suplementos --}}
        <div class="form-group row">
            <label for="patient" class="col-sm-4 col-form-label text-right">Suplementos:</label>
            <div class="col-sm-1 mt-2">
                <label class="check ">
                    {!! Form::checkbox('supplement',1) !!}
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="col-sm-5">
                @if(isset($total_energy_expenditure) && $total_energy_expenditure->supplement_value != null)
                {!!Form::number('supplement_value', null, ['class' => 'form-control', 'id' => 'supplement_value', 'min' => 0, 'step' => 0.1]) !!}
                @else
                {!!Form::number('supplement_value', null, ['class' => 'form-control', 'id' => 'supplement_value', 'disabled' => 'disabled', 'min' => 0, 'step' => 0.1]) !!}
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="patient" class="col-sm-4 col-form-label text-right">Seleccione Metodo de Requerimiento Hidrico:</label>
            <div class="form-check form-check-inline mt-2 col-sm-4 pl-0">
                <label class="customradio mr-1 pl-4"><span class="radiotextsty">Edad/ml/kg</span>
                {!! Form::radio('method_water_requirement', '1', ['checked' => true]) !!}
                <span class="checkmark mt-1"></span>
                </label>
                <label class="customradio mr-1 pl-4"><span class="radiotextsty">ml/kcal</span>
                {!! Form::radio('method_water_requirement', '2') !!}
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
    <div class="col-md-6">
        <div class="col-md-12">
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>MacroNutrientes</th>
                        <th>%</th>
                        <th>Kcal</th>
                        <th>Gr</th>
                        <th>Gr/Kg</th>
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
                            {!! Form::number('gr_kg_proteins', null, ['class'   => 'form-control', 'step'   => '0.1', 'required'  => true]) !!}
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
                </tbody>
            </table>
        </div>
        @if(isset($macro_chart))
        <div class="col-md-12">
            <div id="macro_chart"></div>
        </div>
        @endif
    </div>
    <div class="col-md-6 offset-md-5">
        <button type="button" class="btn btn-warning" id="clear-radio">Limpiar Selección</button>
    </div>
    <div class="col-md-6 offset-md-5 mt-4">
        <button class="btn btn-primary" type="submit">Generar</button>
        <a href="{{ route('dietetic.index', $patient->slug) }}" class="btn btn-danger">Cancelar</a>
    </div>
</div>
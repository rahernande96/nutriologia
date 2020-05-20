<div class="row">
        <div class="col-md-3">
            <h6>Fechas</h6>
            <div class="input-daterange input-group" id="datepicker">
                    <input type="text" class="input-sm form-control" name="start_date" required/>
                    <span class="input-group-addon">a</span>
                    <input type="text" class="input-sm form-control" name="end_date" required/>
                </div>
            <hr>
            <h6>Dias a la semana</h6>
            <div class="content-days-food">
                <div class="form-check form-check-inline custom-checkbox">
                    <input class="custom-control-input food-check check-day" name="days[]" type="checkbox" id="inlineCheckbox1" value="1">
                    <label class="custom-control-label label-food-time" for="inlineCheckbox1">Lunes</label>
                </div>
                <div class="form-check form-check-inline custom-checkbox">
                    <input class="custom-control-input food-check check-day" name="days[]" type="checkbox" id="inlineCheckbox2" value="2">
                    <label class="custom-control-label label-food-time" for="inlineCheckbox2">Martes</label>
                </div>
                <div class="form-check form-check-inline custom-checkbox">
                    <input class="custom-control-input food-check check-day" name="days[]" type="checkbox" id="inlineCheckbox3" value="3">
                    <label class="custom-control-label label-food-time" for="inlineCheckbox3">Miercoles</label>
                </div>
                <div class="form-check form-check-inline custom-checkbox">
                    <input class="custom-control-input food-check check-day" name="days[]" type="checkbox" id="inlineCheckbox4" value="4">
                    <label class="custom-control-label label-food-time" for="inlineCheckbox4">Jueves</label>
                </div>
                <div class="form-check form-check-inline custom-checkbox">
                    <input class="custom-control-input food-check check-day" name="days[]" type="checkbox" id="inlineCheckbox5" value="5">
                    <label class="custom-control-label label-food-time" for="inlineCheckbox5">Viernes</label>
                </div>
                <div class="form-check form-check-inline custom-checkbox">
                    <input class="custom-control-input food-check check-day" name="days[]" type="checkbox" id="inlineCheckbox6" value="6">
                    <label class="custom-control-label label-food-time" for="inlineCheckbox6">Sabado</label>
                </div>
                <div class="form-check form-check-inline custom-checkbox">
                    <input class="custom-control-input food-check check-day" name="days[]" type="checkbox" id="inlineCheckbox7" value="7">
                    <label class="custom-control-label label-food-time" for="inlineCheckbox7">Domingo</label>
                </div>
            </div>
            <hr>
            <h6>Grupos de Alimentos</h6>
            <div class="content-days-food">
                @foreach($food_groups as $food_group)
                <div class="form-check form-check-inline custom-checkbox">
                    <input class="custom-control-input food-check" name="food_group[]" type="checkbox" id="food_group{{ $food_group->id }}" value="{{ $food_group->id }}">
                    <label class="custom-control-label label-food-time" for="food_group{{ $food_group->id }}">{{ $food_group->name }}</label>
                </div>
                @endforeach
            </div>
            <hr>
            <h6>Tiempos de comida</h6>
            <div class="content-food-times">
                    <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                    <input type="hidden" name="history_id" value="{{ $history->id }}">
                    @foreach($food_times as $food_time)
                        <div class="custom-control custom-checkbox pb-2">
                            <input type="checkbox" class="custom-control-input food-check" name="food_time[]" value="{{ $food_time->id }}" id="{{ $food_time->id }}-rapid" data-id="{{ $food_time->id }}" data-name="{{ $food_time->name }}">
                            <label class="custom-control-label label-food-time" for="{{ $food_time->id }}-rapid">{{ $food_time->name }}</label>
                        </div>
                    @endforeach
                    {{--<button type="button" class="btn btn-info" onclick="showEquivalentFoodTime()">Generar</button>--}}
            </div> 
            <hr>
            <h6>Opciones</h6>
            <div class="custom-control custom-checkbox">
                <label class="customradio mr-1 pl-4"><span class="radiotextsty">Usar los mismos equivalentes para todos los dias</span>
                    {!! Form::radio('option', '1', ['checked' => true]) !!}
                    <span class="checkmark mt-1"></span>
                </label>
                <label class="customradio mr-1 pl-4"><span class="radiotextsty">Intercalar equivalentes de dos días</span>
                    {!! Form::radio('option', '2') !!}
                    <span class="checkmark mt-1"></span>
                </label>
            </div>
            <br>
            <button type="button" class="btn btn-info" onclick="showEquivalentFoodTime()">Generar</button>  
            <br>                                                   
            <button type="button" id="btn-new-time-food" class="btn btn-link"><i class="fas fa-plus-square"></i> Agregar comida</button>
            <div class="new-time-food"></div>
        </div>
        <div class="col-md-9 border-l-light">
            <div class="table-responsive" id="content-table-equivalent-distribution">
                
            </div>
        </div>
        <div class="col-md-12 text-center"id="group-button-fields" style="display:none;">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a class="btn btn-danger" href="{{ route('dietetic.index', ['slug'=>$patient->slug,'history_id'=>$history->id]) }}">Cancelar</a>
        </div>
    </div>
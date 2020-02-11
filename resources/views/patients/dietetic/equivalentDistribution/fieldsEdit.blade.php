<div class="row">
        <div class="col-md-3">
            <h6 style="color:#007bff!important">Fechas</h6>
            <div class="input-daterange input-group" id="datepicker">
                <input type="hidden" name="equivalent_distribution_id" value="{{ $equivalentDistribution->id }}">
                    <input type="text" class="input-sm form-control" name="start_date" value="{{ $equivalentDistribution->start_date }}"/>
                    <span class="input-group-addon">a</span>
                    <input type="text" class="input-sm form-control" name="end_date" value="{{ $equivalentDistribution->end_date }}"/>
                </div>
            <hr>
            <h6 style="color:#007bff!important">Dias a la semana</h6>
            <div class="content-days-food">
                <div class="form-check form-check-inline custom-checkbox">
                    <input class="custom-control-input food-check check-day" name="days[]" type="checkbox" id="inlineCheckbox1" value="1" @if(in_array('1', $equivalentDistribution->days)) checked @endif>
                    <label class="custom-control-label label-food-time" for="inlineCheckbox1">Lunes</label>
                </div>
                <div class="form-check form-check-inline custom-checkbox">
                    <input class="custom-control-input food-check check-day" name="days[]" type="checkbox" id="inlineCheckbox2" value="2" @if(in_array('2', $equivalentDistribution->days)) checked @endif>
                    <label class="custom-control-label label-food-time" for="inlineCheckbox2">Martes</label>
                </div>
                <div class="form-check form-check-inline custom-checkbox">
                    <input class="custom-control-input food-check check-day" name="days[]" type="checkbox" id="inlineCheckbox3" value="3" @if(in_array('3', $equivalentDistribution->days)) checked @endif>
                    <label class="custom-control-label label-food-time" for="inlineCheckbox3">Miercoles</label>
                </div>
                <div class="form-check form-check-inline custom-checkbox">
                    <input class="custom-control-input food-check check-day" name="days[]" type="checkbox" id="inlineCheckbox4" value="4" @if(in_array('4', $equivalentDistribution->days)) checked @endif>
                    <label class="custom-control-label label-food-time" for="inlineCheckbox4">Jueves</label>
                </div>
                <div class="form-check form-check-inline custom-checkbox">
                    <input class="custom-control-input food-check check-day" name="days[]" type="checkbox" id="inlineCheckbox5" value="5" @if(in_array('5', $equivalentDistribution->days)) checked @endif>
                    <label class="custom-control-label label-food-time" for="inlineCheckbox5">Viernes</label>
                </div>
                <div class="form-check form-check-inline custom-checkbox">
                    <input class="custom-control-input food-check check-day" name="days[]" type="checkbox" id="inlineCheckbox6" value="6" @if(in_array('6', $equivalentDistribution->days)) checked @endif>
                    <label class="custom-control-label label-food-time" for="inlineCheckbox6">Sabado</label>
                </div>
                <div class="form-check form-check-inline custom-checkbox">
                    <input class="custom-control-input food-check check-day" name="days[]" type="checkbox" id="inlineCheckbox7" value="7" @if(in_array('7', $equivalentDistribution->days)) checked @endif>
                    <label class="custom-control-label label-food-time" for="inlineCheckbox7">Domingo</label>
                </div>
            </div>
            <hr>
            <h6 style="color:#007bff!important">Grupos de Alimentos</h6>
            <div class="content-days-food">
                @foreach($food_groups as $food_group)
                <div class="form-check form-check-inline custom-checkbox">
                    <input class="custom-control-input food-check" name="food_group[]" type="checkbox" id="food_group{{ $food_group->id }}" value="{{ $food_group->id }}" @if(in_array($food_group->id, $equivalentDistribution->food_groups)) checked @endif>
                    <label class="custom-control-label label-food-time" for="food_group{{ $food_group->id }}">{{ $food_group->name }}</label>
                </div>
                @endforeach
            </div>
            <hr>
            <h6 style="color:#007bff!important">Tiempos de comida</h6>
            <div class="content-food-times">
                    <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                    @foreach($food_times as $food_time)
                        <div class="custom-control custom-checkbox pb-2">
                            <input type="checkbox" class="custom-control-input food-check" name="food_time[]" value="{{ $food_time->id }}" id="{{ $food_time->id }}-rapid" data-id="{{ $food_time->id }}" data-name="{{ $food_time->name }}" @if(in_array($food_time->id, $equivalentDistribution->food_times)) checked @endif>
                            <label class="custom-control-label label-food-time" for="{{ $food_time->id }}-rapid">{{ $food_time->name }}</label>
                        </div>
                    @endforeach
                    {{--<button type="button" class="btn btn-info" onclick="showEquivalentFoodTime()">Generar</button>--}}
            </div> 
            <hr>
            <h6 style="color:#007bff!important">Opciones</h6>
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
                @if(isset($equivalentDistribution))
                <table class="table table-bordered equivalent-distribution" style="width:100%;">
                    <thead>
                        <tr class="bg-primary">
                            <th scope="col" rowspan="2" colspan="2" class="middle">Equivalentes</th>
                            @foreach($equivalentDistribution->days as $day)
                            <th scope="col" colspan="{{ count($equivalentDistribution->food_times) }}">
                                @switch($day)
                                    @case(1)
                                        Lunes
                                        @break
                                
                                    @case(2)
                                        Martes
                                        @break
                                    
                                    @case(3)
                                        Miercoles
                                        @break

                                    @case(4)
                                        Jueves
                                        @break

                                    @case(5)
                                        Viernes
                                        @break

                                    @case(6)
                                        Sabado
                                        @break

                                    @case(7)
                                        Domingo
                                        @break
                                @endswitch
                            </th>
                            <th scope="col" rowspan="2" class="middle">Equivalentes restantes</th>
                            @endforeach
                        </tr>
                        <tr class="bg-primary">
                            @foreach($equivalentDistribution->days as $day)
                                @foreach($equivalentDistribution->food_times as $ft)
                                    @foreach($food_times as $food_time)
                                        @if($ft == $food_time->id)
                                            <th>{{ $food_time->name }}</th>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($food_groups as $food_group)
                            @if(in_array($food_group->id, $equivalentDistribution->food_groups))
                                @foreach($details as $detail)
                                    @if($detail['food_group_id'] == $food_group->id)
                                    <tr>
                                        <td>
                                            <div class="col-sm-12 pt-2">
                                                {{ $food_group->name }}
                                            </div>
                                            <div class="col-sm-12 pt-2">
                                                <button class="btn btn-danger btn-xs btn-delete-equivalent" data-toogle="tooltips" title="eliminar" data-food="{{ $food_group->id }}"> <i class="fa fa-trash"></i></button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-12 pt-2">
                                                <input type="number" class="form-control" step="0.1" name="field[{{ $food_group->id }}][equivalent_food_group]" value="{{ $detail->fields['equivalent_food_group'] }}">
                                                </div>
                                                <div class="col-sm-12 pt-2">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-default btn-xs mr-1 plus-equivalent"><i class="fa fa-plus"></i></button>
                                                        <button type="button" class="btn btn-default btn-xs minus-equivalent"><i class="fa fa-minus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        {{--@foreach($equivalentDistribution->days as $day)
                                            @foreach($equivalentDistribution->food_times as $ft)
                                            <td>
                                            <input class="form-control" name="field[{{ $food_group->id }}][{{ $day }}][{{ $ft }}][equivalent]" type="number" min="0" step="1" value="{{ $detail->fields[$day][$ft]['equivalent'] }}">
                                            </td>
                                            @endforeach
                                            <td>
                                                <input type="number" name = "field[{{ $food_group->id }}][{{ $day }}][missing_equivalent]" class="form-control" min="0" step="1" value="{{ $detail->fields[$day]['missing_equivalent'] }}">
                                            </td>
                                        @endforeach--}}
                                        @foreach($equivalentDistribution->days as $day)
                                            @foreach($equivalentDistribution->food_times as $ft)
                                            <td data-day="{{ $day }}">
                                                <input class="form-control" name="field[{{ $food_group->id }}][{{ $day }}][{{ $ft }}][equivalent]" type="number" min="0" step="0.1" value="{{ $detail->fields[$day][$ft]['equivalent'] }}">
                                            </td>
                                            @endforeach
                                            <td data-day="{{ $day }}">
                                                <input type="number" name = "field[{{ $food_group->id }}][{{ $day }}][missing_equivalent]" class="form-control" min="0" step="0.1" value="{{ $detail->fields[$day]['missing_equivalent'] }}">
                                            </td>
                                        @endforeach
                                    </tr>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
        <div class="col-md-12 text-center"id="group-button-fields">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a class="btn btn-danger" href="{{ route('dietetic.index', $patient->slug) }}">Cancelar</a>
        </div>
    </div>
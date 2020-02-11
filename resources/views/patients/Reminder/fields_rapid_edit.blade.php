<div class="row">
    <div class="col-md-3">
        <h6>Por tiempo de comida (rápido)</h6>
        <div class="content-food-times-rapid"> 
            <input type="hidden" name="type" value="{{ \App\Reminder::RAPID }}">
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
            @foreach($food_times as $food_time)
            <div class="custom-control custom-checkbox pb-2">
                <input type="checkbox" class="custom-control-input food-check-rapid" name="food_time[]" value="{{ $food_time->id }}" id="{{ $food_time->id }}-rapid" data-id="{{ $food_time->id }}" data-name="{{ $food_time->name }}" @foreach($reminder->reminderItem as $rI) @if($food_time->id == $rI->food_time_id) checked @endif @endforeach>
                <label class="custom-control-label label-food-time" for="{{ $food_time->id }}-rapid">{{ $food_time->name }}</label>
                <div class="content-fields">
                    @foreach($reminder->reminderItem as $rI) 
                        @if($food_time->id == $rI->food_time_id)
                            <div class="form-row">
                                <label for="inputEmail3" class="col-sm-5 control-label">Hora:</label>
                                <div class="col-sm-7">
                                    <input type="text" name="food_hour[]" class="form-control timepicker" id="inputEmail3" placeholder="Hora" value="{{ $rI->food_hour }}" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <label for="inputEmail3" class="col-sm-5 control-label">Lugar:</label>
                                <div class="col-sm-7">
                                    <input type="text" name="food_site[]" class="form-control" id="inputEmail3" placeholder="Lugar" value="{{ $rI->food_site }}" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <label for="inputEmail3" class="col-sm-5 control-label">Quien prepara:</label>
                                <div class="col-sm-7">
                                    <input type="text" name="food_who[]" class="form-control" id="inputEmail3" placeholder="Quien prepara?" value="{{ $rI->food_who }}" required>
                                </div>
                            </div> 
                        @endif 
                    @endforeach 
                </div>
            </div>
            @endforeach
        </div>                                                    
        <button type="button" id="btn-new-time-food-rapid" class="btn btn-link"><i class="fas fa-plus-square"></i> Agregar comida</button>
        <div class="new-time-food-rapid"></div>
    </div>
    <div class="col-md-4 border-l-light">
         @foreach($food_group as $fg)
            <input type="hidden" name="group_id[]" value="{{ $fg->id }}">
        @endforeach
        <div class="content-group-rapid" data-id="{{ $food_time->id }}">
            @foreach($reminder->reminderItem as $rI)
                @foreach($food_times as $food_time)
                    @if($rI->food_time_id == $food_time->id)
                        <div class="content-food" data-id="{{ $food_time->id }}">
                            <div class="form-row bg-light-blue ml-1">
                                    <div class="col-12">
                                        <label class="form-label mb-0 pt-1 white" for=""><b>{{ $food_time->name }}</b></label>
                                    </div>
                            </div>
                            <div class="border-light-blue ml-1 food-list" style="width:100%">
                                @foreach($food_group as $fg)
                                    <div class="form-row pl-1 mt-2">
                                        <div class="col-sm-4">
                                        <input type="number" step="0.5" min="0" name="field[{{ $food_time->id }}][{{ $fg->id }}][quantity][]" class="form-control" @foreach($rI->reminderFood as $rF)@if($rF->group_id == $fg->id && $rI->id == $rF->reminder_item_id) value="{{ $rF->quantity }}" @endif @endforeach>
                                        </div>
                                        <label for="inputEmail3" class="col-sm-5 control-label pt-2">
                                            {{ $fg->name }}
                                        </label>
                                    
                                        <div class="col-sm-3 pt-2">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default btn-xs mr-1 plus-equivalent"><i class="fa fa-plus"></i></button>
                                                <button type="button" class="btn btn-default btn-xs minus-equivalent"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div><br>
                    @endif
                @endforeach
            @endforeach
        </div>
    </div>
    <div class="col-md-5">
        @if(isset($reminder))
        <div class="content-chart">
            <div class="col-12">
                @foreach($reminder->reminderItem as $item)
                <button @if($item->food_time_id == $reminder_item->foodTime->id) class="btn btn-success btn-sm btn-foodtime-chart active" @else class="btn btn-primary btn-sm btn-foodtime-chart" @endif data-patientid="{{ $patient->id }}" data-reminderid = "{{ $reminder->id }}" data-foodtime="{{ $item->foodTime->id }}">{{ $item->foodTime->name }}</button>
                @endforeach
                <button class="btn btn-primary btn-sm btn-foodtime-chart" data-patientid="{{ $patient->id }}" data-reminderid = "{{ $reminder->id }}" data-foodtime="0">24hrs</button>
            </div>
            
            <div class="col-12 mb-2 mt-4 text-center">
                    {{ $Kcal_total }} <b>Kcals</b>
                    <br>
            </div>
            <div class="col-12 hidden">
                    <div class="content-chart-reminder pt-1 pb-2 hidden">
                            <div id="chart_reminder_macro" style="width:100%;"></div>
                    </div>
            </div>
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr class="table-primary">
                            <th scope="col"></th>
                            <th scope="col">Kcal</th>
                            <th scope="col">%</th>
                            <th scope="col">Gramos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($table_chart as $tc)
                        <tr>
                        <td>{{ $tc['name'] }}</td>
                        <td>{{ $tc['kcal'] }}</td>
                        <td>
                            @if($Kcal_total != 0 || $Kcal_total != null)
                            {{ number_format(($tc['kcal']/$Kcal_total)*100, 2, ',', ' ') }}
                            @else
                                0
                            @endif
                        </td>
                        <td>{{ $tc['gramos'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
    <div class="col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</div>
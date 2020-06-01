<div class="row">
    <div class="col-md-12">
        <h6>Por tiempo de comida (detallado)</h6>
        <div class="content-food-times-detail"> 
            <input type="hidden" name="type" value="{{ \App\Reminder::DETAIL }}">
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
            @foreach($food_times as $food_time)
            <div class="custom-control custom-checkbox pb-2">
                <input type="checkbox" class="custom-control-input food-check-detail" name="food_time[]" value="{{ $food_time->id }}" id="{{ $food_time->id }}" data-name="{{ $food_time->name }}" @foreach($reminder->reminderItem as $rI) @if($food_time->id == $rI->food_time_id) checked @endif @endforeach>
                <label class="custom-control-label label-food-time" for="{{ $food_time->id }}">{{ $food_time->name }}</label>
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
        
        <button type="button" id="btn-new-time-food-detail" class="btn btn-link"><i class="fas fa-plus-square"></i> Agregar comida</button>
        <div class="new-time-food-detail"></div>
    </div>
    <div  class="col-md-12 border-l-light">
        <div style="height: 600px;overflow: auto;" class="content-food-details">
                <div class="form-row pl-1 mt-2">
                    <div class="col-sm-12">
                        <input type="text" id="search-food-detail" class="form-control search-food-detail" placeholder="Busque un alimento">
                    </div>
                </div>
                <br>
                @foreach($reminder->reminderItem as $rI) 
                <div class="content-food" data-id="{{ $rI->food_time_id }}">
                    <div class="form-row bg-light-blue ml-1">
                        <div class="col-5">
                            <label class="form-label mb-0 pt-1 white" for=""><b>Alimento</b></label>
                        </div>
                        <div class="col-6">
                            <label class="form-label mb-0 pt-1 white" for=""><b>Cantidad</b></label>
                        </div>
                        <div class="col-1">
                            <input type="checkbox" value="{{ $rI->food_time_id }}" class="form-check-input content-food-checkbox">
                        </div>
                    </div>
                    <div class="border-light-blue ml-1 food-list" style="width:100%">
                      
                            @foreach($rI->reminderFood as $rF)
                                <div class="form-row" style="margin-bottom:10px">
                                    <div class="col-4">
                                        <fieldset disabled>
                                            <input type="text" class="form-control" placeholder="Alimento" value="{{ $rF->food->name }}">
                                        </fieldset>
                                        <input name="field[{{ $rI->food_time_id }}][food][]" type="hidden" value="{{ $rF->food_id }}">
                                    </div>
                                    <div class="col-3">
                                        <input type="number" step="0.5" min="0" class="form-control" name="field[{{ $rI->food_time_id }}][cantidad][]" placeholder="Cantidad" value="{{ $rF->quantity }}" required="required">
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check-inline mt-2">
                                            <label class="customradio mr-1 pl-4"><span class="radiotextsty">gr</span>
                                            <input type="radio" checked="checked" name="field[{{ $rI->food_time_id }}][{{ $rF->food_id }}][unity][]" value="1" @if($rF->unity == 1) checked @endif>
                                            <span class="checkmark mt-1"></span>
                                            </label>
                                            <label class="customradio mr-1 pl-4"><span class="radiotextsty">eq</span>
                                            <input type="radio" name="field[{{ $rI->food_time_id }}][{{ $rF->food_id }}][unity][]" value="2" @if($rF->unity == 2) checked @endif>
                                            <span class="checkmark mt-1"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-2 center">
                                        <button class="btn btn-sm btn-outline-danger btn-delete-item-food mt-2">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                       
                    </div>
                </div><br>
                @endforeach
        </div>
        <button type="button" id="btn-new-food" class="btn btn-link" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-plus-square"></i> Agregar alimento</button>
    </div>
    <div class="col-md-12">
        <div class="content-chart-reminder pt-1 pb-2 hidden">
                <div id="chart_reminder_macro" style="width:100%;"></div>
        </div>
    </div>
    <div class="col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</div>
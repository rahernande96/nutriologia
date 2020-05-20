<div class="row">
    <div class="col-md-3">
        <h6>Por tiempo de comida (rápido)</h6>
        <div class="content-food-times-rapid">
            <input type="hidden" name="type" value="{{ \App\Reminder::RAPID }}">
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
            @foreach($food_times as $food_time)
                <div class="custom-control custom-checkbox pb-2">
                    <input type="checkbox" class="custom-control-input food-check-rapid" name="food_time[]" value="{{ $food_time->id }}" id="{{ $food_time->id }}-rapid" data-id="{{ $food_time->id }}" data-name="{{ $food_time->name }}">
                    <label class="custom-control-label label-food-time" for="{{ $food_time->id }}-rapid">{{ $food_time->name }}</label>
                    <div class="content-fields"></div>
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
        <div class="content-group-rapid">

        </div>
    </div>
    <div class="col-md-5">
    </div>
    <div class="col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <h6>Por tiempo de comida (detallado)</h6>
        <div class="content-food-times-detail"> 
            <input type="hidden" name="type" value="{{ \App\Reminder::DETAIL }}">
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
            @foreach($food_times as $food_time)
            <div class="custom-control custom-checkbox pb-2">
                <input type="checkbox" class="custom-control-input food-check-detail" name="food_time[]" value="{{ $food_time->id }}" id="{{ $food_time->id }}-detail" data-id="{{ $food_time->id }}" data-name="{{ $food_time->name }}">
                <label class="custom-control-label label-food-time" for="{{ $food_time->id }}-detail">{{ $food_time->name }}</label>
                <div class="content-fields"></div>
            </div>
            @endforeach
        </div>
        
        <button type="button" id="btn-new-time-food-detail" class="btn btn-link"><i class="fas fa-plus-square"></i> Agregar comida</button>
        <div class="new-time-food-detail"></div>
    </div>
    <div class="col-md-5 border-l-light">
        <div class="content-food-details">
                <div class="form-row pl-1 mt-2">
                    <div class="col-sm-12">
                        <input type="text" id="search-food-detail" class="form-control search-food-detail" placeholder="Busque un alimento">
                    </div>
                </div>
                <br>
            {{--<div class="content-1">
                <div class="form-row pl-1 mt-2">
                    <div class="col-sm-12">
                        <input type="text" id="search-food-detail" class="form-control search-food-detail" placeholder="Busque un alimento">
                    </div>
                </div>
                <br>
                <div class="form-row bg-light-blue ml-1">
                    <div class="col-5">
                        <label class="form-label mb-0 pt-1 white" for=""><b>Alimento</b></label>
                    </div>
                    <div class="col-7">
                        <label class="form-label mb-0 pt-1 white" for=""><b>Cantidad</b></label>
                    </div>
                </div>
                <div id="content-foods-detail" class="border-light-blue ml-1" style="width:100%"></div>
            </div>--}}
        </div>
        <button type="button" id="btn-new-food" class="btn btn-link" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-plus-square"></i> Agregar alimento</button>
    </div>
    <div class="col-md-4">

    </div>
    <div class="col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</div>
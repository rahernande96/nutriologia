<div class="row">
    <div class="col-md-3">
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
        </div> 
        <br>
        <button type="button" class="btn btn-info" onclick="showEquivalentFoodTime()">Generar</button>  
        <br>                                                   
        <button type="button" id="btn-new-time-food" class="btn btn-link"><i class="fas fa-plus-square"></i> Agregar comida</button>
        <div class="new-time-food"></div>
    </div>
    <div class="col-md-9 border-l-light">
        
        <div class="table-responsive mt-4" id="content-table-equivalent-distribution">
            <table class="table table-bordered" id="content-days">
                <thead>
                    <tr>
                        <th>
                            <div class="row">
                                    <div class="col-md-10">
                                            <input class="form-control" name="name" type="text" placeholder="Nombe de la dietoterapia">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-md btn-info" data-toggle="modal" data-target="#newDishModal" rel="tooltip" title="nuevo platillo"><i class="fas fa-utensils"></i></button>
                                        <a href="{{ route('menu.search', ['slug'=>$patient->slug,'history_id'=>$history->id]) }}" class="btn btn-md btn-info" title="buscar platillo"><i class="fas fa-search" style="color:#FFF"></i></a>
                                    </div>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <div class="btn-group">
                <button type="button" class="btn btn-primary mr-1" data-toggle="modal" data-target="#exampleModal">Copiar Dietoterapia</button>
                <button type="submit" class="btn btn-primary">Guardar Dietoterapia</button>
            </div>
        </div>
    </div>
    {{--<div class="col-md-12 text-center"id="group-button-fields" style="display:none;">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a class="btn btn-danger" href="{{ route('dietetic.index', $patient->slug) }}">Cancelar</a>
    </div>--}}
</div>
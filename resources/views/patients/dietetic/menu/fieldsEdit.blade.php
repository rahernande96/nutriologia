<div class="row">
    <div class="col-md-3">
        <h6>Dias a la semana</h6>
        <div class="content-days-food">
            <div class="form-check form-check-inline custom-checkbox">
                <input class="custom-control-input food-check check-day" name="days[]" type="checkbox" id="inlineCheckbox1" value="1" @if(in_array(1, $menu->days)) checked @endif>
                <label class="custom-control-label label-food-time" for="inlineCheckbox1">Lunes</label>
            </div>
            <div class="form-check form-check-inline custom-checkbox">
                <input class="custom-control-input food-check check-day" name="days[]" type="checkbox" id="inlineCheckbox2" value="2" @if(in_array(2, $menu->days)) checked @endif>
                <label class="custom-control-label label-food-time" for="inlineCheckbox2">Martes</label>
            </div>
            <div class="form-check form-check-inline custom-checkbox">
                <input class="custom-control-input food-check check-day" name="days[]" type="checkbox" id="inlineCheckbox3" value="3" @if(in_array(3, $menu->days)) checked @endif>
                <label class="custom-control-label label-food-time" for="inlineCheckbox3">Miercoles</label>
            </div>
            <div class="form-check form-check-inline custom-checkbox">
                <input class="custom-control-input food-check check-day" name="days[]" type="checkbox" id="inlineCheckbox4" value="4" @if(in_array(4, $menu->days)) checked @endif>
                <label class="custom-control-label label-food-time" for="inlineCheckbox4">Jueves</label>
            </div>
            <div class="form-check form-check-inline custom-checkbox">
                <input class="custom-control-input food-check check-day" name="days[]" type="checkbox" id="inlineCheckbox5" value="5" @if(in_array(5, $menu->days)) checked @endif>
                <label class="custom-control-label label-food-time" for="inlineCheckbox5">Viernes</label>
            </div>
            <div class="form-check form-check-inline custom-checkbox">
                <input class="custom-control-input food-check check-day" name="days[]" type="checkbox" id="inlineCheckbox6" value="6" @if(in_array(6, $menu->days)) checked @endif>
                <label class="custom-control-label label-food-time" for="inlineCheckbox6">Sabado</label>
            </div>
            <div class="form-check form-check-inline custom-checkbox">
                <input class="custom-control-input food-check check-day" name="days[]" type="checkbox" id="inlineCheckbox7" value="7" @if(in_array(7, $menu->days)) checked @endif>
                <label class="custom-control-label label-food-time" for="inlineCheckbox7">Domingo</label>
            </div>
        </div>
        <hr>
        <h6>Tiempos de comida</h6>
        <div class="content-food-times">
            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
            @foreach($food_times as $food_time)
                <div class="custom-control custom-checkbox pb-2">
                    <input type="checkbox" class="custom-control-input food-check" name="food_time[]" value="{{ $food_time->id }}" id="{{ $food_time->id }}-rapid" data-id="{{ $food_time->id }}" data-name="{{ $food_time->name }}" @if(in_array($food_time->id, $menu->food_times)) checked @endif>
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
                                    <div class="col-md-9">
                                            <input class="form-control" name="name" type="text" placeholder="Nombe de la dietoterapia" value="{{ $menu->name }}">
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-md btn-info" data-toggle="modal" data-target="#newDishModal" rel="tooltip" title="nuevo platillo"><i class="fas fa-utensils"></i></button>
                                        <a href="{{ route('menu.search', $patient->slug) }}" class="btn btn-md btn-info" title="buscar platillo"><i class="fas fa-search" style="color:#FFF"></i></a>
                                        <div class="btn-group">
                                                <button type="button" class="btn btn-info btn-md btn-outline-primary dropdown-toggle dropdown-toggle-ellipsis" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a href="{{  url('/patient/menu/delete', [$menu->id]) }}" data-confirm="Desea eliminar el menu?" class="btn drodpdown-item" data-method="delete">Eliminar</a>
                                                </div>
                                              </div>
                                    </div>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($menu->days as $day)
                        @switch($day)
                            @case('1')
                                {{ $name = 'Lunes' }}
                                @break

                            @case('2')
                                {{ $name = 'Martes' }}
                                @break
                            
                            @case('3')
                                {{ $name = 'Miercoles' }}
                                @break

                            @case('4')
                                {{ $name = 'Jueves' }}
                                @break

                            @case('5')
                                {{ $name = 'Viernes' }}
                                @break

                            @case('6')
                                {{ $name = 'Sabado' }}
                                @break

                            @case('7')
                                {{ $name = 'Domingo' }}
                                @break
                        @endswitch
                    <tr class="content_{{ $day }}">
                        <td colspan="1">
                            <div class="card card-day mt-3" data-id="{{ $day }}">
                                    <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#{{ $day }}" area-expanded="true">{{ $name }}</button>
                                    <div id="{{ $day }}" class="collapse pt-4 pb-4 pr-2 pl-4 collapse show">
                                        <div class="card">
                                            <div class="card-header d-flex p-0">
                                                <h5 class="card-title p-3">Tiempos de Comida</h5>
                                                <ul class="nav nav-pills ml-auto p-2">
                                                    @foreach($menu->food_times as $food_time)
                                                        @foreach($food_times as $ft)
                                                            @if($food_time == $ft->id)
                                                                <li class="nav-item" id="item_{{ $day }}_{{ $food_time }}"><a class="nav-link @if($loop->first) active @endif" href="#day_{{ $day }}_food_time_{{ $food_time }}" data-toggle="tab">{{ $ft->name }}</a></li>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </ul>
                                            </div><!-- /.card-header -->
                                            <div class="card-body">
                                                <div class="tab-content">
                                                    @foreach($menu->food_times as $food_time)
                                                    <div class="tab-pane @if($loop->first) active @endif" id="day_{{ $day }}_food_time_{{ $food_time }}">
                                                        <div class="row">
                                                            <div class="col-md-11" data-day="{{ $day }}" data-foodtime="{{ $food_time }}">
                                                                <input class="form-control search_ingredient" type="text" placeholder="Busque ingrediente o receta">
                                                            </div>
                                                            <div class="col-md-12 mt-4">
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-center">Imagen</th>
                                                                            <th class="text-center">Nombre</th>
                                                                            <th class="text-center">Kcal</th>
                                                                            <th class="text-center">Acción</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="item-content">
                                                                        @foreach($menu->details as $detail)
                                                                            @if($detail->day == $day && $detail->food_time_id == $food_time)
                                                                            <tr>
                                                                                <input type="hidden" name="dishes[{{ $day }}][{{ $food_time }}][dish][]" value="{{ $detail->dish->id }}"/>
                                                                                <td class="text-center"><img width="40px" src="@if($detail->dish->image != null){{ asset('storage/dishes/'.$detail->dish->image) }}@else {{ asset('images/platillo.png') }} @endif"></td>
                                                                                <td class="text-center">{{ $detail->dish->name }}</td>
                                                                                <td class="text-center">{{ $detail->dish->kcal }}</td>
                                                                                <td class="text-center">
                                                                                    <button type="button" class="btn btn-sm btn-danger btn-delete-item"><i class="fa fa-trash"></i></button>
                                                                                </td>
                                                                            </tr>
                                                                            @endif
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div><!-- /.tab-content -->
                                            </div><!-- /.card-body -->
                                        </div>
                                    </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <div class="btn-group">
                    {{--<button type="button" class="btn btn-primary mr-1">Copiar Dietoterapia</button>--}}
                    <button type="submit" class="btn btn-primary mr-3">Guardar Dietoterapia</button>
                    <a class="btn btn-danger" href="{{ route('dietetic.index', $patient->slug) }}">Cancelar</a>
            </div>
        </div>
    </div>
    {{--<div class="col-md-12 text-center"id="group-button-fields" style="display:none;">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a class="btn btn-danger" href="{{ route('dietetic.index', $patient->slug) }}">Cancelar</a>
    </div>--}}
</div>
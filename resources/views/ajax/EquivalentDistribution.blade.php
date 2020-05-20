<table class="table table-bordered equivalent-distribution" style="width:100%;">
                    <thead>
                        <tr class="bg-primary">
                            <th scope="col" rowspan="2" colspan="2" class="middle">Equivalentes</th>
                            @foreach($params['days'] as $day)
                            <th scope="col" colspan="{{ count($params['food_time']) }}">
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
                            @foreach($params['days'] as $day)
                                @foreach($params['food_time'] as $ft)
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
                        @if(in_array($food_group->id, $params['food_group']))
                        <tr>
                            <td>
                                    <div class="col-sm-12 pt-2">
                                            {{ $food_group->name }}
                                        </div>
                                        <div class="col-sm-12 pt-2">
                                        <button class="btn btn-danger btn-xs btn-delete-equivalent" data-toogle="tooltips" title="eliminar" data-food="{{ $food_group->id }}" > <i class="fa fa-trash"></i></button>
                                        </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-sm-6 pt-2">
                                        <input type="number" class="form-control" step="0.1" name="field[{{ $food_group->id }}][equivalent_food_group]">
                                    </div>
                                    <div class="col-sm-12 pt-2">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-xs mr-1 plus-equivalent"><i class="fa fa-plus"></i></button>
                                            <button type="button" class="btn btn-default btn-xs minus-equivalent"><i class="fa fa-minus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            @foreach($params['days'] as $day)
                                @foreach($params['food_time'] as $ft)
                                <td data-day="{{ $day }}">
                                    <input class="form-control" name="field[{{ $food_group->id }}][{{ $day }}][{{ $ft }}][equivalent]" type="number" min="0" step="0.1">
                                </td>
                                @endforeach
                                <td data-day="{{ $day }}">
                                    <input type="number" name = "field[{{ $food_group->id }}][{{ $day }}][missing_equivalent]" class="form-control" min="0" step="0.1">
                                </td>
                            @endforeach
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
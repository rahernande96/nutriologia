      <div id="exampleModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <form action="{{ route('menu.copy') }}" method="post">
                    @csrf
                    <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Copiar Menú</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">

                                <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th class="text-center">Imagen</th>
                                                <th class="text-center">Paciente</th>
                                                <th class="text-center">Kcal</th>
                                                <th class="text-center">Macros</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($menus as $menu)
                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                            <input type="radio" class="form-control" name="menu_id" required value="{{ $menu->id }}">
                                                    </div>
                                                </td>
                                                <td class="text-center"><img width="45px" src="{{ asset('images/'.$menu->patient->picture) }}" alt=""></td>
                                                <td class="text-center" style="vertical-align:middle;">{{ $menu->patient->name }}</td>
                                                <td class="text-center"></td>
                                                <td class="text-center"></td>
                                                <td class="text-center"><a target="_blank" href="{{ route('dietetic.menu', $menu->patient->slug) }}" class="btn btn-primary">Ver dietoterapia</a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table> 
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" onclick="validate()">Copiar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
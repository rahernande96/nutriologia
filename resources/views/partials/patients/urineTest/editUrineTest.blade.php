<div class="col-md-12 mt-4">
    <div class="accordion">
        <div class="card card-primary">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-11 d-flex align-items-center">
                        <h3 class="card-title">Exámen General de Orina (EGO)</h3>
                    </div>
                    <div class="col-md-1" class="d-flex justify-content-center">
                        <button class="btn btn-link text-white btn-block" type="button" data-toggle="collapse" data-target="#UrineTest" aria-expanded="true" aria-controls="UrineTest">
                            <i class="fa fa-plus fa-md"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div id="UrineTest" class="collapse" aria-labelledby="UrineTest" data-parent="#UrineTest">
                <div class="card-body">
                    <form action="{{ route('urineTest.update', $patient->slug) }}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="pH">pH</label>
                                <input type="number" class="form-control" id="pH" placeholder="pH" value="{{ $patient->UrineTest->pH }}" name="pH" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top" data-title="4.6 a 8">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="protein">Proteína</label>
                                <input type="number" id="protein" class="form-control" placeholder="Proteína" value="{{ $patient->UrineTest->protein }}" name="protein" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="Negativo">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="specific_gravity">Gravedad Específica</label>
                                <input type="number" class="form-control" id="specific_gravity" placeholder="Gravedad Específica" value="{{ $patient->UrineTest->specific_gravity }}" name="specific_gravity" data-trigger="focus" data-toggle="tooltip"
                                    data-container="body" data-placement="top" data-title="1.005 a 1.030">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="glucose">Glucosa</label>
                                <input type="number" class="form-control" id="glucose" placeholder="Glucosa" value="{{ $patient->UrineTest->glucose }}" name="glucose" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="Negativa">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="whites_cells">Células blancas</label>
                                <input type="number" class="form-control" id="whites_cells" placeholder="Células blancas" value="{{ $patient->UrineTest->whites_cells }}" name="whites_cells" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                    data-placement="top" data-title="20 a 40 g/d">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="erythrocytes">Eritrocitos</label>
                                <input type="number" class="form-control" id="erythrocytes" placeholder="Eritrocitos" value="{{ $patient->UrineTest->erythrocytes }}" name="erythrocytes" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                    data-placement="top" data-title="40 a 220 meq/L/d">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <button type="submit" class="btn btn-success btn-block">
                                    Actualizar Datos
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

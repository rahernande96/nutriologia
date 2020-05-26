<div class="col-md-12 mt-4">
    <div class="accordion">
        <div class="card card-primary accordion">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-11 d-flex align-items-center">
                        <h3 class="card-title">Química Sanguinea</h3>
                    </div>
                    <div class="col-md-1" class="d-flex justify-content-center">
                        <button class="btn btn-link text-white btn-block collapsed" type="button" data-toggle="collapse" data-target="#BloodChemistry" aria-expanded="true" aria-controls="BloodChemistry">
                            <i class="fa fa-plus fa-md"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div id="BloodChemistry" class="collapse" aria-labelledby="BloodChemistry" data-parent="#BloodChemistry">
                <div class="card-body">
                    <form action="{{ route('bloodChemistry.update', $patient->slug) }}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="glucose">Glucosa en ayuno</label>
                                <input type="number" class="form-control" id="glucose" placeholder="Glucosa en ayuno Glucosa a 2 h PP" value="{{ $patient->BloodChemistry->glucose }}" name="glucose" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                    data-placement="top" data-title="70 a 100 mg/dl< 140 mg/dl">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="glucose_pp">Glucosa en ayuno a 2h PP</label>
                                <input type="number" class="form-control" id="glucose_pp" placeholder="Glucosa en ayuno Glucosa a 2 h PP" value="{{ $patient->BloodChemistry->glucose_pp }}" name="glucose_pp" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                    data-placement="top" data-title="70 a 100 mg/dl< 140 mg/dl">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="proteins">Proteinas Totales</label>
                                <input type="number" id="proteins" class="form-control" placeholder="Proteinas Totales" value="{{ $patient->BloodChemistry->proteins }}" name="proteins" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                    data-placement="top" data-title="6.4 a 8.3 mg/dl">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="albumin">Albúmina Sérica</label>
                                <input type="number" class="form-control" id="albumin" placeholder="Albúmina Sérica" value="{{ $patient->BloodChemistry->albumin }}" name="albumin" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="3.5 a 5.0 g/dl">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="transferrin">Transferina Sérica</label>
                                <input type="number" class="form-control" id="transferrin" placeholder="Transferina Sérica" value="{{ $patient->BloodChemistry->transferrin }}" name="transferrin" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                    data-placement="top" data-title="200 a 400 mg/dl">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="prealbumin">Prealbúmina</label>
                                <input type="number" class="form-control" id="prealbumin" placeholder="Prealbúmina" value="{{ $patient->BloodChemistry->prealbumin }}" name="prealbumin" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                    data-placement="top" data-title="10 a 40 mg/dl">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="globulin">Globulina</label>
                                <input type="number" class="form-control" id="globulin" placeholder="Globulina" value="{{ $patient->BloodChemistry->globulin }}" name="globulin" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="2 a 3.5 g/dl">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="reason_alb">Razón alb./glob.</label>
                                <input type="number" min="0" step="0.1" class="form-control" id="reason_alb" placeholder="Razón alb./glob." value="{{ $patient->BloodChemistry->reason_alb }}" name="reason_alb" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                    data-placement="top" data-title="1.5:1 a 2.5:1">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="BUN">BUN</label>
                                <input type="number" class="form-control" id="BUN" placeholder="BUN" value="{{ $patient->BloodChemistry->BUN }}" name="BUN" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="8 a 22 mg/dl">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="creatinine">Creatinina</label>
                                <input type="number" class="form-control" id="creatinine" placeholder="Creatinina" value="{{ $patient->BloodChemistry->creatinine }}" name="creatinine" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                    data-placement="top" data-title="0.5 a 1.2 mg/dl">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="uric_acid">Ácido Úrico</label>
                                <input type="number" class="form-control" id="uric_acid" placeholder="Ácido Úrico" value="{{ $patient->BloodChemistry->uric_acid }}" name="uric_acid" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                    data-placement="top" data-title="< 6 mujeres < 8 hombres">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="total_ammonium">Amonio Total</label>
                                <input type="number" class="form-control" id="total_ammonium" placeholder="Amonio Total" value="{{ $patient->BloodChemistry->total_ammonium }}" name="total_ammonium" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                    data-placement="top" data-title="10 a 70 μg/dl en suero(60-100 μg /dl en sangre tot.)">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="Ca">Calcio</label>
                                <input type="number" class="form-control" id="Ca" placeholder="Calcio" value="{{ $patient->BloodChemistry->Ca }}" name="Ca" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="9 a 10 mg/dl">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="Na">Sodio</label>
                                <input type="number" class="form-control" id="Na" placeholder="Sodio" value="{{ $patient->BloodChemistry->Na }}" name="Na" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="135 a 145 mg/dl">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="Ka">Potasio</label>
                                <input type="number" class="form-control" id="Ka" placeholder="Potasio" value="{{ $patient->BloodChemistry->Ka }}" name="Ka" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="3.5 a 5 meq/dl">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="P">Fosforo</label>
                                <input type="number" class="form-control" id="P" placeholder="Fosforo" value="{{ $patient->BloodChemistry->P }}" name="P" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="2.2 a 4.3 meq/L">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="Cl">Cloro</label>
                                <input type="number" class="form-control" id="Cl" placeholder="Cloro" value="{{ $patient->BloodChemistry->Cl }}" name="Cl" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="98 a 2.8 meq/L">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="Mg">Magnesio</label>
                                <input type="number" class="form-control" id="Mg" placeholder="Magnesio" value="{{ $patient->BloodChemistry->Mg }}" name="Mg" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="1.7 a 2.8 meq/L">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="CO2">Dioxido de Carbono</label>
                                <input type="number" class="form-control" id="CO2" placeholder="Dioxido de Carbono" value="{{ $patient->BloodChemistry->CO2 }}" name="CO2" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="23 a 30 meq/L">
                            </div>
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

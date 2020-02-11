<div class="col-md-12 mt-4">
    <div class="accordion">
        <div class="card card-primary">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-11 d-flex align-items-center">
                        <h3 class="card-title">Orina de 24 Horas</h3>
                    </div>
                    <div class="col-md-1" class="d-flex justify-content-center">
                        <button class="btn btn-link text-white btn-block" type="button" data-toggle="collapse" data-target="#Urine" aria-expanded="true" aria-controls="Urine">
                            <i class="fa fa-plus fa-md"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div id="Urine" class="collapse" aria-labelledby="Urine" data-parent="#Urine">
                <div class="card-body">
                    <form action="{{ route('urine.update', $patient->slug) }}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="amylase">Amilasa</label>
                                <input type="number" class="form-control" id="amylase" placeholder="Amilasa" value="{{ $patient->Urine->amylase }}" name="amylase" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="6.5 a 48.1 U/h">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="creatinine">Creatinina</label>
                                <input type="number" id="creatinine" class="form-control" placeholder="Creatinina" value="{{ $patient->Urine->creatinine }}" name="creatinine" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="0.8 a 2g/d">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="urea">Urea</label>
                                <input type="number" class="form-control" id="urea" placeholder="Urea" value="{{ $patient->Urine->urea }}" name="urea" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="20 a 40 g/d">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="Ca">Calcio</label>
                                <input type="number" class="form-control" id="Ca" placeholder="Calcio" value="{{ $patient->Urine->Ca }}" name="Ca" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top" data-title="20 a 40 g/d">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="Na">Sodio</label>
                                <input type="number" class="form-control" id="Na" placeholder="Sodio" value="{{ $patient->Urine->Na }}" name="Na" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="40 a 220 meq/L/d">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="K">Potasio</label>
                                <input type="number" class="form-control" id="K" placeholder="Potasio" value="{{ $patient->Urine->K }}" name="K" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="25 a 100 meq/L/d">
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

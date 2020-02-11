<div class="col-md-12 mt-4">
    <div class="accordion">
        <div class="card card-primary">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-11 d-flex align-items-center">
                        <h3 class="card-title">Perfil de Lípidos</h3>
                    </div>
                    <div class="col-md-1" class="d-flex justify-content-center">
                        <button class="btn btn-link text-white btn-block" type="button" data-toggle="collapse" data-target="#LipidProfile" aria-expanded="true" aria-controls="LipidProfile">
                            <i class="fa fa-plus fa-md"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div id="LipidProfile" class="collapse show" aria-labelledby="LipidProfile" data-parent="#LipidProfile">
                <div class="card-body">
                    <form action="{{ route('lipidProfile.update', $patient->slug) }}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="total_cholesterol">Colesterol total</label>
                                <input type="number" class="form-control" id="total_cholesterol" placeholder="Colesterol total" value="{{ $patient->LipidProfile->total_cholesterol }}" name="total_cholesterol" data-trigger="focus" data-toggle="tooltip"
                                    data-container="body" data-placement="top" data-title="< 200 mg/dl">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="HDL_cholesterol">Colesterol HDL</label>
                                <input type="number" id="HDL_cholesterol" class="form-control" placeholder="Colesterol HDL" value="{{ $patient->LipidProfile->HDL_cholesterol }}" name="HDL_cholesterol" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                    data-placement="top" data-title="40 mg/dl ♂ >50 mg/dl ♀">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="LDL_cholesterol">Colesteroal LDL</label>
                                <input type="number" class="form-control" id="LDL_cholesterol" placeholder="Colesteroal LDL" value="{{ $patient->LipidProfile->LDL_cholesterol }}" name="LDL_cholesterol" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                    data-placement="top" data-title="< 100 mg/dl">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="triglycerides">Triglicéridos</label>
                                <input type="number" class="form-control" id="triglycerides" placeholder="Triglicéridos" value="{{ $patient->LipidProfile->triglycerides }}" name="triglycerides" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                    data-placement="top" data-title="40 a 160 mg/dl ♂ 35 a 135 mg/dl ♀">
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

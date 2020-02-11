<div class="col-md-12 mt-4">
    <div class="accordion">
        <div class="card card-primary">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-11 d-flex align-items-center">
                        <h3 class="card-title">Biometría Hemática</h3>
                    </div>
                    <div class="col-md-1" class="d-flex justify-content-center">
                        <button class="btn btn-link text-white btn-block collapsed" type="button" data-toggle="collapse" data-target="#HematicBiometry" aria-expanded="true" aria-controls="HematicBiometry">
                            <i class="fa fa-plus fa-md"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div id="HematicBiometry" class="collapse" aria-labelledby="HematicBiometry" data-parent="#HematicBiometry">
                <div class="card-body">
                    <form action="{{ route('hematicBiometry.update', $patient->slug) }}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="WBC">Células Blancas</label>
                                <input type="number" class="form-control" id="WBC" placeholder="Células Blancas" value="{{ $patient->HematicBiometry->WBC }}" name="WBC" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="5,000 a 10,000/mm³">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="RBC">Eritrocitos</label>
                                <input type="number" id="RBC" class="form-control" placeholder="Eritrocitos" value="{{ $patient->HematicBiometry->RBC }}" name="RBC" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="4.7 a 6.1 x 106/μg♂ 4.2 a 5.4 x 106μg ♀">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="HGB">Hemoglobina</label>
                                <input type="number" class="form-control" id="HGB" placeholder="Hemoglobina" value="{{ $patient->HematicBiometry->HGB }}" name="HGB" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="14 a 18 g/dl♂ 12 a 16 g/dl♀">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="HCT">Hematocrito</label>
                                <input type="number" class="form-control" id="HCT" placeholder="Hematocrito" value="{{ $patient->HematicBiometry->HCT }}" name="HCT" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="42 a 52%♂ 37 a 47 %♀">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="VCM">Volúmen Corporal Medio</label>
                                <input type="number" class="form-control" id="VCM" placeholder="Volúmen Corporal Medio" value="{{ $patient->HematicBiometry->VCM }}" name="VCM" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="82 a 98 fl">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="HCM">Hemoglobina Corporal Media</label>
                                <input type="number" class="form-control" id="HCM" placeholder="Hemoglobina Corporal Media" value="{{ $patient->HematicBiometry->HCM }}" name="HCM" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="27 a 33 pg">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="HCM_promedy">Hemoglobina Corporal Promedio</label>
                                <input type="number" class="form-control" id="HCM_promedy" placeholder="Hemoglobina Corporal Promedio" value="{{ $patient->HematicBiometry->HCM_promedy }}" name="HCM_promedy" data-trigger="focus" data-toggle="tooltip"
                                    data-container="body" data-placement="top" data-title="32 a 36 %">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="neutrophils">Neutrófilos</label>
                                <input type="number" class="form-control" id="neutrophils" placeholder="Neutrófilos" value="{{ $patient->HematicBiometry->neutrophils }}" name="neutrophils" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                    data-placement="top" data-title="55 a 70 %">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="lymphocytes">Linfocitos</label>
                                <input type="number" class="form-control" id="lymphocytes" placeholder="Linfocitos" value="{{ $patient->HematicBiometry->lymphocytes }}" name="lymphocytes" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                    data-placement="top" data-title="20 a 40 %">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="monocytes">Monocitos</label>
                                <input type="number" class="form-control" id="monocytes" placeholder="Monocitos" value="{{ $patient->HematicBiometry->monocytes }}" name="monocytes" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="2 a 8 %">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="eosinophils">Eosinófilos</label>
                                <input type="number" class="form-control" id="eosinophils" placeholder="Eosinófilos" value="{{ $patient->HematicBiometry->eosinophils }}" name="eosinophils" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                    data-placement="top" data-title="1 a 4 %">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="basophils">Basófilos</label>
                                <input type="number" class="form-control" id="basophils" placeholder="Basófilos" value="{{ $patient->HematicBiometry->basophils }}" name="basophils" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="0.5 a 1 %">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="PLT">Plaquetas</label>
                                <input type="number" class="form-control" id="PL" placeholder="Plaquetas" value="{{ $patient->HematicBiometry->PLT }}" name="PLT" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="150,000 a 400,000 por mm3">
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

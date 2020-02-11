<div class="col-md-12 mt-4">
    <div class="accordion">
        <div class="card card-primary">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-11 d-flex align-items-center">
                        <h3 class="card-title">Vitaminas y Minerales</h3>
                    </div>
                    <div class="col-md-1" class="d-flex justify-content-center">
                        <button class="btn btn-link text-white btn-block" type="button" data-toggle="collapse" data-target="#VitaminMineral" aria-expanded="true" aria-controls="VitaminMineral">
                            <i class="fa fa-plus fa-md"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div id="VitaminMineral" class="collapse" aria-labelledby="VitaminMineral" data-parent="#VitaminMineral">
                <div class="card-body">
                    <form action="{{ route('vitaminMineral.update', $patient->slug) }}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="thiamin">Tiamina sérica</label>
                                <input type="number" class="form-control" id="thiamin" placeholder="Tiamina sérica actividad de transcetolasa eritrocitaria" value="{{ $patient->VitaminMineral->thiamin }}" name="thiamin" data-trigger="focus" data-toggle="tooltip"
                                    data-container="body" data-placement="top" data-title="10 a 64 ng/ml Déficit > 20%">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="pyridoxine">Piridoxina</label>
                                <input type="number" id="pyridoxine" class="form-control" placeholder="Piridoxina" value="{{ $patient->VitaminMineral->pyridoxine }}" name="pyridoxine" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="5 a 64 ng/ml Déficit < 3 ng/ml">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="cobalamin">Cobalamina</label>
                                <input type="number" class="form-control" id="cobalamin" placeholder="Cobalamina" value="{{ $patient->VitaminMineral->cobalamin }}" name="cobalamin" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="200 - 1000pg/ml Déficit < 200pg/ml">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="B12">Vitamina B12 Homosisteína</label>
                                <input type="number" class="form-control" id="B12" placeholder="Vitamina B12 Homosisteína" value="{{ $patient->VitaminMineral->B12 }}" name="B12" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="210 a 911 pg/ml 4 a 12 μmol/L">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="folate">Foltato Eritrocitario</label>
                                <input type="number" class="form-control" id="folate" placeholder="Foltato Eritrocitario" value="{{ $patient->VitaminMineral->folate }}" name="folate" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="280 a 291 ng/ml Déficit < 227 nmol/L">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="iron">Hierro Sérico</label>
                                <input type="number" class="form-control" id="iron" placeholder="Hierro Sérico" value="{{ $patient->VitaminMineral->iron }}" name="iron" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="Varones 15 a 200 Mujeres 12 a 150 Déficit <50 μg/dl">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="ferritin">Ferritina</label>
                                <input type="number" class="form-control" id="ferritin" placeholder="Hierro Sérico" value="{{ $patient->VitaminMineral->ferritin }}" name="ferritin" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="Déficit < 20 ng/ml">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="vitamin_a">Vitamina A (retinol plasmático)</label>
                                <input type="number" class="form-control" id="vitamin_a" placeholder="Vitamina A (retinol plasmático)" value="{{ $patient->VitaminMineral->vitamin_a }}" name="vitamin_a" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                    data-placement="top" data-title="27 a 80 μg/dl">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="OH">25 (OH) D</label>
                                <input type="number" class="form-control" id="OH" placeholder="25 (OH) D" value="{{ $patient->VitaminMineral->OH }}" name="OH" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="25 a 40 ng/ml Déficit < 20 ng/ml">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="vitamin_e">Vitamina E (α-tocoferol plasmático)</label>
                                <input type="number" class="form-control" id="vitamin_e" placeholder="Vitamina E (α-tocoferol plasmático)" value="{{ $patient->VitaminMineral->vitamin_e }}" name="vitamin_e" data-trigger="focus" data-toggle="tooltip"
                                    data-container="body" data-placement="top" data-title="5 a 20 μg/dl Déficit <5 μg/dl">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="vitamin_k">Vitamina K (TP)</label>
                                <input type="number" class="form-control" id="vitamin_k" placeholder="Vitamina K (TP)" value="{{ $patient->VitaminMineral->vitamin_k }}" name="vitamin_k" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                    data-placement="top" data-title="10 a 13 segundos.">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="zinc">Zinc (en plasma)</label>
                                <input type="number" class="form-control" id="zinc" placeholder="Zinc (en plasma)" value="{{ $patient->VitaminMineral->zinc }}" name="zinc" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="1 a 4 %">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="selenium">Selenio</label>
                                <input type="number" class="form-control" id="selenium" placeholder="Selenio" value="{{ $patient->VitaminMineral->selenium }}" name="selenium" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="0.5 a 1 %">
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

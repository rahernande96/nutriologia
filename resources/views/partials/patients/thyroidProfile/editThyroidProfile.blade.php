<div class="col-md-12 mt-4">
    <div class="accordion">
        <div class="card card-primary">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-11 d-flex align-items-center">
                        <h3 class="card-title">Perfil Tiroideo</h3>
                    </div>
                    <div class="col-md-1" class="d-flex justify-content-center">
                        <button class="btn btn-link text-white btn-block" type="button" data-toggle="collapse" data-target="#ThyroidProfile" aria-expanded="true" aria-controls="ThyroidProfile">
                            <i class="fa fa-plus fa-md"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div id="ThyroidProfile" class="collapse" aria-labelledby="ThyroidProfile" data-parent="#ThyroidProfile">
                <div class="card-body">
                    <form action="{{ route('thyroidProfile.update', $patient->slug) }}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="T4">Tiroxina (T4)</label>
                                <input type="number" class="form-control" id="T4" placeholder="Tiroxina (T4)" value="{{ $patient->ThyroidProfile->T4 }}" name="T4" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="5 a 12 μg/dl">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="T4_free">T4 Libre</label>
                                <input type="number" id="T4_free" class="form-control" placeholder="T4 Libre" value="{{ $patient->ThyroidProfile->T4_free }}" name="T4_free" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="0.8 a 2.8 ng/dl">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="T3_total">Triyodotironina (T3 total)</label>
                                <input type="number" class="form-control" id="T3_total" placeholder="Triyodotironina (T3 total)" value="{{ $patient->ThyroidProfile->T3_total }}" name="T3_total" data-trigger="focus" data-toggle="tooltip" data-container="body"
                                    data-placement="top" data-title="< 100 mg/dl">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="TSH">TSH</label>
                                <input type="number" class="form-control" id="TSH" placeholder="TSH" value="{{ $patient->ThyroidProfile->TSH }}" name="TSH" data-trigger="focus" data-toggle="tooltip" data-container="body" data-placement="top"
                                    data-title="40 a 160 mg/dl ♂ 35 a 135 mg/dl ♀">
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

<div class="form-group row">
    <label for="size" class="col-sm-4 col-form-label text-right">Bícep:</label>
    <div class="col-sm-2">
        {!!Form::number('bicep',$Fold->bicep,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Bícep'])!!}
    </div>
    <div class="col-sm-1">
        mm
    </div>
    <div class="col-md-1 content-info-pliegues">
        <i class="fas fa-info-circle"></i>
        <div class="bubble me" data-img='bicep'>
            @include('patients.anthropometry.bodyMeasure.infoPliegues.infoPliegueBicep')
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="size" class="col-sm-4 col-form-label text-right">Trícep:</label>
    <div class="col-sm-2">
        {!!Form::number('tricep',$Fold->tricep,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Trícep'])!!}
    </div>
    <div class="col-sm-1">
        mm
    </div>
    <div class="col-md-1 content-info-pliegues">
        <i class="fas fa-info-circle"></i>
        <div class="bubble me">
            @include('patients.anthropometry.bodyMeasure.infoPliegues.infoPliegueTricep')
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="size" class="col-sm-4 col-form-label text-right">Subescapular:</label>
    <div class="col-sm-2">
        {!!Form::number('subescapular',$Fold->subescapular,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Subescapular'])!!}
    </div>
    <div class="col-sm-1">
        mm
    </div>
    <div class="col-md-1 content-info-pliegues">
        <i class="fas fa-info-circle"></i>
        <div class="bubble me">
            @include('patients.anthropometry.bodyMeasure.infoPliegues.infoPliegueSubescapular')
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="size" class="col-sm-4 col-form-label text-right">Suprailiaco:</label>
    <div class="col-sm-2">
        {!!Form::number('suprailiaco',$Fold->suprailiaco,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Suprailiaco'])!!}
    </div>
    <div class="col-sm-1">
        mm
    </div>
    <div class="col-md-1 content-info-pliegues">
        <i class="fas fa-info-circle"></i>
        <div class="bubble me">
            @include('patients.anthropometry.bodyMeasure.infoPliegues.infoPliegueSuprailiaco')
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="size" class="col-sm-4 col-form-label text-right">Supraespinal:</label>
    <div class="col-sm-2">
        {!!Form::number('supraespinal',$Fold->supraespinal,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Supraespinal'])!!}
    </div>
    <div class="col-sm-1">
        mm
    </div>
    <div class="col-md-1 content-info-pliegues">
        <i class="fas fa-info-circle"></i>
        <div class="bubble me">
            @include('patients.anthropometry.bodyMeasure.infoPliegues.infoPliegueSupraespinal')
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="size" class="col-sm-4 col-form-label text-right">Abdominal:</label>
    <div class="col-sm-2">
        {!!Form::number('abdominal',$Fold->abdominal,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Abdominal'])!!}
    </div>
    <div class="col-sm-1">
        mm
    </div>
    <div class="col-md-1 content-info-pliegues">
        <i class="fas fa-info-circle"></i>
        <div class="bubble me">
            @include('patients.anthropometry.bodyMeasure.infoPliegues.infoPliegueAbdominal')
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="size" class="col-sm-4 col-form-label text-right">Muslo frontal:</label>
    <div class="col-sm-2">
        {!!Form::number('muslo_frontal',$Fold->muslo_frontal,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Muslo frontal'])!!}
    </div>
    <div class="col-sm-1">
        mm
    </div>
    <div class="col-md-1 content-info-pliegues">
        <i class="fas fa-info-circle"></i>
        <div class="bubble me">
            @include('patients.anthropometry.bodyMeasure.infoPliegues.infoPliegueMuslo')
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="size" class="col-sm-4 col-form-label text-right">Pantorrilla medial:</label>
    <div class="col-sm-2">
        {!!Form::number('pantorrilla_medial',$Fold->pantorrilla_medial,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Pantorrilla medial'])!!}
    </div>
    <div class="col-sm-1">
        mm
    </div>
    <div class="col-md-1 content-info-pliegues">
        <i class="fas fa-info-circle"></i>
        <div class="bubble me">
            @include('patients.anthropometry.bodyMeasure.infoPliegues.infoPlieguePantorrilla')
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="size" class="col-sm-4 col-form-label text-right">Axilar medial:</label>
    <div class="col-sm-2">
        {!!Form::number('axilar_medial',$Fold->axilar_medial,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Axilar medial'])!!}
    </div>
    <div class="col-sm-1">
        mm
    </div>
    <div class="col-md-1 content-info-pliegues">
        <i class="fas fa-info-circle"></i>
        <div class="bubble me">
            @include('patients.anthropometry.bodyMeasure.infoPliegues.infoPliegueAxilar')
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="size" class="col-sm-4 col-form-label text-right">Pectoral:</label>
    <div class="col-sm-2">
        {!!Form::number('pectoral',$Fold->pectoral,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Pectoral'])!!}
    </div>
    <div class="col-sm-1">
        mm
    </div>
    <div class="col-md-1 content-info-pliegues">
        <i class="fas fa-info-circle"></i>
        <div class="bubble me">
            @include('patients.anthropometry.bodyMeasure.infoPliegues.infoPlieguePectoral')
        </div>
    </div>
</div>
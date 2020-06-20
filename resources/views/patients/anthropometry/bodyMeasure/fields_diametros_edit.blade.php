<div class="form-group row">
    <label for="size" class="col-sm-4 col-form-label text-right">Biepicondilar del húmero:</label>
    <div class="col-sm-3">
        {!!Form::number('biepicondilar_humero',$Diameter->biepicondilar_humero,['class'=>'form-control', 'step' => '0.001', 'min' => 0, 'placeholder' => 'Biepicondilar del húmero'])!!}
    </div>
    <div class="col-sm-1">
        cm
    </div>
</div>
<div class="form-group row">
    <label for="size" class="col-sm-4 col-form-label text-right">Biepicondilar del fémur:</label>
    <div class="col-sm-3">
        {!!Form::number('biepicondilar_femur',$Diameter->biepicondilar_femur,['class'=>'form-control', 'step' => '0.001', 'min' => 0, 'placeholder' => 'Biepicondilar del fémur'])!!}
    </div>
    <div class="col-sm-1">
        cm
    </div>
</div>
<div class="form-group row">
    <label for="size" class="col-sm-4 col-form-label text-right">Biacromial:</label>
    <div class="col-sm-3">
        {!!Form::number('biacromial',$Diameter->biacromial,['class'=>'form-control', 'step' => '0.001', 'min' => 0, 'placeholder' => 'Biacromial'])!!}
    </div>
    <div class="col-sm-1">
        cm
    </div>
</div>
<div class="form-group row">
    <label for="size" class="col-sm-4 col-form-label text-right">Biliocrestídeo:</label>
    <div class="col-sm-3">
        {!!Form::number('biliocrestideo',$Diameter->biliocrestideo,['class'=>'form-control', 'step' => '0.001', 'min' => 0, 'placeholder' => 'Biliocrestídeo'])!!}
    </div>
    <div class="col-sm-1">
        cm
    </div>
</div>
<div class="form-group row">
    <label for="size" class="col-sm-4 col-form-label text-right">Longitud de pie:</label>
    <div class="col-sm-3">
        {!!Form::number('longitud_pie',$Diameter->longitud_pie,['class'=>'form-control', 'step' => '0.001', 'min' => 0, 'placeholder' => 'Longitud de pie'])!!}
    </div>
    <div class="col-sm-1">
        cm
    </div>
</div>
<div class="form-group row">
    <label for="size" class="col-sm-4 col-form-label text-right">Transverso de tórax:</label>
    <div class="col-sm-3">
        {!!Form::number('transverso_torax',$Diameter->transverso_torax,['class'=>'form-control', 'step' => '0.001', 'min' => 0, 'placeholder' => 'Transverso de tórax'])!!}
    </div>
    <div class="col-sm-1">
        cm
    </div>
</div>
<div class="form-group row">
    <label for="size" class="col-sm-4 col-form-label text-right">Profundidad anteroposterior de tórax:</label>
    <div class="col-sm-3">
        {!!Form::number('profundidad_anteroposterior_torax',$Diameter->profundidad_anteroposterior_torax,['class'=>'form-control', 'step' => '0.001', 'min' => 0, 'placeholder' => 'Profundidad anteroposterior de tórax'])!!}
    </div>
    <div class="col-sm-1">
        cm
    </div>
</div>
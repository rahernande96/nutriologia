<div class="form-group row">
    <label for="size" class="col-sm-4 col-form-label text-right">Peso Corporal:</label>
    <div class="col-sm-2">
        {!!Form::number('body_weight',$basicMeasure->weight,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Peso', 'readonly' => 'readonly'])!!}
        {!! Form::hidden('patient_id', $patient->id) !!}
    </div>
    <div class="col-sm-2">
        Kgrs
    </div>
</div>
<div class="form-group row">
    <label for="weight" class="col-sm-4 col-form-label text-right">Grasa Total:</label>
    <div class="col-sm-2">
        {!!Form::number('total_fat_kg',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Grasa Total'])!!}
    </div>
    <div class="col-sm-1">
        Kgrs
    </div>
    <div class="col-sm-2">
        {!!Form::number('total_fat_porcent',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Grasa Total'])!!}
    </div>
    <div class="col-sm-1">
        %
    </div>
</div>
<div class="form-group row">
    <label for="weight" class="col-sm-4 col-form-label text-right">Grasa Superior:</label>
    <div class="col-sm-2">
        {!!Form::number('upper_fat_kg',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Grasa Superior'])!!}
    </div>
    <div class="col-sm-1">
        Kgrs
    </div>
    <div class="col-sm-2">
        {!!Form::number('upper_fat_porcent',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Grasa Superior'])!!}
    </div>
    <div class="col-sm-1">
        %
    </div>
</div>
<div class="form-group row">
    <label for="weight" class="col-sm-4 col-form-label text-right">Grasa Inferior:</label>
    <div class="col-sm-2">
        {!!Form::number('lower_fat_kg',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Grasa Inferior'])!!}
    </div>
    <div class="col-sm-1">
        Kgrs
    </div>
    <div class="col-sm-2">
        {!!Form::number('lower_fat_porcent',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Grasa Inferior'])!!}
    </div>
    <div class="col-sm-1">
        %
    </div>
</div>
<div class="form-group row">
    <label for="weight" class="col-sm-4 col-form-label text-right">Masa Viceral:</label>
    <div class="col-sm-2">
        {!!Form::number('visceral_mass_kg',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Masa Viceral'])!!}
    </div>
    <div class="col-sm-1">
        Kgrs
    </div>
    <div class="col-sm-2">
        {!!Form::number('visceral_mass_porcent',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Masa Viceral'])!!}
    </div>
    <div class="col-sm-1">
        %
    </div>
</div>
<div class="form-group row">
    <label for="weight" class="col-sm-4 col-form-label text-right">Masa Libre de Grasa:</label>
    <div class="col-sm-2">
        {!!Form::number('fat_free_dough_kg',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Masa Libre de Grasa'])!!}
    </div>
    <div class="col-sm-1">
        Kgrs
    </div>
    <div class="col-sm-2">
        {!!Form::number('fat_free_dough_porcent',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Masa Libre de Grasa'])!!}
    </div>
    <div class="col-sm-1">
        %
    </div>
</div>
<div class="form-group row">
    <label for="weight" class="col-sm-4 col-form-label text-right">Masa Muscular:</label>
    <div class="col-sm-2">
        {!!Form::number('muscle_mass_kg',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Masa Muscular'])!!}
    </div>
    <div class="col-sm-1">
        Kgrs
    </div>
    <div class="col-sm-2">
        {!!Form::number('muscle_mass_porcent',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Masa Muscular'])!!}
    </div>
    <div class="col-sm-1">
        %
    </div>
</div>
<div class="form-group row">
    <label for="weight" class="col-sm-4 col-form-label text-right">Peso Óseo:</label>
    <div class="col-sm-2">
        {!!Form::number('bone_weight_kg',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Peso Óseo'])!!}
    </div>
    <div class="col-sm-1">
        Kgrs
    </div>
    <div class="col-sm-2">
        {!!Form::number('bone_weight_porcent',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Peso Óseo'])!!}
    </div>
    <div class="col-sm-1">
        %
    </div>
</div>
<div class="form-group row">
    <label for="weight" class="col-sm-4 col-form-label text-right">Agua Corporal:</label>
    <div class="col-sm-2">
        {!!Form::number('body_water_l',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Agua Corporal'])!!}
    </div>
    <div class="col-sm-1">
        L
    </div>
    <div class="col-sm-2">
        {!!Form::number('body_water_porcent',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Agua Corporal'])!!}
    </div>
    <div class="col-sm-1">
        %
    </div>
</div>
<div class="form-group row">
    <label for="weight" class="col-sm-4 col-form-label text-right">Edad metabolica:</label>
    <div class="col-sm-2">
        {!!Form::number('metabolic_age',null,['class'=>'form-control', 'step' => '1', 'min' => 0, 'placeholder' => 'Edad metabolica'])!!}
    </div>
    <div class="col-sm-1">
        Años
    </div>
</div>
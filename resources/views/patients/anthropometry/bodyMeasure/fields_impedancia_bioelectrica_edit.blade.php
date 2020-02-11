<div class="form-group row">
    <label for="size" class="col-sm-4 col-form-label text-right">Peso Corporal:</label>
    <div class="col-sm-2">
        {!! Form::hidden('tab_active', '#impedancia_biolectrica') !!}
        {!!Form::number('body_weight',$BioelectricImpedance->body_weight,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Peso', 'readonly' => 'readonly'])!!}
        {!! Form::hidden('patient_id', $patient->id) !!}
    </div>
    <div class="col-sm-2">
        Kgrs
    </div>
</div>
<div class="form-group row">
    <label for="weight" class="col-sm-4 col-form-label text-right">Grasa Total:</label>
    <div class="col-sm-2">
        {!!Form::number('total_fat_kg',$BioelectricImpedance->total_fat_kg,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Grasa Total'])!!}
    </div>
    <div class="col-sm-1">
        Kgrs
    </div>
    <div class="col-sm-2">
        {!!Form::number('total_fat_porcent',$BioelectricImpedance->total_fat_porcent,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Grasa Total'])!!}
    </div>
    <div class="col-sm-1">
        %
    </div>
</div>
<div class="form-group row">
    <label for="weight" class="col-sm-4 col-form-label text-right">Grasa Superior:</label>
    <div class="col-sm-2">
        {!!Form::number('upper_fat_kg',$BioelectricImpedance->upper_fat_kg,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Grasa Superior'])!!}
    </div>
    <div class="col-sm-1">
        Kgrs
    </div>
    <div class="col-sm-2">
        {!!Form::number('upper_fat_porcent',$BioelectricImpedance->upper_fat_porcent,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Grasa Superior'])!!}
    </div>
    <div class="col-sm-1">
        %
    </div>
</div>
<div class="form-group row">
    <label for="weight" class="col-sm-4 col-form-label text-right">Grasa Inferior:</label>
    <div class="col-sm-2">
        {!!Form::number('lower_fat_kg',$BioelectricImpedance->lower_fat_kg,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Grasa Inferior'])!!}
    </div>
    <div class="col-sm-1">
        Kgrs
    </div>
    <div class="col-sm-2">
        {!!Form::number('lower_fat_porcent',$BioelectricImpedance->lower_fat_porcent,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Grasa Inferior'])!!}
    </div>
    <div class="col-sm-1">
        %
    </div>
</div>
<div class="form-group row">
    <label for="weight" class="col-sm-4 col-form-label text-right">Masa Viceral:</label>
    <div class="col-sm-2">
        {!!Form::number('visceral_mass_kg',$BioelectricImpedance->visceral_mass_kg,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Masa Viceral'])!!}
    </div>
    <div class="col-sm-1">
        Kgrs
    </div>
    <div class="col-sm-2">
        {!!Form::number('visceral_mass_porcent',$BioelectricImpedance->visceral_mass_porcent,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Masa Viceral'])!!}
    </div>
    <div class="col-sm-1">
        %
    </div>
</div>
<div class="form-group row">
    <label for="weight" class="col-sm-4 col-form-label text-right">Masa Libre de Grasa:</label>
    <div class="col-sm-2">
        {!!Form::number('fat_free_dough_kg',$BioelectricImpedance->fat_free_dough_kg,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Masa Libre de Grasa'])!!}
    </div>
    <div class="col-sm-1">
        Kgrs
    </div>
    <div class="col-sm-2">
        {!!Form::number('fat_free_dough_porcent',$BioelectricImpedance->fat_free_dough_porcent,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Masa Libre de Grasa'])!!}
    </div>
    <div class="col-sm-1">
        %
    </div>
</div>
<div class="form-group row">
    <label for="weight" class="col-sm-4 col-form-label text-right">Masa Muscular:</label>
    <div class="col-sm-2">
        {!!Form::number('muscle_mass_kg',$BioelectricImpedance->muscle_mass_kg,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Masa Muscular'])!!}
    </div>
    <div class="col-sm-1">
        Kgrs
    </div>
    <div class="col-sm-2">
        {!!Form::number('muscle_mass_porcent',$BioelectricImpedance->muscle_mass_porcent,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Masa Muscular'])!!}
    </div>
    <div class="col-sm-1">
        %
    </div>
</div>
<div class="form-group row">
    <label for="weight" class="col-sm-4 col-form-label text-right">Peso Óseo:</label>
    <div class="col-sm-2">
        {!!Form::number('bone_weight_kg',$BioelectricImpedance->bone_weight_kg,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Peso Óseo'])!!}
    </div>
    <div class="col-sm-1">
        Kgrs
    </div>
    <div class="col-sm-2">
        {!!Form::number('bone_weight_porcent',$BioelectricImpedance->bone_weight_porcent,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Peso Óseo'])!!}
    </div>
    <div class="col-sm-1">
        %
    </div>
</div>
<div class="form-group row">
    <label for="weight" class="col-sm-4 col-form-label text-right">Agua Corporal:</label>
    <div class="col-sm-2">
        {!!Form::number('body_water_l',$BioelectricImpedance->body_water_l,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Agua Corporal'])!!}
    </div>
    <div class="col-sm-1">
        Kgrs
    </div>
    <div class="col-sm-2">
        {!!Form::number('body_water_porcent',$BioelectricImpedance->body_water_porcent,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Agua Corporal'])!!}
    </div>
    <div class="col-sm-1">
        L
    </div>
</div>
<div class="form-group row">
    <label for="weight" class="col-sm-4 col-form-label text-right">Edad metabolica:</label>
    <div class="col-sm-2">
        {!!Form::number('metabolic_age',$BioelectricImpedance->metabolic_age,['class'=>'form-control', 'step' => '1', 'min' => 0, 'placeholder' => 'Edad metabolica'])!!}
    </div>
    <div class="col-sm-1">
        Años
    </div>
</div>
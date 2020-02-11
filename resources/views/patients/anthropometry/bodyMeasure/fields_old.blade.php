<div class="form-group row">
    <label for="patient" class="col-sm-2 col-form-label text-right">Paciente:</label>
    <div class="col-sm-5">
        <input type="text" readonly class="form-control-plaintext" id="patient" value="{{ $patient->name }}">
        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
    </div>
</div>
<hr>
<h3 class="kt-section__title">
    1. Impedancia bioeléctrica:
</h3>
<hr>
<div class="kt-section__body">
    <div class="form-group row">
        <label for="size" class="col-sm-2 col-form-label text-right">Peso Corporal:</label>
        <div class="col-sm-2">
            {!!Form::number('body_weight',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Peso'])!!}
        </div>
        <div class="col-sm-2">
            Kgrs
        </div>
    </div>
    <div class="form-group row">
        <label for="weight" class="col-sm-2 col-form-label text-right">Grasa Total:</label>
        <div class="col-sm-2">
            {!!Form::number('total_fat_kg',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Grasa Total'])!!}
        </div>
        <div class="col-sm-1">
            Kgrs
        </div>
        <div class="col-sm-2">
            {!!Form::number('total_fat_%',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Grasa Total'])!!}
        </div>
        <div class="col-sm-1">
            %
        </div>
    </div>
    <div class="form-group row">
        <label for="weight" class="col-sm-2 col-form-label text-right">Grasa Superior:</label>
        <div class="col-sm-2">
            {!!Form::number('upper_fat_kg',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Grasa Superior'])!!}
        </div>
        <div class="col-sm-1">
            Kgrs
        </div>
        <div class="col-sm-2">
            {!!Form::number('upper_fat_%',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Grasa Superior'])!!}
        </div>
        <div class="col-sm-1">
            %
        </div>
    </div>
    <div class="form-group row">
        <label for="weight" class="col-sm-2 col-form-label text-right">Grasa Inferior:</label>
        <div class="col-sm-2">
            {!!Form::number('lower_fat_kg',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Grasa Inferior'])!!}
        </div>
        <div class="col-sm-1">
            Kgrs
        </div>
        <div class="col-sm-2">
            {!!Form::number('lower_fat_%',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Grasa Inferior'])!!}
        </div>
        <div class="col-sm-1">
            %
        </div>
    </div>
    <div class="form-group row">
        <label for="weight" class="col-sm-2 col-form-label text-right">Masa Viceral:</label>
        <div class="col-sm-2">
            {!!Form::number('visceral_mass_kg',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Masa Viceral'])!!}
        </div>
        <div class="col-sm-1">
            Kgrs
        </div>
        <div class="col-sm-2">
            {!!Form::number('visceral_mass_%',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Masa Viceral'])!!}
        </div>
        <div class="col-sm-1">
            %
        </div>
    </div>
    <div class="form-group row">
        <label for="weight" class="col-sm-2 col-form-label text-right">Masa Libre de Grasa:</label>
        <div class="col-sm-2">
            {!!Form::number('fat_free_dough_kg',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Masa Libre de Grasa'])!!}
        </div>
        <div class="col-sm-1">
            Kgrs
        </div>
        <div class="col-sm-2">
            {!!Form::number('fat_free_dough_%',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Masa Libre de Grasa'])!!}
        </div>
        <div class="col-sm-1">
            %
        </div>
    </div>
    <div class="form-group row">
        <label for="weight" class="col-sm-2 col-form-label text-right">Masa Muscular:</label>
        <div class="col-sm-2">
            {!!Form::number('muscle_mass_kg',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Masa Muscular'])!!}
        </div>
        <div class="col-sm-1">
            Kgrs
        </div>
        <div class="col-sm-2">
            {!!Form::number('muscle_mass_%',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Masa Muscular'])!!}
        </div>
        <div class="col-sm-1">
            %
        </div>
    </div>
    <div class="form-group row">
        <label for="weight" class="col-sm-2 col-form-label text-right">Peso Óseo:</label>
        <div class="col-sm-2">
            {!!Form::number('bone_weight_kg',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Peso Óseo'])!!}
        </div>
        <div class="col-sm-1">
            Kgrs
        </div>
        <div class="col-sm-2">
            {!!Form::number('bone_weight_%',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Peso Óseo'])!!}
        </div>
        <div class="col-sm-1">
            %
        </div>
    </div>
    <div class="form-group row">
        <label for="weight" class="col-sm-2 col-form-label text-right">Agua Corporal:</label>
        <div class="col-sm-2">
            {!!Form::number('body_water_l',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Agua Corporal'])!!}
        </div>
        <div class="col-sm-1">
            Kgrs
        </div>
        <div class="col-sm-2">
            {!!Form::number('body_water_%',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Agua Corporal'])!!}
        </div>
        <div class="col-sm-1">
            L
        </div>
    </div>
    <div class="form-group row">
        <label for="weight" class="col-sm-2 col-form-label text-right">Edad metabolica:</label>
        <div class="col-sm-2">
            {!!Form::number('metabolic_age',null,['class'=>'form-control', 'step' => '1', 'min' => 0, 'placeholder' => 'Edad metabolica'])!!}
        </div>
        <div class="col-sm-1">
            Años
        </div>
    </div>
</div>
<hr>
<h3 class="kt-section__title">
    2. Pliegues:
</h3>
<hr>
<div class="kt-section__body">
    <div class="form-group row">
        <label for="size" class="col-sm-2 col-form-label text-right">Bícep:</label>
        <div class="col-sm-2">
            {!!Form::number('bicep',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Bícep'])!!}
        </div>
        <div class="col-sm-1">
            mm
        </div>
        <div class="col-md-1 content-info-imc">
            <i class="fas fa-info-circle"></i>
            <div class="bubble me">
                @include('patients.anthropometry.basicMeasure.tableNutritionalState')
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="size" class="col-sm-2 col-form-label text-right">Trícep:</label>
        <div class="col-sm-2">
            {!!Form::number('Tricep',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Trícep'])!!}
        </div>
        <div class="col-sm-1">
            mm
        </div>
        <div class="col-md-1 content-info-imc">
            <i class="fas fa-info-circle"></i>
            <div class="bubble me">
                @include('patients.anthropometry.basicMeasure.tableNutritionalState')
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="size" class="col-sm-2 col-form-label text-right">Subescapular:</label>
        <div class="col-sm-2">
            {!!Form::number('subescapular',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Subescapular'])!!}
        </div>
        <div class="col-sm-1">
            mm
        </div>
        <div class="col-md-1 content-info-imc">
            <i class="fas fa-info-circle"></i>
            <div class="bubble me">
                @include('patients.anthropometry.basicMeasure.tableNutritionalState')
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="size" class="col-sm-2 col-form-label text-right">Suprailiaco:</label>
        <div class="col-sm-2">
            {!!Form::number('suprailiaco',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Suprailiaco'])!!}
        </div>
        <div class="col-sm-1">
            mm
        </div>
        <div class="col-md-1 content-info-imc">
            <i class="fas fa-info-circle"></i>
            <div class="bubble me">
                @include('patients.anthropometry.basicMeasure.tableNutritionalState')
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="size" class="col-sm-2 col-form-label text-right">Supraespinal:</label>
        <div class="col-sm-2">
            {!!Form::number('supraespinal',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Supraespinal'])!!}
        </div>
        <div class="col-sm-1">
            mm
        </div>
        <div class="col-md-1 content-info-imc">
            <i class="fas fa-info-circle"></i>
            <div class="bubble me">
                @include('patients.anthropometry.basicMeasure.tableNutritionalState')
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="size" class="col-sm-2 col-form-label text-right">Abdominal:</label>
        <div class="col-sm-2">
            {!!Form::number('abdominal',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Abdominal'])!!}
        </div>
        <div class="col-sm-1">
            mm
        </div>
        <div class="col-md-1 content-info-imc">
            <i class="fas fa-info-circle"></i>
            <div class="bubble me">
                @include('patients.anthropometry.basicMeasure.tableNutritionalState')
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="size" class="col-sm-2 col-form-label text-right">Muslo frontal:</label>
        <div class="col-sm-2">
            {!!Form::number('muslo_frontal',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Muslo frontal'])!!}
        </div>
        <div class="col-sm-1">
            mm
        </div>
        <div class="col-md-1 content-info-imc">
            <i class="fas fa-info-circle"></i>
            <div class="bubble me">
                @include('patients.anthropometry.basicMeasure.tableNutritionalState')
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="size" class="col-sm-2 col-form-label text-right">Pantorrilla medial:</label>
        <div class="col-sm-2">
            {!!Form::number('pantorrilla_medial',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Pantorrilla medial'])!!}
        </div>
        <div class="col-sm-1">
            mm
        </div>
        <div class="col-md-1 content-info-imc">
            <i class="fas fa-info-circle"></i>
            <div class="bubble me">
                @include('patients.anthropometry.basicMeasure.tableNutritionalState')
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="size" class="col-sm-2 col-form-label text-right">Axilar medial:</label>
        <div class="col-sm-2">
            {!!Form::number('axilar_medial',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Axilar medial'])!!}
        </div>
        <div class="col-sm-1">
            mm
        </div>
        <div class="col-md-1 content-info-imc">
            <i class="fas fa-info-circle"></i>
            <div class="bubble me">
                @include('patients.anthropometry.basicMeasure.tableNutritionalState')
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="size" class="col-sm-2 col-form-label text-right">Pectoral:</label>
        <div class="col-sm-2">
            {!!Form::number('pectoral',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Pectoral'])!!}
        </div>
        <div class="col-sm-1">
            mm
        </div>
        <div class="col-md-1 content-info-imc">
            <i class="fas fa-info-circle"></i>
            <div class="bubble me">
                @include('patients.anthropometry.basicMeasure.tableNutritionalState')
            </div>
        </div>
    </div>
</div>
<hr>
<h3 class="kt-section__title">
    3. Perímetros:
</h3>
<hr>
<div class="kt-section__body">
    <div class="form-group row">
        <label for="size" class="col-sm-2 col-form-label text-right">Muñeca:</label>
        <div class="col-sm-2">
            {!!Form::number('muneca',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Muñeca'])!!}
        </div>
        <div class="col-sm-1">
            cm
        </div>
    </div>
    <div class="form-group row">
        <label for="size" class="col-sm-2 col-form-label text-right">Cintura:</label>
        <div class="col-sm-2">
            {!!Form::number('cintura',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Cintura'])!!}
        </div>
        <div class="col-sm-1">
            cm
        </div>
    </div>
    <div class="form-group row">
        <label for="size" class="col-sm-2 col-form-label text-right">Cadera (glúteo):</label>
        <div class="col-sm-2">
            {!!Form::number('cadera',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Cadera (glúteo)'])!!}
        </div>
        <div class="col-sm-1">
            cm
        </div>
    </div>
    <div class="form-group row">
        <label for="size" class="col-sm-2 col-form-label text-right">Brazo relajado:</label>
        <div class="col-sm-2">
            {!!Form::number('brazo_relajado',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Brazo relajado'])!!}
        </div>
        <div class="col-sm-1">
            cm
        </div>
    </div>
    <div class="form-group row">
        <label for="size" class="col-sm-2 col-form-label text-right">Brazo contraido:</label>
        <div class="col-sm-2">
            {!!Form::number('brazo_contraido',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Brazo contraido'])!!}
        </div>
        <div class="col-sm-1">
            cm
        </div>
    </div>
    <div class="form-group row">
        <label for="size" class="col-sm-2 col-form-label text-right">Pantorrilla:</label>
        <div class="col-sm-2">
            {!!Form::number('pantorrilla',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Pantorrilla'])!!}
        </div>
        <div class="col-sm-1">
            cm
        </div>
    </div>
    <div class="form-group row">
        <label for="size" class="col-sm-2 col-form-label text-right">Antebrazo:</label>
        <div class="col-sm-2">
            {!!Form::number('antebrazo',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Antebrazo'])!!}
        </div>
        <div class="col-sm-1">
            cm
        </div>
    </div>
    <div class="form-group row">
        <label for="size" class="col-sm-2 col-form-label text-right">Cabeza:</label>
        <div class="col-sm-2">
            {!!Form::number('cabeza',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Cabeza'])!!}
        </div>
        <div class="col-sm-1">
            cm
        </div>
    </div>
    <div class="form-group row">
        <label for="size" class="col-sm-2 col-form-label text-right">Cuello:</label>
        <div class="col-sm-2">
            {!!Form::number('cuello',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Cuello'])!!}
        </div>
        <div class="col-sm-1">
            cm
        </div>
    </div>
    <div class="form-group row">
        <label for="size" class="col-sm-2 col-form-label text-right">Tórax:</label>
        <div class="col-sm-2">
            {!!Form::number('torax',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Tórax'])!!}
        </div>
        <div class="col-sm-1">
            cm
        </div>
    </div>
</div>
<hr>
<h3 class="kt-section__title">
    4. Diámetros:
</h3>
<hr>
<div class="kt-section__body">
    <div class="form-group row">
        <label for="size" class="col-sm-2 col-form-label text-right">Biepicondilar del húmero:</label>
        <div class="col-sm-2">
            {!!Form::number('biepicondilar_húmero',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Biepicondilar del húmero'])!!}
        </div>
        <div class="col-sm-1">
            cm
        </div>
    </div>
    <div class="form-group row">
        <label for="size" class="col-sm-2 col-form-label text-right">Biepicondilar del fémur:</label>
        <div class="col-sm-2">
            {!!Form::number('biepicondilar_femur',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Biepicondilar del fémur'])!!}
        </div>
        <div class="col-sm-1">
            cm
        </div>
    </div>
    <div class="form-group row">
        <label for="size" class="col-sm-2 col-form-label text-right">Biacromial:</label>
        <div class="col-sm-2">
            {!!Form::number('biacromial',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Biacromial'])!!}
        </div>
        <div class="col-sm-1">
            cm
        </div>
    </div>
    <div class="form-group row">
        <label for="size" class="col-sm-2 col-form-label text-right">Biliocrestídeo:</label>
        <div class="col-sm-2">
            {!!Form::number('biliocrestideo',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Biliocrestídeo'])!!}
        </div>
        <div class="col-sm-1">
            cm
        </div>
    </div>
    <div class="form-group row">
        <label for="size" class="col-sm-2 col-form-label text-right">Longitud de pie:</label>
        <div class="col-sm-2">
            {!!Form::number('longitud_pie',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Longitud de pie'])!!}
        </div>
        <div class="col-sm-1">
            cm
        </div>
    </div>
    <div class="form-group row">
        <label for="size" class="col-sm-2 col-form-label text-right">Transverso de tórax:</label>
        <div class="col-sm-2">
            {!!Form::number('transverso_torax',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Transverso de tórax'])!!}
        </div>
        <div class="col-sm-1">
            cm
        </div>
    </div>
    <div class="form-group row">
        <label for="size" class="col-sm-2 col-form-label text-right">Profundidad anteroposterior de tórax:</label>
        <div class="col-sm-2">
            {!!Form::number('profundidad_anteroposterior_torax',null,['class'=>'form-control', 'step' => '0.01', 'min' => 0, 'placeholder' => 'Profundidad anteroposterior de tórax'])!!}
        </div>
        <div class="col-sm-1">
            cm
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-8 offset-md-4">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('anthropometry.index', $patient->slug) }}" class="btn btn-alert">Cancelar</a>
    </div>
</div>
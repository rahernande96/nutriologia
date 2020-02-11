<div class="row  mt-5">
    <div class="col-md-2">
        <div class="content-siluet-imc border weight-deficit @if($patient->BasicMeasure->imc < 18) active @endif"></div>
    </div>
    <div class="col-md-2">
        <div class="content-siluet-imc border norm @if($patient->BasicMeasure->imc >= 18 && $patient->BasicMeasure->imc < 24.9) active @endif"></div>
    </div>
    <div class="col-md-2">
        <div class="content-siluet-imc border over-weight @if($patient->BasicMeasure->imc >= 24.9 && $patient->BasicMeasure->imc <= 29.9) active @endif"></div>
    </div>
    <div class="col-md-2">
        <div class="content-siluet-imc border obesity-first @if($patient->BasicMeasure->imc >= 30 && $patient->BasicMeasure->imc <= 34.9) active @endif"></div>
    </div>
    <div class="col-md-2">
        <div class="content-siluet-imc border obesity-second @if($patient->BasicMeasure->imc >= 35 && $patient->BasicMeasure->imc <= 39.9) active @endif"></div>
    </div>
    <div class="col-md-2">
        <div class="content-siluet-imc border obesity-third @if($patient->BasicMeasure->imc >= 40) active @endif"></div>
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-2">
        <div class="content-siluet-value center weight-deficit @if($patient->BasicMeasure->imc < 18) active @endif">< 18.5</div>
    </div>
    <div class="col-md-2">
        <div class="content-siluet-value center norm @if($patient->BasicMeasure->imc >= 18 && $patient->BasicMeasure->imc < 24.9) active @endif">18.6 - 24.9</div>
    </div>
    <div class="col-md-2">
        <div class="content-siluet-value center over-weight @if($patient->BasicMeasure->imc >= 24.9 && $patient->BasicMeasure->imc <= 29.9) active @endif">35 - 29.9</div>
    </div>
    <div class="col-md-2">
        <div class="content-siluet-value center obesity-first @if($patient->BasicMeasure->imc >= 30 && $patient->BasicMeasure->imc <= 34.9) active @endif">30 - 34.9</div>
    </div>
    <div class="col-md-2">
        <div class="content-siluet-value center obesity-second @if($patient->BasicMeasure->imc >= 35 && $patient->BasicMeasure->imc <= 39.9) active @endif">35 - 39.9</div>
    </div>
    <div class="col-md-2">
        <div class="content-siluet-value center obesity-third @if($patient->BasicMeasure->imc >= 40) active @endif">> 40</div>
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-2">
        <div class="content-siluet-interpretation center weight-deficit @if($patient->BasicMeasure->imc < 18) active @endif"><h6 class="p-1">BAJO PESO</h6></div>
    </div>
    <div class="col-md-2">
        <div class="content-siluet-interpretation center norm @if($patient->BasicMeasure->imc >= 18 && $patient->BasicMeasure->imc < 24.9) active @endif">IDEAL</div>
    </div>
    <div class="col-md-2">
        <div class="content-siluet-interpretation center over-weight @if($patient->BasicMeasure->imc >= 24.9 && $patient->BasicMeasure->imc <= 29.9) active @endif">SOBREPESO</div>
    </div>
    <div class="col-md-2">
        <div class="content-siluet-interpretation center obesity-first @if($patient->BasicMeasure->imc >= 30 && $patient->BasicMeasure->imc <= 34.9) active @endif">OBESIDAD</div>
    </div>
    <div class="col-md-2">
        <div class="content-siluet-interpretation center obesity-second @if($patient->BasicMeasure->imc >= 35 && $patient->BasicMeasure->imc <= 39.9) active @endif">OBESIDAD SEVERA</div>
    </div>
    <div class="col-md-2">
        <div class="content-siluet-interpretation center obesity-third @if($patient->BasicMeasure->imc >= 40) active @endif">OBESIDAD MORVIDA</div>
    </div>
</div>
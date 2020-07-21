@extends('layouts.admin')
@section('title')
Paciente: {{ $patient->name }}
@endsection
@section('extra-css')
    
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary mt-4">
            <div class="card-header">
                <div class="card-title">Composición Corporal de {{ $patient->name }}</div>
            </div>
            
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Campo</th>
                                        <th>Valor</th>
                                        <th>Interpretación</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Peso Actual:</td>
                                        <td>{{ round($patient->BasicMeasure->weight, 2) }}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>IMC</td>
                                        <td>{{ round($patient->BasicMeasure->imc, 2) }}</td>
                                        <td>
                                            @if($patient->BasicMeasure->imc < 18)
                                                Bajo peso
                                            @elseif($patient->BasicMeasure->imc >= 18.5 && $patient->BasicMeasure->imc < 24.9)
                                                Normopeso
                                            @elseif($patient->BasicMeasure->imc >= 24.9 && $patient->BasicMeasure->imc <= 29.9)
                                                Sobrepeso
                                            @elseif($patient->BasicMeasure->imc >= 30 && $patient->BasicMeasure->imc <= 34.9)
                                                Obesidad I
                                            @elseif($patient->BasicMeasure->imc >= 35 && $patient->BasicMeasure->imc <= 39.9)
                                                Obesidad II
                                            @elseif($patient->BasicMeasure->imc >= 40)
                                                Obesidad III
                                            @endif
                                        </td>
                                    </tr>
                                    @if($patient->BasicMeasure->pregnancy)
                                    <tr>
                                        <td>Imc pregestacional</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>PeIMCpgEg</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>%PeIMCpgEg</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td>Complexión corporal</td>
                                        <td>
                                            {{ round($complex, 2) }}
                                        </td>
                                        <td>
                                            @if($patient->gender == 'Masculino')
                                                @if($complex > 10.4)
                                                    Pequeña
                                                @elseif($complex >= 9.6 && $complex <= 10.4)
                                                    Normal
                                                @elseif($complex < 9.6 && $complex > 0)
                                                    Grande
                                                @else
                                                    Faltan datos
                                                @endif
                                            @elseif($patient->gender == 'Femenino')
                                                @if($complex > 11)
                                                    Pequeña
                                                @elseif($complex >= 10.1 && $complex <= 11)
                                                    Normal
                                                @elseif($complex < 10.1 && $complex > 0)
                                                    Grande
                                                @else
                                                    Faltan datos
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Circunferencia de cintura</td>
                                        <td>
                                            {{ round($patient->BodyMeasure->Perimeter->cintura, 2)}}
                                        </td>
                                        <td>
                                            @if($patient->gender == 'Masculino')
                                                @if($patient->BodyMeasure->Perimeter->cintura > 94)
                                                    Riesgo de enfermedades cardiovasculares y DM
                                                @else
                                                    Sin riesgo de enfermedades cardiovasculares y DM
                                                @endif
                                            @elseif($patient->gender == 'Femenino')
                                                @if($patient->BodyMeasure->Perimeter->cintura > 80)
                                                    Riesgo de enfermedades cardiovasculares y DM
                                                @else
                                                    Sin riesgo de enfermedades cardiovasculares y DM
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Índice cintura cadera</td>
                                        <td>{{ round($ICC, 2) }}</td>
                                        <td>
                                            @if($patient->gender == 'Masculino')
                                                @if($ICC < 0.71)
                                                    Ginecoide
                                                @elseif($ICC >= 0.71 && $ICC <= 0.84)
                                                    Sin riesgo de Enfermedad Cardiovascular
                                                @elseif($ICC > 0.84)
                                                    Androide
                                                @endif
                                            @elseif($patient->gender == 'Femenino')
                                                @if($ICC < 0.78)
                                                    Ginecoide
                                                @elseif($ICC >= 0.78 && $ICC <= 0.93)
                                                    Sin riesgo de Enfermedad Cardiovascular
                                                @elseif($ICC > 0.93)
                                                    Androide
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">% Grasa corporal</td>
                                    </tr>
                                    <tr>
                                        <td>Frisancho 2 pliegues</td>
                                        <td>
                                            {{ round($dos_pliegues, 2) }}%
                                        </td>
                                        <td>
                                            @if($dos_pliegues >= 0 || $dos_pliegues <= 5.0)
                                                Magro
                                            @elseif($dos_pliegues >= 5.1 || $dos_pliegues <= 15)
                                                Grasa debajo del promedio
                                            @elseif($dos_pliegues >= 15.1 || $dos_pliegues <= 75)
                                                Grasa promedio
                                            @elseif($dos_pliegues >= 75.1 || $dos_pliegues <= 85)
                                                Grasa arriba del promedio
                                            @elseif($dos_pliegues >= 85.1 || $dos_pliegues <= 100)
                                                Exceso de grasa
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Siri</td>
                                        <td>{{ round($siri,2) }}%</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Durnin y Womersley</td>
                                        <td>{{ round($DW, 2) }} %</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Durnin y colaboradores</td>
                                        <td>{{ round($pliegues_4, 2) }}</td>
                                        <td>
                                            @if($patient->gender == 'Masculino')
                                                @if($pliegues_4 >= 2 && $pliegues_4 <= 4)
                                                    GRASA ESENCIAL
                                                @elseif($pliegues_4 >= 6 && $pliegues_4 <= 13)
                                                    ATLETAS
                                                @elseif($pliegues_4 >= 14 && $pliegues_4 <= 17)
                                                    GIMNASIO
                                                @elseif($pliegues_4 >= 18 && $pliegues_4 <= 25)
                                                    ACEPTABLE
                                                @elseif($pliegues_4 > 26)
                                                    ACRECENTADA
                                                @endif
                                            @elseif($patient->gender == 'Femenino')
                                                @if($pliegues_4 >= 10 && $pliegues_4 <= 12)
                                                    GRASA ESENCIAL
                                                @elseif($pliegues_4 >= 14 && $pliegues_4 <= 20)
                                                    ATLETAS
                                                @elseif($pliegues_4 >= 21 && $pliegues_4 <= 24)
                                                    GIMNASIO
                                                @elseif($pliegues_4 >= 25 && $pliegues_4 <= 31)
                                                    ACEPTABLE
                                                @elseif($pliegues_4 > 31)
                                                    ACRECENTADA
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Deurenberg y colaboradores</td>
                                        <td>{{ round($DeurenbergCol,2) }} %</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Faulkner</td>
                                        <td>{{ round($Faulkner,2) }} %</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Yuhasz 6 pliegues</td>
                                        <td>{{ round($Yuhastz,2) }} %</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Impedancia magnética</td>
                                        <td>{{ round($magnetic_impedance,2) }} %</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Promedio</td>
                                        <td>{{ round($prom,2) }} %</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">Áreas y Agua corporal</td>
                                    </tr>
                                    <tr>
                                        <td>Área Muscular Braquial</td>
                                        <td>{{ round($AMB,2) }} cm<sup>2</sup></td>
                                        <td>
                                            @if($AMB < 5)
                                                Musculatura reducida
                                            @elseif($AMB > 5 && $AMB <= 15)
                                                Musculatura debajo del promedio
                                            @elseif($AMB > 15 && $AMB <= 85)
                                                Musculatura promedio
                                            @elseif($AMB > 85 && $AMB <= 95)
                                                Musculatura arriba del promedio
                                            @elseif($AMB > 95)
                                                Musculatura alta: buena nutrición
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Área Grasa Braquial</td>
                                        <td>{{ round($AGB,2) }} cm<sup>2</sup></td>
                                        <td>
                                            @if($AMB < 5)
                                                Magro
                                            @elseif($AMB > 5 && $AMB <= 15)
                                                Grasa debajo del promedio
                                            @elseif($AMB > 15 && $AMB <= 85)
                                                Grasa promedio
                                            @elseif($AMB > 85 && $AMB <= 95)
                                                Grasa arriba del promedio
                                            @elseif($AMB > 95)
                                                Exceso de grasa
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Índice de Área Grasa</td>
                                        <td>{{ round($IAG,2) }} %</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Agua Corporal Total</td>
                                        <td>{{ round($ACT,2) }} Litros</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">Distribución corporal</td>
                                    </tr>
                                    <tr>
                                        <td>Masa ósea. Rocha</td>
                                        <td>{{ round($MOR,2) }} Kg</td>
                                        <td>{{ number_format(($MOR/$Sum_Mass) * 100, 2, '.', '') }} %</td>
                                    </tr>
                                    <tr>
                                        <td>Masa grasa</td>
                                        <td>{{ round($MG,2) }} Kg</td>
                                        <td>{{ number_format(($MG/$Sum_Mass) * 100, 2, '.', '') }} %</td>
                                    </tr>
                                    <tr>
                                        <td>Masa Muscular Total</td>
                                        <td>{{ round($MMT,2) }} Kg</td>
                                        <td>{{ number_format(($MMT/$Sum_Mass) * 100, 2, '.', '') }} %</td>
                                    </tr>
                                    <tr>
                                        <td>Masa Residual. Wurch</td>
                                        <td>{{ round($MR,2) }} Kg</td>
                                        <td>{{ number_format(($MR/$Sum_Mass) * 100, 2, '.', '') }} %</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><!-- ./col -->
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Valor</th>
                                                <th>Interpretación</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>IMC</td>
                                                <td>{{ round($patient->BasicMeasure->imc,2) }}</td>
                                                <td>
                                                    @if($patient->BasicMeasure->imc < 18)
                                                        Bajo peso
                                                    @elseif($patient->BasicMeasure->imc >= 18 && $patient->BasicMeasure->imc < 24.9)
                                                        Normal
                                                    @elseif($patient->BasicMeasure->imc >= 24.9 && $patient->BasicMeasure->imc <= 29.9)
                                                        Sobrepeso
                                                    @elseif($patient->BasicMeasure->imc >= 30 && $patient->BasicMeasure->imc <= 34.9)
                                                        Obecidad I
                                                    @elseif($patient->BasicMeasure->imc >= 35 && $patient->BasicMeasure->imc <= 39.9)
                                                        Obecidad II
                                                    @elseif($patient->BasicMeasure->imc >= 40)
                                                        Obecidad III
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @include('patients.anthropometry.bodyComposition.siluets')
                            <div class="row mt-4">
                                <div class="col-md-8">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Medida</th>
                                                <th>Valor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><div class="range-box-color green"></div></td>
                                                <td>Masa Ósea. Rocha</td>
                                                <td>{{ number_format(($MOR*100)/$Sum_Mass, '2', '.', ',') }} %</td>
                                            </tr>
                                            <tr>
                                                <td><div class="range-box-color orange"></div></td>
                                                <td>Masa Grasa</td>
                                                <td>{{ number_format(($MG*100)/$Sum_Mass, '2', '.', ',') }} %</td>
                                            </tr>
                                            <tr>
                                                <td><div class="range-box-color blue"></div></td>
                                                <td>Masa Muscular Total</td>
                                                <td>{{ number_format(($MMT*100)/$Sum_Mass, '2', '.', ',') }} %</td>
                                            </tr>
                                            <tr>
                                                <td><div class="range-box-color violet"></div></td>
                                                <td>Masa Residual. Wurch</td>
                                                <td>{{ number_format(($MR*100)/$Sum_Mass, '2', '.', ',') }} %</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="range-multicolor" style="background: linear-gradient(to right, #58E328, #E38D28 {{ (number_format(($MOR*100)/$Sum_Mass, '2', '.', ',')) + (number_format(($MG*100)/$Sum_Mass, '2', '.', ',')) }}%, #283EE3 {{ (number_format(($MOR*100)/$Sum_Mass, '2', '.', ',')) + (number_format(($MG*100)/$Sum_Mass, '2', '.', ',')) + (number_format(($MMT*100)/$Sum_Mass, '2', '.', ',')) }}%, #6B429E);"></div>
                                    <div class="content-markers relative">
                                        @if(number_format(($MOR*100)/$Sum_Mass, '2', '.', ',') >= 0.01)
                                        <div class="marker text-center" style="margin-left:{{ (number_format(($MOR*100)/$Sum_Mass, '2', '.', ',') - 8.2)/2 }}%;">
                                            <div class="range-marker marker-color-green"></div>
                                            
                                            {{-- <span>{{ number_format(($MOR*100)/$Sum_Mass, '2', '.', ',') }} %</span> --}}
                                        </div>
                                        @endif
                                        @if(number_format(($MG*100)/$Sum_Mass, '2', '.', ',') >= 0.01)
                                        <div class="marker text-center" style="margin-left:{{ (number_format(($MOR*100)/$Sum_Mass, '2', '.', ',') + (number_format(($MG*100)/$Sum_Mass, '2', '.', ',')/2) - 8.2) }}%;">
                                            <div class="range-marker marker-color-orange"></div>
                                           
                                            {{-- <span>{{ number_format(($MG*100)/$Sum_Mass, '2', '.', ',') }} %</span> --}}
                                        </div>
                                        @endif
                                        @if(number_format(($MMT*100)/$Sum_Mass, '2', '.', ',') >= 0.01)
                                        <div class="marker text-center" style="margin-left:{{ (number_format(($MOR*100)/$Sum_Mass, '2', '.', ',') + number_format(($MG*100)/$Sum_Mass, '2', '.', ',') + (number_format(($MMT*100)/$Sum_Mass, '2', '.', ',')/2) - 8.2) }}%;">
                                            <div class="range-marker marker-color-blue"></div>
                                           
                                            {{-- <span>{{ number_format(($MMT*100)/$Sum_Mass, '2', '.', ',') }} %</span> --}}
                                        </div>
                                        @endif
                                        @if(number_format(($MR*100)/$Sum_Mass, '2', '.', ',') >= 0.01)
                                        <div class="marker text-center" style="margin-left:{{ (number_format(($MOR*100)/$Sum_Mass, '2', '.', ',') + number_format(($MG*100)/$Sum_Mass, '2', '.', ',') + number_format(($MMT*100)/$Sum_Mass, '2', '.', ',') + (number_format(($MR*100)/$Sum_Mass, '2', '.', ',')/2) - 8.2) }}%;">
                                            <div class="range-marker marker-color-violet"></div>
                                            
                                            {{-- <span>{{ number_format(($MR*100)/$Sum_Mass, '2', '.', ',') }} %</span> --}}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div><!-- ./col -->
                        <!-- regesar a antopometria -->  
                        <div class="col-md-6 offset-md-5 mt-4 mb-4">
                            <a href="{{ route('anthropometry.index', $patient->slug) }}" class="btn btn-primary">Ir a Antropometria</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-js')

@endsection
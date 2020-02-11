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
                <div class="card-title">Somatocarta de {{ $patient->name }}</div>
            </div>
            
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5">
                           <table class="table mt-5">
                                <thead>
                                    <tr>
                                        <th>Somatotipo</th>
                                        <th>Valor</th>
                                        <th>Interpretación</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Endomorfo</td>
                                        <td>{{ $Endomorph }}</td>
                                        <td>
                                            @if($Endomorph >= 0.5 && $Endomorph <= 2.9)
                                                Bajo
                                            @elseif($Endomorph >= 3 && $Endomorph < 5.5)
                                                Moderado
                                            @elseif($Endomorph >= 5.5 && $Endomorph <= 7)
                                                Alto
                                            @elseif($Endomorph > 7)
                                                Muy Alto
                                            @endif
                                        </td>
                                        <td>
                                            <div class="content-info-imc relative">
                                                <i class="fas fa-info-circle"></i>
                                                <div class="bubble me">
                                                    @include('patients.anthropometry.somatocard.tableInformation.tableInformationEndomorph')
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Mesomorfo</td>
                                        <td>{{ $Mesomorph }}</td>
                                        <td>
                                            @if($Mesomorph >= 0.5 && $Mesomorph <= 2.9)
                                                Bajo
                                            @elseif($Mesomorph >= 3 && $Mesomorph < 5.5)
                                                Moderado
                                            @elseif($Mesomorph >= 5.5 && $Mesomorph <= 7)
                                                Alto
                                            @elseif($Mesomorph > 7)
                                                Muy Alto
                                            @endif
                                        </td>
                                        <td>
                                            <div class="content-info-imc relative">
                                                <i class="fas fa-info-circle"></i>
                                                <div class="bubble me">
                                                    @include('patients.anthropometry.somatocard.tableInformation.tableInformationMesomorph')
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ectomorfo</td>
                                        <td>{{ $Ectomorph }}</td>
                                        <td>
                                            @if($Ectomorph >= 0.5 && $Ectomorph <= 2.9)
                                                Bajo
                                            @elseif($Ectomorph >= 3 && $Ectomorph < 5.5)
                                                Moderado
                                            @elseif($Ectomorph >= 5.5 && $Ectomorph <= 7)
                                                Alto
                                            @elseif($Ectomorph > 7)
                                                Muy Alto
                                            @endif
                                        </td>
                                        <td>
                                            <div class="content-info-imc relative">
                                                <i class="fas fa-info-circle"></i>
                                                <div class="bubble me">
                                                    @include('patients.anthropometry.somatocard.tableInformation.tableInformationEctomorph')
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>X</td>
                                        <td>{{ $EjeX }}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Y</td>
                                        <td>{{ $EjeY }}</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                           </table>
                        </div><!-- ./col -->
                        <div class="col-md-7">
                            <div class="content-somatocard">
                                <div id="chart_div" style="width: 550px; height: 600px;"></div>
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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var values = <?php echo $chart_somatocard; ?>;
        console.log(values);
        /*var data = google.visualization.arrayToDataTable([
          ['X', 'Y'],
          [ 8,      12],
          [ 4,      5.5],
          [ -11,     14],
          [ 4,      5],
          [ 3,      3.5],
          [ 6.5,    -7]
        ]);*/
        var data = google.visualization.arrayToDataTable(values);

        var options = {
          //title: 'Age vs. Weight comparison',
          //hAxis: {title: 'Age', minValue: 0, maxValue: 15},
          //vAxis: {title: 'Weight', minValue: 0, maxValue: 15},
          hAxis: { minValue: -80, maxValue: 80},
          vAxis: { minValue: -80, maxValue: 80},
          backgroundColor: 'none',
          legend: 'none'
        };

        var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));

        chart.draw(data, options);
      }
    </script>
@endsection
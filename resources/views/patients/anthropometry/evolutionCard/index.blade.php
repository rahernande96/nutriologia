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
                <div class="card-title">Garfica de Evolución de {{ $patient->name }}</div>
            </div>
            
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div id='chart_div' style='width: 900px; height: 500px;'></div>
                            
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
    <script type='text/javascript'>
      google.charts.load('current', {'packages':['annotationchart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('date', 'Date');
        data.addColumn('number', 'Peso');
        data.addColumn('number', 'Talla');
        data.addColumn('number', 'IMC');
        
        data.addRows([
          @forelse ($records as $item)

          [new Date({{ Carbon\Carbon::parse($item->updated_at)->format('Y,m,d') }}), {{ $item->weight }},{{ $item->size }},{{ $item->imc }}],
              
          @empty
              
          @endforelse

        ]);

        var chart = new google.visualization.AnnotationChart(document.getElementById('chart_div'));

        var options = {
          displayAnnotations: true
        };

        chart.draw(data, options);
      }
    </script>

@endsection
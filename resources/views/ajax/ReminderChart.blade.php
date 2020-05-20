<div class="col-12">
    @foreach($reminder->reminderItem as $item)
        @if($food_time_id == 0)
            <button class="btn btn-primary btn-sm btn-foodtime-chart" data-patientid="{{ $patient->id }}" data-reminderid = "{{ $reminder->id }}" data-foodtime="{{ $item->foodTime->id }}">{{ $item->foodTime->name }}</button>
        @else
            <button @if($item->food_time_id == $reminder_item->foodTime->id) class="btn btn-success btn-sm btn-foodtime-chart active" @else class="btn btn-primary btn-sm btn-foodtime-chart" @endif data-patientid="{{ $patient->id }}" data-reminderid = "{{ $reminder->id }}" data-foodtime="{{ $item->foodTime->id }}">{{ $item->foodTime->name }}</button>
        @endif
    
     @endforeach
     <button @if($food_time_id == 0) class="btn btn-success btn-sm btn-foodtime-chart active" @else class="btn btn-primary btn-sm btn-foodtime-chart" @endif data-patientid="{{ $patient->id }}" data-reminderid = "{{ $reminder->id }}" data-foodtime="0">24hrs</button>
</div>
    
<div class="col-12 mb-2 mt-4 text-center">
    {{ $Kcal_total }} <b>Kcals</b>
    <br>
</div>
<div class="col-12 hidden">
    <div class="content-chart-reminder pt-1 pb-2 hidden">
        <div id="chart_reminder_macro" style="width:100%;"></div>
    </div>
</div>
<div class="col-12">
    <table class="table table-bordered">
        <thead>
            <tr class="table-primary">
                <th scope="col"></th>
                <th scope="col">Kcal</th>
                <th scope="col">%</th>
                <th scope="col">Gramos</th>
            </tr>
        </thead>
        <tbody>
            @foreach($table_chart as $tc)
                <tr>
                <td>{{ $tc['name'] }}</td>
                <td>{{ $tc['kcal'] }}</td>
                <td>{{ number_format(($tc['kcal']/$Kcal_total)*100, 2, ',', ' ') }}</td>
                <td>{{ $tc['gramos'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>
        "use strict";
        // Class definition
        var ChartsFrequencyComsumption = function() {
        
            // Private functions
        
            var main = function() {
                // GOOGLE CHARTS INIT
                google.load('visualization', '1', {
                    packages: ['corechart', 'bar']
                });
        
                google.setOnLoadCallback(function() {
                    ChartsFrequencyComsumption.runCharts();
                });
            }
    
            var PieChartsMacros = function() {
    
                var reminder_macro = <?php echo $reminder_macro; ?>;
                console.log(reminder_macro);
                var data =  google.visualization.arrayToDataTable(reminder_macro);
                
                var options = {
                    title: 'Grafica de consumo de MacroNutientes',
                    is3D: true,
                    'width':400,
                    'height':300
                }
    
                var chart = new google.visualization.PieChart(document.getElementById('chart_reminder_macro'));
    
                chart.draw(data, options);
    
            }
    
            
          
            return {
                // public functions
                init: function() {
                    main();
                },
        
                runCharts: function() {
                    PieChartsMacros();
                }
            };
        }();
        
        ChartsFrequencyComsumption.init();
        </script>
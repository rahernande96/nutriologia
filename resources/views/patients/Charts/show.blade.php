@extends('layouts.admin')

@section('title')
	Gráfica de Consumo
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary mt-4">
            <div class="card-header">
                <h3 class="card-title">Gráficas de Consumo</h3>
            </div>
            <div class="card-body">
                <div class="row">
					<div class="col-lg-6" style="padding:0;">
						<div class="border"id="frequency_foodsGroup" style="width:100%; height:300px;"></div>
					</div>
					<br>
					<div class="col-lg-6">
						<div class="border" id="frequency_macro" style="width:100%; height:300px;"></div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-6">
						<div class="border" id="frequency_minerals" style="width:100%; height:350px;"></div>
					</div>
					<br>
					<div class="col-lg-6">
						<div class="border" id="frequency_vitamins" style="width:100%; height:350px;"></div>
					</div>
				</div>	
            </div>
        </div>
    </div>
</div>
<div class="row">
	<div class="col-lg-3 offset-lg-4">
		<a href="{{ route('ClinicHistoryPatient', $patient->slug) }}" class="btn btn-primary">Ir a Historia del paciente</a>
	</div>
</div>
<br>
@endsection

@section('extra-js')
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

		var PieCharts = function() {

			var frequency_foodsGroup = <?php echo $frequency_foodsGroup; ?>;
		
			var data =  google.visualization.arrayToDataTable(frequency_foodsGroup);
			
			var options = {
				title: 'Gráfica de consumo por grupo de alimentos',
				is3D: true,
			};

			var chart = new google.visualization.PieChart(document.getElementById('frequency_foodsGroup'));

			chart.draw(data, options);
		}

		var PieChartsMacros = function() {

			var frequency_macros = <?php echo $frequency_macros; ?>;
			
			var data =  google.visualization.arrayToDataTable(frequency_macros);
			
			var options = {
				title: 'Gráfica de consumo de Macro-Nutientes',
			}

			var chart = new google.visualization.PieChart(document.getElementById('frequency_macro'));

			chart.draw(data, options);

		}

		var BarCharstMinerals = function(){
			var minerals = <?php echo $frequency_minerals; ?>;
				//console.log(cantidades);
				var data =  google.visualization.arrayToDataTable(minerals);
				var options = {
								title: 'Frecuencia de Consumo Micronutrientes (Minerales)',							
							};
				var chart = new google.visualization.ColumnChart(document.getElementById("frequency_minerals"));
				chart.draw(data,google.charts.Bar.convertOptions(options));
		}

		var BarCharstVitamins = function(){
			var vitamins = <?php echo $frequency_vitamins; ?>;
				//console.log(cantidades);
				var data =  google.visualization.arrayToDataTable(vitamins);
				var options = {
								title: 'Frecuencia de Consumo Micronutrientes (Vitaminas)',							
							};
				var chart = new google.visualization.ColumnChart(document.getElementById("frequency_vitamins"));
				chart.draw(data,google.charts.Bar.convertOptions(options));
		}
	
	  
		return {
			// public functions
			init: function() {
				main();
			},
	
			runCharts: function() {
				PieCharts();
				PieChartsMacros();
				BarCharstMinerals();
				BarCharstVitamins();
			}
		};
	}();
	
	ChartsFrequencyComsumption.init();
	</script>
@endsection
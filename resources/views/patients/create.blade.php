@extends('layouts.admin')

@section('title')
Nuevo Paciente
@endsection

@section('content')
<div class="row">
	<div class="col-md-12 mt-4">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Datos del nuevo paciente</h3>
			</div>
			<div class="card-body">
				<form action="{{ route('patients.store') }}" method="POST" id="form_create">
					@csrf
					<div class="row">
						<div class="form-group col-md-4">
							<label for="name">Nombre completo</label>
							<input type="text" class="form-control" id="name" placeholder="Ingrese el nombre del paciente" value="{{ old('name') }}" name="name" required>
						</div>
						<div class="form-group col-md-4">
							<label for="address">Dirección</label>
							<input type="text" class="form-control" id="address" placeholder="Ingrese la direción" value="{{ old('address') }}" name="address" required>
						</div>
						<div class="form-group col-md-4">
							<label for="city">Ciudad</label>
							<input type="text" class="form-control" id="city" placeholder="Ingrese la ciudad" value="{{ old('city') }}" name="city" required>
						</div>

						<div class="form-group col-md-4">
							<label>Fecha de nacimiento</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-calendar"></i></span>
								</div>
								<input type="text" name="birthdate" class="form-control datepicker" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask required>
							</div>
						</div>

						<div class="form-group col-md-4">
							<label for="phone_1">Telefono celuar/convencional</label>
							<input type="text" class="form-control" id="phone_1" placeholder="Ingrese el telefono" value="{{ old('phone_1') }}" name="phone_1" required>
						</div>

						<div class="form-group col-md-4">
							<label for="phone_2">Telefono secundario (opcional)</label>
							<input type="text" class="form-control" id="phone_2" placeholder="Ingrese el telefono secundario (opcional)" value="{{ old('phone_2') }}" name="phone_2">
						</div>

						<div class="form-group col-md-4">
							<label for="email">Correo electrónico</label>
							<input type="text" class="form-control" id="email" placeholder="Ingrese el correo electrónico" value="{{ old('email') }}" name="email" required>
						</div>

						{{--<div class="form-group col-md-4">
							<label for="weight">Peso actual</label>
							<input type="text" class="form-control" id="weight" placeholder="Ingrese el peso" value="{{ old('weight') }}" name="weight">
						</div>--}}

						<div class="form-group col-md-2">
							<label>Género</label>
							<div class="form-check">
								<input class="form-check-input" id="masculino" type="radio" value="Masculino" name="gender">
								<label class="form-check-label" for="masculino">Masculino</label>
							</div>

							<div class="form-check">
								<input class="form-check-input" id="femenino" type="radio" value="Femenino" name="gender" checked>
								<label class="form-check-label" for="femenino">Femenino</label>
							</div>
							
						</div>

						<div class="form-group col-md-2">
							<label>Embarazo</label>
							<div class="form-check">
								<input class="form-check-input pregnancy_option" id="pregnancy_yes" type="radio" value="1" name="pregnancy">
								<label class="form-check-label" for="pregnancy_yes">Si</label>
							</div>

							<div class="form-check">
								<input class="form-check-input pregnancy_option" id="pregnancy_no" type="radio" value="0" name="pregnancy" checked>
								<label class="form-check-label" for="pregnancy_no">No</label>
							</div>
							
						</div>

						

							<div class="form-group col-md-4">
								<label class="pregnancy_details" for="trimester">Trimestre (Embarazo)</label>
								<input type="text" class="pregnancy_details form-control pregnancy" id="trimester" placeholder="Ingrese el trimestre" value="{{ old('trimester') }}" name="trimester" disabled required>
							</div>

							<div class="form-group col-md-4">
								<label class="pregnancy_details" for="sdg">SDG (Embarazo)</label>
								<input type="text" class="pregnancy_details form-control pregnancy" id="sdg" placeholder="Ingrese el SDG" value="{{ old('sdg') }}" name="sdg" disabled required>
							</div>

							<div class="form-group col-md-4">
								<label class="pregnancy_details" for="semester">Semestre (Lactancia)</label>
								<input type="text" class="pregnancy_details form-control pregnancy" id="semester" placeholder="Ingrese el semestre" value="{{ old('semester') }}" name="semester" disabled required>
							</div>

						

						{{--<div class="form-group col-md-4">
							<label for="size">Talla</label>
							<input type="text" class="form-control" id="size" placeholder="Ingrese la talla" value="{{ old('size') }}" name="size">
						</div>--}}

						<div class="form-group col-md-12">
							<label for="notes">Notas adicionales (opcional)</label>
							<textarea class="form-control" id="notes" rows="3" placeholder="Ingrese las notas (opcional)" name="notes"></textarea>
						</div>

						<div class="form-group col-md-12">
							<button id="submit_form" type="submit" class="btn btn-success">Guardar Registro</button>

							<input class="btn btn-success" type="submit" name="option2" value="Guardar Registro e Iniciar Consulta">

						</div>
					</div>
				</form>
			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
</div>
@endsection

@section('extra-js')
<script src="{{ asset('admin-lte/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('admin-lte/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('admin-lte/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('admin-lte/input-mask/jquery.inputmask.extensions.js') }}"></script>
<script>
	document.getElementById('femenino').onchange = function() {
    document.getElementById('trimester').disabled = !this.checked;
    document.getElementById('semester').disabled = !this.checked;
    document.getElementById('sdg').disabled = !this.checked;
	};

	document.getElementById('masculino').onchange = function() {
    document.getElementById('trimester').disabled = this.checked;
    document.getElementById('semester').disabled = this.checked;
    document.getElementById('sdg').disabled = this.checked;
	};

</script>
<script>
	$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
	//Datepicker
	$.fn.datepicker.dates['es'] = {
		days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"],
		daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb", "Dom"],
		daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa", "Do"],
		months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
		monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
		today: "Hoy",
		clear: "Borrar",
		format: "dd/mm/yyyy",
		titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
		weekStart: 0
	};
	$('.datepicker').datepicker({
		language:'es',
	});
    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
    	timePicker         : true,
    	timePickerIncrement: 30,
    	format             : 'MM/DD/YYYY h:mm A'
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
    {
    	ranges   : {
    		'Today'       : [moment(), moment()],
    		'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    		'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
    		'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    		'This Month'  : [moment().startOf('month'), moment().endOf('month')],
    		'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    	},
    	startDate: moment().subtract(29, 'days'),
    	endDate  : moment()
    },
    function (start, end) {
    	$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    }
    )

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    	checkboxClass: 'icheckbox_minimal-blue',
    	radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
    	checkboxClass: 'icheckbox_minimal-red',
    	radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    	checkboxClass: 'icheckbox_flat-green',
    	radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
    	showInputs: false
    })
})


$(document).ready(function(e){

	pregnacy();

	$("input[name='pregnancy']").on('click',function(e){
		
		pregnacy();

	});


	$("input[name='gender']").on('click',function(e){
		
		var input;

		input = $("input[name='gender']:checked").val();

		if (input == "Masculino") {

			$('.pregnancy').prop('disabled',true);

			$("input[name='pregnancy']").prop('disabled',true);

		}else{

			$("input[name='pregnancy']").prop('disabled',false);
			
			
			
		

		}

	});


	function pregnacy()
	{
		var option;

		option = $("input[name='pregnancy']:checked").val();

		if (option == 1) {

			$('.pregnancy').prop('disabled',false);

			$('.pregnancy_details').css('display','block');

		}else{

			$('.pregnancy').prop('disabled',true);
			$('.pregnancy_details').css('display','none');

		}
	}


});


function insertParam(key, value)
{
    key = encodeURI(key); value = encodeURI(value);

    var kvp = document.location.search.substr(1).split('&');

    var i=kvp.length; var x; while(i--) 
    {
        x = kvp[i].split('=');

        if (x[0]==key)
        {
            x[1] = value;
            kvp[i] = x.join('=');
            break;
        }
    }

    if(i<0) {kvp[kvp.length] = [key,value].join('=');}

    //this will reload the page, it's likely better to store this until finished
    document.location.search = kvp.join('&'); 
}


</script>
@endsection
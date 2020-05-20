@extends('layouts.admin')

@section('extra-css')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
<script>
    $(document).ready(function() {
        // page is now ready, initialize the calendar...
        $('#calendar').fullCalendar({
            // put your options and callbacks here
            events : [
                @foreach($events as $event)
                {
                    title : '{{ $event->title }}',
                    start : '{{ $event->start_date }}'
                },
                @endforeach
            ]
        })
    });
</script>
@endsection

@section('title')
Agendar cita: {{ $patient->name }}
@endsection

@section('content')
<div class="row">
	<div class="col-md-12 mt-4">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Agendar cita: {{ $patient->name }}</h3>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<form action="{{ route('event.store') }}" method="POST">
							@csrf
							<div class="row">
								<div class="form-group col-md-11">
									<label for="title">Titulo de la cita</label>
									<input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Ejemplo: Cita con Jonas">
								</div>
								<div class="form-group col-md-11">
									<label>Ingrese la fecha de la cita:</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fa fa-calendar"></i></span>
										</div>
										<input type="date" name="start_date" class="form-control">
									</div>
								</div>
								<div class="form-group col-md-12">
									<button type="submit" class="btn btn-success">Agendar Cita</button>
								</div>
							</div>
						</form>
					</div>
					
					<div class="col-md-6">
						<div class="row">
							<div class="card card-primary col-md-12 mx-0 px-0">
								<div class="card-header">
									<h4>Calendario de citas:</h4>
								</div>
								<div class="card-body" id="calendar">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('extra-js')
<script src="{{ asset('admin-lte/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('admin-lte/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('admin-lte/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('admin-lte/input-mask/jquery.inputmask.extensions.js') }}"></script>
<script>
	$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

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
</script>
@endsection
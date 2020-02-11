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
                monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
                dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
                dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
            // put your options and callbacks here
            events : [
            @foreach($events as $event)
            {
            	title : '{{ $event->title }}',
            	start : '{{ $event->start_date }}',
                color : '#008080',
                url: '{{ route('event.show', $event->slug) }}'
            },
            @endforeach
            ]
          })
      });
    </script>
    @endsection

    @section('title')
    Citas con pacintes
    @endsection

    @section('content')
    <div class="row">
    	<div class="col-md-12 mt-4">
    		<div class="row d-flex justify-content-end">
    			<div class="col-md-4 mx-2 d-flex justify-content-end">
    				<button class="btn btn-success" data-toggle="modal" data-target="#create_appoinment">Agregar Cita</button>
    				@include('partials.modal_create_appoinment')
    			</div>
    		</div>
    	</div>
    	<div class="col-md-12 mx-2 mt-4">
    		<div class="card card-primary">
    			<div class="card-header">
    				<h3 class="card-title">Calendario de citas</h3>
    			</div>
    			<div class="card-body" id="calendar">
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
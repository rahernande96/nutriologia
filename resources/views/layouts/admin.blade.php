<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}"></script>
	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<!-- Font Awesome -->
	<!--<script src="https://kit.fontawesome.com/dcd99a1689.js"></script>-->
	<link href="{{ asset('admin-lte/css/fontawesome5/css/all.min.css')}}" rel="stylesheet" type="text/css" />
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{ asset('admin-lte/css/adminlte.css') }}">
	<!-- iCheck -->
	<link rel="stylesheet" href="{{ asset('admin-lte/iCheck/flat/blue.css') }}">
	<!-- Morris chart -->
	<link rel="stylesheet" href="{{ asset('admin-lte/morris/morris.css') }}">
	<!-- jvectormap -->
	<link rel="stylesheet" href="{{ asset('admin-lte/jvectormap/jquery-jvectormap-1.2.2.css') }}">
	<!-- Date Picker -->
	<link rel="stylesheet" href="{{ asset('admin-lte/datepicker/datepicker3.css') }}">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="{{ asset('admin-lte/daterangepicker/daterangepicker-bs3.css') }}">
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="{{ asset('admin-lte/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300&display=swap" rel="stylesheet">
	{{-- Datatables --}}
	<link rel="stylesheet" href="{{ asset('admin-lte/datatables/dataTables.bootstrap4.css') }}">
	<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
	{{-- SweetAlert 2 --}}
	<script src="{{ asset('js/sweetalert.min.js') }}"></script>
    @yield('extra-css')
	<title>@yield('title')</title>

</head>
<body class="hold-transition sidebar-mini">
	
@include('sweet::alert')
	<div class="wrapper">

		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
				</li>
				<li class="nav-item d-none d-sm-inline-block">
					<a href="{{ route('Dashboard') }}" class="nav-link">Inicio</a>
				</li>
				@if(Auth::user()->rol->id == 2)
					<li class="nav-item d-none d-sm-inline-block">
						<a href="{{ route('patients.index') }}" class="nav-link">Mis Pacientes</a>
					</li>
					<li class="nav-item d-none d-sm-inline-block">
						<a href="{{ route('patients.create') }}" class="nav-link">Nuevo Paciente</a>
					</li>
					<li class="nav-item d-none d-sm-inline-block">
						<a href="{{ route('event.index') }}" class="nav-link">Agenda</a>
					</li>
				@endif
			</ul>

			<!-- Logout -->
			<ul class="navbar-nav ml-auto">
				@if(request()->is('configuration'))
					<!-- Button trigger modal -->
					<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#updatePassword">
					  Cambiar Contraseña
					</button>
				@endif
				<li class="nav-item">
					<a class="nav-link" href="{{ route('logout') }}" 
					onclick="event.preventDefault();
					document.getElementById('logout-form').submit();">
						<i class="fa fa-sign-out"></i>
					</a>
				</li>
				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					@csrf
				</form>
			</ul>
		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		@include('layouts.partials.aside.'.Auth::user()->rol->rol)

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Main content -->
	<section class="content">
		@yield('content')
	</section>

</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
	<strong>Todos los derechos reservados Nutrition balance &copy; 2020</strong>
	<div class="float-right d-none d-sm-inline-block">
		<b>Version</b> 3.0.0
	</div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
	<!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>


<!-- jQuery -->
<!-- <script src="plugins/jquery/jquery.min.js"></script> -->
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('admin-lte/jQueryUI/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
	$.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->

<script src="{{ asset('admin-lte/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
{{--<script src="{{ asset('admin-lte/bootstrap/js/bootstrap.js') }}"></script>--}}
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset('admin-lte/morris/morris.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('admin-lte/sparkline/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ asset('admin-lte/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('admin-lte/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('admin-lte/knob/jquery.knob.js') }}"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="{{ asset('admin-lte/daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('admin-lte/datepicker/bootstrap-datepicker.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('admin-lte/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('admin-lte/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('admin-lte/fastclick/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin-lte/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('admin-lte/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('admin-lte/js/demo.js') }}"></script>

{{-- Datatables --}}
<script src="{{ asset('admin-lte/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('admin-lte/datatables/dataTables.bootstrap4.js') }}"></script>
<script>
       
	var siteUrl = "{{ url('/') }}/";
		
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
	
</script>
@yield('extra-js')
</body>
</html>

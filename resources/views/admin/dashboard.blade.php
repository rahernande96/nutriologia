@extends('layouts.admin')

@section('title')
Bienvenido {{ $user->name }}
@endsection

@section('content')

	@if($user->role_id == 2)

	<div class="container-fluid mt-5">
	    

	  <div class="row">
	          <div class="col-lg-6 col-6">
	            <!-- small box -->
	            <div class="small-box bg-info">
	              <div class="inner">
	                <h3>Tienes un total de {{ $countPatients }}</h3>

	                <p>pacientes registrados</p>
	              </div>
	              <div class="icon">
	                <i class="fas fa-users"></i>
	              </div>
	              <a href="{{ route('patients.index') }}" class="small-box-footer">Ver todos mis pacientes <i class="fas fa-arrow-circle-right"></i></a>
	            </div>
	          </div>
	          <!-- ./col -->
	          <div class="col-lg-6 col-6">
	            <!-- small box -->
	            <div class="small-box bg-success">
	              <div class="inner">
	                <h3>Tienes un total de {{ $eventCount }}</h3>

	                <p>Citas próximas</p>
	              </div>
	              <div class="icon">
	               <i class="fas fa-calendar-times"></i>
	              </div>
	              <a href="{{ route('event.index') }}" class="small-box-footer">Ver mis citas <i class="fas fa-arrow-circle-right"></i></a>
	            </div>
	          </div>
	         
	                    <!-- ./col -->
	        </div>



	            <!-- /.card -->
	            <div class="row">

	              <div class="col-md-12">
	                <!-- USERS LIST -->
	                <div class="card">
	                  <div class="card-header">
	                    <h3 class="card-title">Tus ultimos pacientes</h3>

	                    <div class="card-tools">
	                      <span class="badge badge-danger">Nuevos Pacientes</span>
	                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
	                      </button>
	                      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
	                      </button>
	                    </div>
	                  </div>
	                  <!-- /.card-header -->
	                  <div class="card-body p-0">
	                    <ul class="users-list clearfix">

	                    @forelse($patients as $patient)
	                      <li>
	                        <img src="{{ Storage::disk('public')->url($patient->picture) }}" alt="User Image"><br>
	                        <a class="users-list-name" href="#"><b>{{$patient->name}}</b></a>
	                        @php
	                        	$patient->created_at = Carbon\Carbon::parse($patient->created_at);
	                        @endphp
	                        <span class="users-list-date">{{ $patient->created_at->diffForHumans($dateNow) }}</span>
	                      </li>
	                    @empty
	                			</ul>
	                			<div align="center" class="mt-3">
	                				<p>Sin pacientes registrados</p>
	                			</div>
	                    		<div class="mt-3 mb-1" align="center">
	                    			<a style="text-align: center;" href="{{ route('patients.create') }}" class="btn btn-primary">
		                            
			                            Nuevo Paciente
										<i class="fa fa-user-plus" aria-hidden="true"></i>		                            
			                        </a>
	                    		</div>

		                        <ul>
	                    	
	                    @endforelse
	                      
	                    </ul>
	                    <!-- /.users-list -->
	                  </div>
	                  <!-- /.card-body -->
	                  <div class="card-footer text-center">
	                   <h5> <a href="{{ route('patients.index') }}">VER TODOS MIS PACIENTES</a> </h5>
	                  </div>
	                  <!-- /.card-footer -->
	                </div>
	                <!--/.card -->
	              </div>
	              <!-- /.col -->
	            </div>
	            <!-- /.row -->
	</div>

	@endif
@endsection

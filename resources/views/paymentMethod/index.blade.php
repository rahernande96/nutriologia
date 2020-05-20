@extends('layouts.admin')

@section('title')
Configuración de pagos
@endsection

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Recibe los pagos de tus pacientes</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Recibir pagos</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

 
      
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Selecciona tu método preferido</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">

          @forelse($paymentsMethods as $paymentsMethod)

            <div class="col-sm-4">
              <div class="position-relative p-3 bg-white" style="height: 230px">
                <div class="ribbon-wrapper ribbon-xl">
                  <div class="ribbon bg-primary">
                    {{ $paymentsMethod->title }}
                  </div>
                </div>
                Recibe pagos via <br>{{ $paymentsMethod->title }} <br />
                <center><small><img src="{{ asset($paymentsMethod->image) }}" width="100"></small></center>
                <br>
                <a href="{{ route('show.payment.method',$paymentsMethod->id) }}"><button type="button" class="btn btn-block btn-outline-primary">Ir a configuración</button></a>
              </div>
            </div>

          @empty
          @endforelse

         
        </div>

       
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
         
     

 

@endsection

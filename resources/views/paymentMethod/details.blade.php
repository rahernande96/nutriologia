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

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Recibe pagos via {{ $paymentsMethod->title }}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">

                  <div class="col-sm-12">
                    <div class="position-relative p-3 bg-white" style="height: 230px">
                      <div class="ribbon-wrapper ribbon-xl">
                        <div class="ribbon bg-primary">
                          {{ $paymentsMethod->title }}
                        </div>
                      </div>
                       <br />
                      <center><small><img src="{{ asset($paymentsMethod->image) }}" width="100"></small></center>
                      <br>
                    </div>

                  </div>
                  
                </div>

                <div class="row">
                   <div class="col-sm-6">
                      <button type="button" class="btn btn-block btn-outline-primary" data-toggle="modal" data-target="#modal-default">
                  Ver enlace de pago
                </button>

                   </div>

                   <div class="col-sm-6">
                     <a href="{{ $paymentsMethod->processor_link }}" target="_blank"><button type="button" class="btn btn-block btn-outline-primary"><i class="fas fa-link"></i> Ir a {{ $paymentsMethod->title }}</button> </a>
                   </div>

                </div>



       <!-- MODAL PARA ENLACE -->

       <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Envia este enlace a tu paciente</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>{{ isset($paymentsMethod->details->code_link) ? route('payment.guest',$paymentsMethod->details->code_link) : "Tienes que crear un boton primero" }}</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Listo</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->




                <!-- END ALERTS AND CALLOUTS --><br>
        <h5 class="mt-4 mb-2 mt-10">Configura tu botón</h5><br><br>

        <div class="row">
          <div class="col-12">
            <!-- Custom Tabs -->
            
            

        <div class="row">
          <div class="col-12">
            <!-- Custom Tabs -->
            <div class="card card-light">
              <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Ajustes del botón</h3>
                <ul class="nav nav-pills ml-auto p-2">
                  <li class="nav-item">
                    <a class="nav-link active" href="#tab_1" data-toggle="tab">Ingresar Código</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#tab_2" data-toggle="tab">¿Como configurar?</a>
                  </li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                 <div class="tab-pane active col-6" id="tab_1">
                    <div class="form-group">
                        <form method="post" action="{{ route('update.payment.method',$paymentsMethod->id) }}">
                          @method('PUT')
                          @csrf
                          <label>Ingresa aquí tu botón obtenido desde {{ $paymentsMethod->title }}</label>
                          <br><textarea name="code_button" class="form-control" rows="2" placeholder="Pegar aquí ..." required>{{ isset($paymentsMethod->details->html) ? $paymentsMethod->details->html : "" }}</textarea><br>

                          <label>Ingresa el titulo para el pago</label>
                          <br><input name="title" type="text" class="form-control" placeholder="Por ejemplo consulta general ..." required value="{{ isset($paymentsMethod->details->title) ? $paymentsMethod->details->title : "" }}">

                          <div class="col-sm-4">
                            <br>
                            <button type="submit" class="btn btn-block btn-primary"><i class="fas fa-save"></i> Guardar</button>
                          </div>

                        </form>
                    
                    </div>
                    
                    <span>*Revisa el tutuorial desde la ¿Como configurar?</span>
                  </div>

                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                    {!! $paymentsMethod->instructions !!}

                  </div>
                 
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- ./card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
             

            <!-- ./card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- END CUSTOM TABS -->
        <!-- START PROGRESS BARS -->



               
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>

   
@endsection
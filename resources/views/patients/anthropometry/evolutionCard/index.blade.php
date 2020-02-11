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
                        <div class="col-md-5">
                            
                        </div><!-- ./col -->
                        <div class="col-md-7">
                            
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

@endsection
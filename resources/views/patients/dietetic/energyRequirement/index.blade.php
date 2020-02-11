@extends('layouts.admin')
@section('title')
Paciente: {{ $patient->name }}
@endsection
@section('extra-css')
<!-- easyautocomplete -->
<link rel="stylesheet" href="{{ asset('js/easyautocomplete/css/easy-autocomplete.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap-timepicker.min.css') }}">

@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary mt-4">
            <div class="card-header">
                <div class="card-title">Requerimiento energético</div>
            </div>
            
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 offset-md-2">
                            @if(isset($energy_requirement))
                            {!! Form::model($energy_requirement,['route'=> ['dietetic.energyRequirementUpdate', $energy_requirement->id],'method'=>'PUT','class'=>'form'])!!}
                                @include('patients.dietetic.energyRequirement.fieldsEdit')
                            {!! Form::close() !!}
                            @else
                            {!! Form::open(['route'=>'dietetic.energyRequirementStore','method'=>'POST','class'=>'form'])!!}
                                @include('patients.dietetic.energyRequirement.fields')
                            {!! Form::close() !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
<script>
    $('input[name="period"]').click(function(){
        
        if($(this).val() == 1)
        {
            $('.period-trimestry').css('display', 'none');
            $('.period-semestry').css('display', 'flex');
        }
        else
        {
            $('.period-semestry').css('display', 'none');
            $('.period-trimestry').css('display', 'flex');
        }
    
    });
</script>
@endsection
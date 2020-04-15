@extends('layouts.admin')
@section('title')
Paciente: {{ $patient->name }}
@endsection
@section('extra-css')
<!-- easyautocomplete -->

@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card mt-4">
            <div class="card-header">
                <div class="card-title">Medidas Corporales de {{ $patient->name }}
                    
                    <div class="dropdown show right">

                        <a href="{{ route('anthropometry.index', $patient->slug) }}" class="btn btn-primary">
                            Antropometría
                        </a>
                    
                        <a href="{{ route('ClinicHistoryPatient', $patient->slug) }}" class="btn btn-primary">
                            Historia Clínica
                        </a>
                        <a href="{{ route('dietetic.history.index', $patient->slug) }}" class="btn btn-primary">
                            Dietética
                        </a>
    
                    </div>

                </div>
                {{--<h3 class="mb-0">Medidas básicas</h3>--}}
            </div>
            
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::model($bodyMeasure,['route'=> ['anthropometry.bodyMeasureUpdate', $bodyMeasure->id],'method'=>'PUT','class'=>'form'])!!}
                            {!! Form::hidden('tab', '#impedancia_biolectrica') !!}
                            <input type="hidden" name="tab" value="@if(session()->has('tab')) {{ Session::get('tab') }} @else #impedancia_biolectrica @endif">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="impedancia_biolectrica-tab" data-toggle="tab" href="#impedancia_biolectrica" role="tab" aria-controls="impedancia_biolectrica" aria-selected="true">Impedancia bioeléctrica</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="detail-tab" data-toggle="tab" href="#pliegue" role="tab" aria-controls="pliegue" aria-selected="false">Pliegues</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="detail-tab" data-toggle="tab" href="#perimetro" role="tab" aria-controls="perimetro" aria-selected="false">Perimetros</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="detail-tab" data-toggle="tab" href="#diametro" role="tab" aria-controls="diametro" aria-selected="false">Diametros</a>
                                </li>
                            </ul>
                            
                              <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade show active p-4" id="impedancia_biolectrica" role="tabpanel" aria-labelledby="impedancia_biolectrica-tab">
                                    @include('patients.anthropometry.bodyMeasure.fields_impedancia_bioelectrica_edit')    
                                </div>
                                <div class="tab-pane fade p-4" id="pliegue" role="tabpanel" aria-labelledby="pliegue">
                                    @include('patients.anthropometry.bodyMeasure.fields_pliegues_edit')    
                                </div>
                                <div class="tab-pane fade p-4" id="perimetro" role="tabpanel" aria-labelledby="perimetro">
                                    @include('patients.anthropometry.bodyMeasure.fields_perimetros_edit') 
                                </div>
                                <div class="tab-pane fade p-4" id="diametro" role="tabpanel" aria-labelledby="diametro">
                                    <div class="col-10 offset-md-2">
                                        @include('patients.anthropometry.bodyMeasure.fields_diametros_edit') 
                                    </div>
                                </div>
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <a href="{{ route('anthropometry.index', $patient->slug) }}" class="btn btn-danger">Cancelar</a>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
{{--{{Session::get('result')}}--}}
<script>
    $('.nav-tabs > li a').click(function() {
                var tab_id = $(this).attr('href');
                $('input[name="tab"]').val(tab_id);
            });
</script>
@if(session()->has('tab'))
    <script>
        $(document).ready(function(){
           
            $('.tab-content > div.tab-pane').removeClass('show active');
            $('.nav-tabs > li a').removeClass('active')

            var tab_value = '{{ Session::get("tab") }}';
            console.log(tab_value);
            var tab = $( 'a[href="'+tab_value+'"]' );
            var content = $(tab_value);

            tab.addClass('active');
            content.addClass('show active');
            
            //$('.tab-content > div.tab-pane:last-child').addClass('show active');
            //$('.tabs > li:first-child').addClass('selected');
            /*$('.tabs > li a').click(function() {
                var tab_id = $(this).attr('href');
                $(tab_id).parent().children().hide();
                $(tab_id).fadeIn();
                $(this).parent().parent().children().removeClass('selected');
                $(this).parent().addClass('selected');
                return false;
            });*/
        });
    </script>
@endif
@endsection
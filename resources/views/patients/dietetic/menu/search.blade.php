@extends('layouts.admin')
@section('title')
Paciente: {{ $patient->name }}
@endsection

@section('extra-css')
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Busqueda de Platillos</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="s01">
                            <form method="GET" action="{{ route('menu.search', $patient->slug) }}">
                                <div class="inner-form">
                                    <div class="input-field first-wrap">
                                        <input id="search" name="search" type="text" value="@if(isset($search)) {{$search}} @endif" placeholder="Buscar alimento">
                                    </div>
                                    <div class="input-field third-wrap">
                                        <button class="btn-search" type="submit">Buscar</button>
                                    </div>
                                </div><!-- /. inner form -->
                            </form>
                        </div>
                    </div>
                </div><!-- /. row -->
                @if(isset($dishes))
                    @if(count($dishes) > 0)
                        <div class="row mt-4">
                            <div class="col-md-8 offset-md-2 text-center">
                                    <div class="bd-example">
                                        <button type="button" class="btn btn-primary mt-2 button-filter">Todos</button>
                                        @foreach($costs as $cost)
                                            @if($cost->cost != null)
                                                <button type="button" class="btn btn-primary mt-2 button-filter">{{ $cost->cost['name'] }}</button>
                                            @endif
                                        @endforeach
                                        @foreach($temperatures as $temp)
                                            @if($temp->temperature != null)
                                                <button type="button" class="btn btn-primary mt-2 button-filter">{{ $temp->temperature['name'] }}</button>
                                            @endif
                                        @endforeach
                                        @foreach($types as $type)
                                            @if($type->type != null)
                                                <button type="button" class="btn btn-primary mt-2 button-filter">{{ $type->type['name'] }}</button>
                                            @endif
                                        @endforeach
                                        @foreach($styles as $style)
                                            @if($style->style != null)
                                                <button type="button" class="btn btn-primary mt-2 button-filter">{{ $style->style['name'] }}</button>
                                            @endif
                                        @endforeach
                                    </div>
                            </div>
                        </div><!-- /. row -->
                        <div class="row mt-4">
                            <div class="col-md-12">
                                    <section class="details-card">
                                            <div class="container">
                                                <div class="row filtros">
                                                    @foreach($dishes as $dish)
                                                    <div class="col-md-4 mt-3 {{ $dish->cost['name'] }} {{ $dish->temperature['name'] }} {{ $dish->type['name'] }} {{ $dish->style['name'] }}">
                                                        <div class="card-content">
                                                            <div class="card-img">
                                                                <img src="@if($dish->image != null){{ asset('storage/dishes/'.$dish->image) }}@else {{ asset('images/platillo.png')  }} @endif" alt="{{ $dish['name'] }}">
                                                                
                                                            </div>
                                                            <div class="card-desc">
                                                                <h3>{{ $dish['name'] }}</h3>
                                                                <p>{{ $dish->notes }}</p>
                                                                    <a href="{{ route('dishes.show', $dish->id) }}" target="_blank" class="btn-card">Detalle</a>   
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    
                                                </div>
                                            </div>
                                        </section>
                                        <!-- details card section starts from here -->
                            </div>
                        </div>
                    @else
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="alert alert-danger" role="alert">
                                    <strong>Sin Resultados!</strong> No existen resultados para esta busqueda.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6 offset-md-4">
        <a class="btn btn-info" href="{{ route('dietetic.index', $patient->slug) }}">Ir a dietetica</a>
    </div>
</div>
@endsection

@section('extra-js')
<script>
    $(document).ready(function(){
        $('.button-filter').click(function(e){
            var textoFiltro = $(this).text().toLowerCase().replace(/\s/g,"-");
            
            if(textoFiltro == 'todos')
            {
                $('div.filtros div.hidden').fadeIn('slow').removeClass('hidden');
            }
            else
            {
                $('.filtros div.col-md-4').each(function()
                {
                    if(!$(this).hasClass(textoFiltro))
                    {
                        $(this).fadeOut('normal').addClass('hidden');
                    }
                    else
                    {
                        $(this).fadeIn('slow').removeClass('hidden');
                    }
                });
            }
            return false;
        });
    });
</script>
@endsection
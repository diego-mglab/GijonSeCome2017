@extends('layouts.web')

@section('contenido')
        <?php
        function normaliza ($cadena){
            $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
            $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
            //$cadena = utf8_decode($cadena);
            $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
            $cadena = strtolower($cadena);
            return utf8_encode($cadena);
        }
        use Carbon\Carbon;
        setlocale(LC_TIME, 'Spanish');
        $fecha_actual = '';
        $div_abierto = false;
        ?>
    <!-- comienza contenido de la página-->
    <section id="migadepan">
        <div class="col-xs-12">
            <ul>
                @foreach($breadcrums as $breadcrum)
                    <li>
                        {{$breadcrum[1]!=''?link_to_route($breadcrum[1].'_web_'.Session::get('idioma'),$title = strtoupper($breadcrum[0])):strtoupper($breadcrum[0])}}
                    </li>
                    @if(pos($breadcrum) != 'Programa')
                        <li>//</li>
                    @endif
                @endforeach
            </ul>
        </div>

    </section><!-- fin migadepan -->

    <!-- VERSIÓN pc se oculta cundo se ve desde un device menor de 768 -->
    <section id="agendapc">

        <div class="row">



            <!-- Page Content -->
            <div class="col-md-12 page-content">

                @foreach ($agenda as $evento)
                    <?php
                    $fecha = new DateTime($evento->fecha);
                    $fecha = Carbon::instance($fecha);
                    $dia = $fecha->formatLocalized('%d');
                    $diaSemana = utf8_encode($fecha->formatLocalized('%A'));
                    $tipo_evento = $evento->tipo_evento;
                    $hora = new DateTime($evento->hora);
                    $hora = Carbon::instance($hora);
                    $hora = $hora->formatLocalized('%H:%M');
                    $titulo = '';
                    $subtitulo = '';
                    $contenido = '';
                    if (is_object($evento->textos_idioma)){
                        $titulo = $evento->textos_idioma->titulo;
                        $subtitulo = $evento->textos_idioma->subtitulo;
                        $contenido = $evento->textos_idioma->contenido;
                    }
                    $zona = $evento->zona->nombre;
                    if ($fecha_actual != $evento->fecha) {
                        if ($div_abierto){
                            $div_abierto = false;
                            ?>
                    </div><!-- FIN {{normaliza($diaSemana)}}-->
                        <?php
                        }
                        ?>
                    <div class="col-md-4 {{normaliza($diaSemana)}}">
                        <header>{{$diaSemana}} {{__('agenda.dia')}} {{$dia}}</header>
                    <?php
                        $fecha_actual = $evento->fecha;
                        $div_abierto = true;
                    }
                    ?>

                        <article class="col-md-12 {{$tipo_evento}}">

                            <hgroup>
                                <h2><spam>{{$hora}}</spam> {{$titulo}}</h2>
                                <h3>{{$subtitulo}}</h3>
                            </hgroup>
                            {!! $contenido !!}
                            <p class="zonas">{{strtoupper($zona)}}</p>
                        </article>

                @endforeach

                <?php
                if ($div_abierto){ ?>
                    </div>
                <?php
                } ?>

            </div> <!-- FIN content-->

        </div>   <!-- FIN row-->

    </section><!-- FIN seccion agenda pc-->

    <!-- VERSIÓN movil y tablet se oculta cundo se ve desde un device mayor de 768 -->
    <section id="agendamovil">

        <!-- VERSIÓN MOVIL Y TABLET-->
        <div class="row">
            <!-- Page Content -->

            <!-- Page Content -->
            <div class="col-xs-12 page-content">

                <div class="tabs-section">

                    <!-- Nav Tabs -->
                    <ul class="nav nav-tabs">
                        <?php $cont = 1; ?>
                        @foreach ($dias_evento as $dia_evento)
                            <?php
                                if ($cont == 1){
                                    $activo = ' class="active"';
                                } else{
                                    $activo = '';
                                }
                            ?>
                            <li<?=$activo?>><a href="#tab-{{$cont}}" data-toggle="tab">{{$dia_evento}}</a></li>
                            <?php $cont++; ?>
                        @endforeach
                    </ul>

                    <!-- Tab panels -->
                    <div class="tab-content">
                        <?php
                        $fecha_actual = '';
                        $div_abierto = false;
                        $cont = 1;
                        ?>
                        @foreach ($agenda as $evento)
                            <?php
                            $fecha = new DateTime($evento->fecha);
                            $fecha = Carbon::instance($fecha);
                            $dia = $fecha->formatLocalized('%d');
                            $diaSemana = utf8_encode($fecha->formatLocalized('%A'));
                            $tipo_evento = $evento->tipo_evento;
                            $hora = new DateTime($evento->hora);
                            $hora = Carbon::instance($hora);
                            $hora = $hora->formatLocalized('%H:%M');
                            $titulo = '';
                            $subtitulo = '';
                            $contenido = '';
                            if (is_object($evento->textos_idioma)){
                                $titulo = $evento->textos_idioma->titulo;
                                $subtitulo = $evento->textos_idioma->subtitulo;
                                $contenido = $evento->textos_idioma->contenido;
                            }
                            $zona = $evento->zona->nombre;
                            if ($fecha_actual != $evento->fecha) {
                                if ($div_abierto){
                                    $cont++;
                                    $div_abierto = false;
                            ?>
                                        </div><!-- FIN row -->
                                    </div><!-- FIN {{normaliza($diaSemana)}}-->
                            <?php
                                }
                                $activo = '';
                                if ($cont == 1){
                                    $activo = ' active';
                                }
                            ?>
                        <!-- Tab Content {{$cont}} -->
                        <div class="tab-pane fade in{{$activo}}" id="tab-{{$cont}}">
                            <div class="row">
                                <?php
                                $fecha_actual = $evento->fecha;
                                $div_abierto = true;
                            }
                                ?>
                                <article class="col-xs-12 {{$tipo_evento}}">

                                    <hgroup>
                                        <h2><spam>{{$hora}} </spam>{{$titulo}}</h2>
                                        <h3>{{$subtitulo}}</h3>
                                    </hgroup>
                                    {!! $contenido !!}
                                    <p class="zonas">{{$zona}}</p>
                                </article>
                            @endforeach

                            <?php
                            if ($div_abierto){ ?>
                            </div>
                        </div>
                    <?php
                    } ?>
                    </div>
                    <!-- End Tab Panels -->

                </div>

            </div>
            <!-- End Page Content -->

        </div><!-- End row -->

    </section><!-- fin todas las noticias-->

@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/agenda.css')}}"/>
@endsection
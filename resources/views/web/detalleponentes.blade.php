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
                    @if ($breadcrum[0]!=$textosidioma->titulo)
                        {{$breadcrum[1]!=''?link_to_route($breadcrum[1].'_web_'.Session::get('idioma'),$title = strtoupper($breadcrum[0])):strtoupper($breadcrum[0])}}
                    @else
                        {{$ponente->anio==date('Y')?($breadcrum[1]!=''?link_to_route($breadcrum[1].'_web_'.Session::get('idioma'),$title = strtoupper($breadcrum[0])):strtoupper($breadcrum[0])):$breadcrum[1]!=''?link_to(Session::get('idioma').'/'.$breadcrum[1].'/'.$ponente->anio,$title=$breadcrum[0],$parameters=[]):$breadcrum[0]}}
                    @endif
                </li>
                    @if(pos($breadcrum) != $textosidioma->titulo)
                        <li>//</li>
                    @endif
                @endforeach
            </ul>
        </div>

    </section><!-- fin migadepan -->
    <section id="detallecocina">
        <div class="row">


            <div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class=" col-lg-4 col-md-4 col-sm-3 col-xs-12">
                    <picture>
                        <source media="(min-width: 1200px)" srcset="{{asset('images/chefs/l')}}/{{$ponente->imagen or 'sinimagen.png'}}"><!-- pc -->
                        <source media="(min-width: 992px)" srcset="{{asset('images/chefs/l')}}/{{$ponente->imagen or 'sinimagen.png'}}"><!-- medio pc -->
                        <source media="(min-width: 768px)" srcset="{{asset('images/chefs/m')}}/{{$ponente->imagen or 'sinimagen.png'}}"><!-- tablet -->

                        <!-- img tag for browsers that do not support picture element -->
                        <img src="{{asset('images/chefs/l')}}/{{$ponente->imagen or 'sinimagen.png'}}" alt="{{$textosidioma->titulo}}" class="img-responsive"><!-- movil -->
                    </picture>
                    <!-- agenda en lg md solo esta activo en versiónes de pc -->
                    <section id="agendapc">
                        @if(count($agenda) > 0)
                        <h1>intervenciones</h1>
                        @endif

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
                            if (is_object($evento)){
                                $titulo = $evento->titulo;
                                $subtitulo = $evento->subtitulo;
                                $contenido = $evento->contenido;
                            }
                            $zona = strtoupper($evento->nombre);
                            if ($fecha_actual != $evento->fecha) {
                                if ($div_abierto){
                                    $div_abierto = false;
                                ?>
                                    </div><!-- FIN {{normaliza($diaSemana)}}-->
                                </div><!-- FIN colmd 12-->
                                <?php
                                }
                            ?>
                            <div class="col-md-12">
                                <div class="{{normaliza($diaSemana)}}">
                                <header>{{strtoupper($diaSemana.' día '.$dia)}}</header>
                            <?php
                                $fecha_actual = $evento->fecha;
                                $div_abierto = true;
                            }
                                ?>
                                <article class="{{$tipo_evento}}">

                                    <hgroup>
                                        <h2><spam>{{$hora}}</spam>{{$titulo}}</h2>
                                        <h3>{{$subtitulo}}</h3>
                                    </hgroup>

                                    <p class="zonas">{{$zona}}</p>
                                </article>
                                    @endforeach

                                    <?php
                                    if ($div_abierto){ ?>
                            </div><!-- FIN {{normaliza($diaSemana)}}-->
                        </div><!-- FIN colmd 12-->
                                    <?php
                                    } ?>
                    </section>
                </div>
                <div class=" col-lg-8 col-md-8 col-sm-9 col-xs-12">
                    <div class="decoracion">
                        <h1>{{$textosidioma->titulo}}</h1>
                        <h2>{{$textosidioma->subtitulo}}</h2>
                        <img src="{{asset('images/graficos/mordiscogeneralup.png')}}" class="mordiscodet" alt="imagen decorativa"/>
                    </div>
                    <article class="columnas">
                        {!! $textosidioma->contenido !!}
                    </article>

                </div>

                <!-- agenda en sm xs esta parte solo esta activa en versión tablet y móvil-->
                <div class="col-sm-12 col-sm-offset-0 col-xs-12">
                    <section id="agendamov">
                        <h1>intervenciones</h1>
                        <div class="col-sm-6">

                            <div class="sabado">
                                <header>Sábado día 2</header>

                                <article class="showcooking">

                                    <hgroup>
                                        <h2><spam>12:00</spam>Show cooking con Marcos Morán y Borja Cortina</h2>
                                        <h3>"El lujo y lo valioso. Productos premium y productos humildes."</h3>
                                    </hgroup>

                                    <p class="zonas">ZONA COCINAS</p>
                                </article>


                                <article class="otros">

                                    <hgroup>
                                        <h2><spam>12:00</spam> Presentación y bienvenida</h2>
                                        <h3>Presentación</h3>
                                    </hgroup>
                                    <p class="zonas">GASTRO LIBRERÍA</p>
                                </article>
                            </div><!-- FIN sábado-->
                        </div><!-- FIN col sm y xs 6-->
                        <div class="col-sm-6 ">
                            <div class="sabado">
                                <header>Domingo día 3</header>

                                <article class="showcooking">

                                    <hgroup>
                                        <h2><spam>12:00</spam>Show cooking con Marcos Morán y Borja Cortina</h2>
                                        <h3>"El lujo y lo valioso. Productos premium y productos humildes."</h3>
                                    </hgroup>

                                    <p class="zonas">ZONA COCINAS</p>
                                </article>


                            </div><!-- FIN sábado-->




                        </div><!-- FIN col sm y xs 6-->
                        <div class="col-sm-6">
                            <div class="sabado">
                                <header>Lunes día 4</header>

                                <article class="showcooking">

                                    <hgroup>
                                        <h2><spam>12:00</spam>Show cooking con Marcos Morán y Borja Cortina</h2>
                                        <h3>"El lujo y lo valioso. Productos premium y productos humildes."</h3>
                                    </hgroup>

                                    <p class="zonas">ZONA COCINAS</p>
                                </article>


                            </div><!-- FIN sábado-->




                        </div><!-- FIN col sm y xs 6-->

                    </section>
                </div><!-- FIN agenda particular-->

            </div><!-- fin col 12 -->

        </div>  <!-- fin row -->
    </section><!-- fin  noticias-->


@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/detalle.css')}}"/>
@endsection
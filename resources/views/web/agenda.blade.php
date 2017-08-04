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
                        <header>{{$diaSemana}} día {{$dia}}</header>
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
                        <li class="active"><a href="#tab-1" data-toggle="tab">Sábado</a></li>
                        <li><a href="#tab-2" data-toggle="tab">Domingo</a></li>
                        <li><a href="#tab-3" data-toggle="tab">Lunes</a></li>
                    </ul>

                    <!-- Tab panels -->
                    <div class="tab-content">
                        <!-- Tab Content 1 -->
                        <div class="tab-pane fade in active" id="tab-1">
                            <div class="row">
                                <article class="col-xs-12 showcooking">

                                    <hgroup>
                                        <h2><spam>12:00 </spam>Show cooking con Marcos Morán y Borja Cortina</h2>
                                        <h3>"El lujo y lo valioso. Productos premium y productos humildes."</h3>
                                    </hgroup>
                                    <p>Marcos Morán, del Restaurante Casa Gerardo (1 estrella Michelin) realizará Cogollo a la crema; Pepino en declinación; Bagre frito; y Caviar y castañas. Todo ello maridado con los cócteles realizados por Borja Cortina.</p>
                                    <p class="zonas">ZONA PONENTES</p>
                                </article>
                                <article class="col-xs-12 ponencia">

                                    <hgroup>
                                        <h2><spam>14:00 </spam>"La producción y el consumo de alimentos como herramientas de conservación y transformación social." </h2>
                                        <h3>Ponencia Asturias Sostenible.</h3>
                                    </hgroup>
                                    <p>Impartida por Alberto Navarro, Segundo Menéndez y Francisco Blanco.</p>
                                    <p class="zonas">ZONA PONENTES</p>
                                </article>
                                <article class="col-xs-12 otros">

                                    <hgroup>
                                        <h2><spam>12:00 </spam>Presentación y bienvenida</h2>
                                        <h3>Presentación</h3>
                                    </hgroup>
                                    <p class="zonas">ZONA PONENTES</p>
                                </article>
                                <article class="col-xs-12 showcooking">

                                    <hgroup>
                                        <h2><spam>12:00 </spam>Show cooking con Marcos Morán y Borja Cortina</h2>
                                        <h3>"El lujo y lo valioso. Productos premium y productos humildes."</h3>
                                    </hgroup>
                                    <p>Marcos Morán, del Restaurante Casa Gerardo (1 estrella Michelin) realizará Cogollo a la crema; Pepino en declinación; Bagre frito; y Caviar y castañas. Todo ello maridado con los cócteles realizados por Borja Cortina.</p>
                                    <p class="zonas">ZONA PONENTES</p>
                                </article>
                                <article class="col-xs-12 ponencia">

                                    <hgroup>
                                        <h2><spam>14:00 </spam>"La producción y el consumo de alimentos como herramientas de conservación y transformación social." </h2>
                                        <h3>Ponencia Asturias Sostenible.</h3>
                                    </hgroup>
                                    <p>Impartida por Alberto Navarro, Segundo Menéndez y Francisco Blanco.</p>
                                    <p class="zonas">ZONA PONENTES</p>
                                </article>
                                <article class="col-xs-12 otros">

                                    <hgroup>
                                        <h2><spam>12:00 </spam> Presentación y bienvenida</h2>
                                        <h3>Presentación</h3>
                                    </hgroup>
                                    <p class="zonas">ZONA PONENTES</p>
                                </article>
                            </div>
                        </div>
                        <!-- Tab Content 2 -->
                        <div class="tab-pane fade" id="tab-2">
                            <div class="row">

                                <article class="col-xs-12 ponencia">

                                    <hgroup>
                                        <h2><spam>14:00 </spam>"La producción y el consumo de alimentos como herramientas de conservación y transformación social." </h2>
                                        <h3>Ponencia Asturias Sostenible.</h3>
                                    </hgroup>
                                    <p>Impartida por Alberto Navarro, Segundo Menéndez y Francisco Blanco.</p>
                                    <p class="zonas">ZONA PONENTES</p>
                                </article>
                                <article class="col-xs-12 otros">

                                    <hgroup>
                                        <h2><spam>12:00 </spam> Presentación y bienvenida</h2>
                                        <h3>Presentación</h3>
                                    </hgroup>
                                    <p class="zonas">ZONA PONENTES</p>
                                </article>
                                <article class="col-xs-12 showcooking">

                                    <hgroup>
                                        <h2><spam>12:00 </spam>Show cooking con Marcos Morán y Borja Cortina</h2>
                                        <h3>"El lujo y lo valioso. Productos premium y productos humildes."</h3>
                                    </hgroup>
                                    <p>Marcos Morán, del Restaurante Casa Gerardo (1 estrella Michelin) realizará Cogollo a la crema; Pepino en declinación; Bagre frito; y Caviar y castañas. Todo ello maridado con los cócteles realizados por Borja Cortina.</p>
                                    <p class="zonas">ZONA PONENTES</p>
                                </article>
                                <article class="col-xs-12 ponencia">

                                    <hgroup>
                                        <h2><spam>14:00 </spam>"La producción y el consumo de alimentos como herramientas de conservación y transformación social." </h2>
                                        <h3>Ponencia Asturias Sostenible.</h3>
                                    </hgroup>
                                    <p>Impartida por Alberto Navarro, Segundo Menéndez y Francisco Blanco.</p>
                                    <p class="zonas">ZONA PONENTES</p>
                                </article>
                                <article class="col-xs-12 otros">

                                    <hgroup>
                                        <h2><spam>12:00 </spam> Presentación y bienvenida</h2>
                                        <h3>Presentación</h3>
                                    </hgroup>
                                    <p class="zonas">ZONA PONENTES</p>
                                </article>
                            </div>
                        </div>
                        <!-- Tab Content 3 -->
                        <div class="tab-pane fade" id="tab-3">
                            <div class="row">
                                <article class="col-xs-12 showcooking">

                                    <hgroup>
                                        <h2><spam>12:00 </spam>Show cooking con Marcos Morán y Borja Cortina</h2>
                                        <h3>"El lujo y lo valioso. Productos premium y productos humildes."</h3>
                                    </hgroup>
                                    <p>Marcos Morán, del Restaurante Casa Gerardo (1 estrella Michelin) realizará Cogollo a la crema; Pepino en declinación; Bagre frito; y Caviar y castañas. Todo ello maridado con los cócteles realizados por Borja Cortina.</p>
                                    <p class="zonas">ZONA PONENTES</p>
                                </article>
                                <article class="col-xs-12 ponencia">

                                    <hgroup>
                                        <h2><spam>14:00 </spam>"La producción y el consumo de alimentos como herramientas de conservación y transformación social." </h2>
                                        <h3>Ponencia Asturias Sostenible.</h3>
                                    </hgroup>
                                    <p>Impartida por Alberto Navarro, Segundo Menéndez y Francisco Blanco.</p>
                                    <p class="zonas">ZONA PONENTES</p>
                                </article>
                                <article class="col-xs-12 otros">

                                    <hgroup>
                                        <h2><spam>12:00 </spam> Presentación y bienvenida</h2>
                                        <h3>Presentación</h3>
                                    </hgroup>
                                    <p class="zonas">ZONA PONENTES</p>
                                </article>
                                <article class="col-xs-12 showcooking">

                                    <hgroup>
                                        <h2><spam>12:00 </spam>Show cooking con Marcos Morán y Borja Cortina</h2>
                                        <h3>"El lujo y lo valioso. Productos premium y productos humildes."</h3>
                                    </hgroup>
                                    <p>Marcos Morán, del Restaurante Casa Gerardo (1 estrella Michelin) realizará Cogollo a la crema; Pepino en declinación; Bagre frito; y Caviar y castañas. Todo ello maridado con los cócteles realizados por Borja Cortina.</p>
                                    <p class="zonas">ZONA PONENTES</p>
                                </article>
                                <article class="col-xs-12 ponencia">

                                    <hgroup>
                                        <h2><spam>14:00 </spam>"La producción y el consumo de alimentos como herramientas de conservación y transformación social." </h2>
                                        <h3>Ponencia Asturias Sostenible.</h3>
                                    </hgroup>
                                    <p>Impartida por Alberto Navarro, Segundo Menéndez y Francisco Blanco.</p>
                                    <p class="zonas">ZONA PONENTES</p>
                                </article>
                                <article class="col-xs-12 otros">

                                    <hgroup>
                                        <h2><spam>12:00 </spam> Presentación y bienvenida</h2>
                                        <h3>Presentación</h3>
                                    </hgroup>
                                    <p class="zonas">ZONA PONENTES</p>
                                </article>
                            </div>
                        </div>
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
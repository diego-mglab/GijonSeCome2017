@extends('layouts.web')

@section('contenido')
    <!-- comienza contenido de la página-->
    <section id="migadepan">
        <div class="col-xs-12">
            <ul>
                @foreach($breadcrums as $breadcrum)
                <li>
                    {{$breadcrum[1]!=''?link_to_route($breadcrum[1].'_web_'.Session::get('idioma'),$title = strtoupper($breadcrum[0])):strtoupper($breadcrum[0])}}
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
                        <h1>intervenciones</h1>
                        <div class="col-md-12">

                            <div class="sabado">
                                <header>Sábado día 2</header>

                                <article class="showcooking">

                                    <hgroup>
                                        <h2><spam>12:00</spam>Show cooking con Marcos Morán y Borja Cortina</h2>
                                        <h3>"El lujo y lo valioso. Productos premium y productos humildes."</h3>
                                    </hgroup>

                                    <p class="zonas">ZONA COCINAS</p>
                                </article>

                                <article class="ponencia">

                                    <hgroup>
                                        <h2><spam>14:00</spam>"La producción y el consumo de alimentos como herramientas de conservación y transformación social." </h2>
                                        <h3>Ponencia Asturias Sostenible.</h3>
                                    </hgroup>

                                    <p class="zonas">ZONA PONENCIAS</p>
                                </article>

                                <article class="otros">

                                    <hgroup>
                                        <h2><spam>12:00</spam> Presentación y bienvenida</h2>
                                        <h3>Presentación</h3>
                                    </hgroup>
                                    <p class="zonas">GASTRO LIBRERÍA</p>
                                </article>
                            </div><!-- FIN sábado-->
                        </div><!-- FIN colmd 12-->
                        <div class="col-md-12">

                            <div class="sabado">
                                <header>Sábado día 2</header>

                                <article class="showcooking">

                                    <hgroup>
                                        <h2><spam>12:00</spam>Show cooking con Marcos Morán y Borja Cortina</h2>
                                        <h3>"El lujo y lo valioso. Productos premium y productos humildes."</h3>
                                    </hgroup>

                                    <p class="zonas">ZONA COCINAS</p>
                                </article>

                                <article class="ponencia">

                                    <hgroup>
                                        <h2><spam>14:00</spam>"La producción y el consumo de alimentos como herramientas de conservación y transformación social." </h2>
                                        <h3>Ponencia Asturias Sostenible.</h3>
                                    </hgroup>

                                    <p class="zonas">ZONA PONENCIAS</p>
                                </article>

                                <article class="otros">

                                    <hgroup>
                                        <h2><spam>12:00</spam> Presentación y bienvenida</h2>
                                        <h3>Presentación</h3>
                                    </hgroup>
                                    <p class="zonas">GASTRO LIBRERÍA</p>
                                </article>
                            </div><!-- FIN sábado-->
                        </div><!-- FIN colmd 12-->

                    </section>
                </div>
                <div class=" col-lg-8 col-md-8 col-sm-9 col-xs-12">
                    <div class="decoracion"><h1>{{$textosidioma->titulo}}</h1>
                        <img src="{{asset('images/graficos/mordiscogeneralup.png')}}" class="mordiscodet" alt="imagen decorativa"/> </div>
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
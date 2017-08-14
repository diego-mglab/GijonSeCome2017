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
                    @if(pos($breadcrum) != 'Noticias')
                        <li>//</li>
                    @endif
                @endforeach
            </ul>
        </div>

    </section><!-- fin migadepan -->
    <section id="todaslasnoticias">




        <div class="row">


            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row-eq-height">

                @for($i=0;$i<2;$i++)
                    <?php
                    $lugar = strtoupper($noticias[$i]->lugar);
                    $imagen = asset('images/contenido').'/l/'.$noticias[$i]->imagen or 'sinimagen.png';
                    $fecha='';
                    if ($noticias[$i]->fecha != ''){
                        $time= strtotime($noticias[$i]->fecha);
                        $fecha = date('d/m/Y',$time);
                    }
                    if (is_object($noticias[$i]->textos_idioma)){
                        $titulo = $noticias[$i]->textos_idioma->titulo;
                        $subtitulo = $noticias[$i]->textos_idioma->subtitulo;
                        $contenido = $noticias[$i]->getSubString($noticias[$i]->textos_idioma->contenido,150);
                        $ruta = str_replace('-','',$noticias[$i]->textos_idioma->slug).'_web_'.Session::get('idioma');
                    }
                    ?>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 {{$i==0?'destacadauna':'destacadados'}}">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <picture>
                            <!-- img tag for browsers that do not support picture element -->
                            <img src="{{$imagen}}" alt="..." class="img-responsive"><!-- movil -->
                        </picture>
                        <picture>
                            <source media="(min-width: 992px)" srcset="{{asset('images/graficos/A_mord.png')}}"><!-- pc -->
                            <source media="(min-width: 768px)" srcset="{{asset('images/graficos/A_mord.png')}}"><!-- tablet -->

                            <!-- img tag for browsers that do not support picture element -->
                            <img src="{{asset('images/graficos/A_mord_XS.png')}}" alt="imagen decorativa" class="mordisquitos"><!-- movil -->
                        </picture>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <article>
                            <hgroup>
                                <time>{{$lugar!=''?$lugar.'.':''}} {{$fecha}}</time>
                                <h1>{{link_to_route($ruta,$title=$titulo)}}</h1>
                                <h2>{{$subtitulo}}</h2>

                                <p>{{$contenido}}</p>
                            </hgroup>

                        </article>

                    </div>

                </div>
                @endfor
            </div>

        </div><!-- fin row -->


        <!-- noticias comunes todas las noticas sin destacar -->
        <section class="sindestacar">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


                    <!-- se repiten los cuatro primeros los dos últimos tienen una clase diferente -->
                    @for($i=2;$i<count($noticias);$i++)
                    <?php
                        $lugar = strtoupper($noticias[$i]->lugar);
                        $imagen = $noticias[$i]->imagen;
                        $fecha='';
                        if ($noticias[$i]->fecha != ''){
                            $time= strtotime($noticias[$i]->fecha);
                            $fecha = date('d/m/Y',$time);
                        }
                        if (is_object($noticias[$i]->textos_idioma)){
                            $titulo = $noticias[$i]->textos_idioma->titulo;
                            $subtitulo = $noticias[$i]->textos_idioma->subtitulo;
                            $contenido = $noticias[$i]->getSubString($noticias[$i]->textos_idioma->contenido,150);
                            $ruta = str_replace('-','',$noticias[$i]->textos_idioma->slug).'_web_'.Session::get('idioma');
                        }
                        ?>

                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 vira<?php $i%4==0||$i%4==1?' inversa':''?>">
                            <picture>
                                <source media="(min-width: 1200px)" srcset="{{asset('images/contenido/l')}}/{{$imagen or 'sinimagen.png'}}"><!-- pc -->
                                <source media="(min-width: 992px)" srcset="{{asset('images/contenido/m')}}/{{$imagen or 'sinimagen.png'}}"><!-- medio pc -->
                                <source media="(min-width: 768px)" srcset="{{asset('images/contenido/s')}}/{{$imagen or 'sinimagen.png'}}"><!-- tablet -->

                                <!-- img tag for browsers that do not support picture element -->
                                <img src="{{asset('images/contenido/l')}}/{{$imagen or 'sinimagen.png'}}" alt="..." class="img-responsive"><!-- movil -->
                            </picture>
                            <picture>

                                <source media="(min-width: 768px)" srcset="{{asset('images/graficos/noticia_a_lg.png')}}"><!-- tablet -->

                                <!-- img tag for browsers that do not support picture element -->
                                <img src="{{asset('images/graficos/noticia_a_xs.png')}}" alt="imagen decorativa" class="img-responsive mordisquitos"><!-- movil -->
                            </picture>


                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">


                            <time class="black">{{$lugar!=''?$lugar.'.':''}} {{$fecha}}</time>
                            <h1 class="white">{{link_to_route($ruta,$title=$titulo)}}</h1>


                        </div>

                    </div><!-- fin comun uno -->
                    @endfor
                </div><!-- fin sin destacar-->
            </div><!-- fin row-->
        </section>
    </section><!-- fin todas las noticias-->


@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/noticias.css')}}"/>
@endsection
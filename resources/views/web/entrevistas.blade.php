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
                    @if(pos($breadcrum) != 'entrevistas')
                        <li>//</li>
                    @endif
                @endforeach
            </ul>
        </div>

    </section><!-- fin migadepan -->
    <section id="todaslasentrevistas">




        <div class="row">


            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row-eq-height">

                @for($i=0;$i<2&&$i<count($entrevistas);$i++)
                    <?php
                    $lugar = strtoupper($entrevistas[$i]->lugar);
                    $imagen = asset('images/contenido').'/l/'.$entrevistas[$i]->imagen or 'sinimagen.png';
                    $fecha='';
                    $ruta = '';
                    $titulo = '';
                    $subtitulo = '';
                    if ($entrevistas[$i]->fecha != ''){
                        $time= strtotime($entrevistas[$i]->fecha);
                        $fecha = date('d/m/Y',$time);
                    }
                    if (is_object($entrevistas[$i]->textos_idioma)){
                        $titulo = $entrevistas[$i]->textos_idioma->titulo;
                        $subtitulo = $entrevistas[$i]->textos_idioma->subtitulo;
                        $ruta = str_replace('-','',$entrevistas[$i]->textos_idioma->slug).'_web_'.Session::get('idioma');
                        if ($i==0){
                            $imagen_mord = 'A_mord.png';
                            $imagen_mov = 'A_mord_XS.png';
                        } else {
                            $imagen_mord = 'destacadonoticiasB.png';
                            $imagen_mov = 'mordiscodestacadodosxs.png';
                        }
                    }
                    ?>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 {{$i==0?'destacadauna':'destacadados'}}">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <picture>
                            <!-- img tag for browsers that do not support picture element -->
                            <img src="{{$imagen}}" alt="..." class="img-responsive"><!-- movil -->
                        </picture>
                        <picture>
                            <source media="(min-width: 992px)" srcset="{{asset('images/graficos')}}/{{$imagen_mord}}"><!-- pc -->
                            <source media="(min-width: 768px)" srcset="{{asset('images/graficos')}}/{{$imagen_mord}}"><!-- tablet -->

                            <!-- img tag for browsers that do not support picture element -->
                            <img src="{{asset('images/graficos')}}/{{$imagen_mov}}" alt="imagen decorativa" class="mordisquitos"><!-- movil -->
                        </picture>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <article>
                            <hgroup>
                                <time>{{$lugar!=''?$lugar.'.':''}} {{$fecha}}</time>
                                <h1>{{$ruta!=''?link_to_route($ruta,$title=$titulo):$titulo}}</h1>
                                <h2>{{$subtitulo}}</h2>
                            </hgroup>

                        </article>

                    </div>

                </div>
                @endfor
            </div>

        </div><!-- fin row -->


        @if ($i<=count($entrevistas))
        <!-- entrevistas comunes todas las noticas sin destacar -->
        <section class="sindestacar">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


                    <!-- se repiten los cuatro primeros los dos últimos tienen una clase diferente -->
                    @for($i=2;$i<count($entrevistas);$i++)
                    <?php
                        $lugar = strtoupper($entrevistas[$i]->lugar);
                        $imagen = $entrevistas[$i]->imagen;
                        $fecha='';
                        $ruta = '';
                        $titulo = '';
                        if ($entrevistas[$i]->fecha != ''){
                            $time= strtotime($entrevistas[$i]->fecha);
                            $fecha = date('d/m/Y',$time);
                        }
                        if (is_object($entrevistas[$i]->textos_idioma)){
                            $titulo = $entrevistas[$i]->textos_idioma->titulo;
                            $ruta = str_replace('-','',$entrevistas[$i]->textos_idioma->slug).'_web_'.Session::get('idioma');
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

                                <source media="(min-width: 768px)" srcset="{{asset('images/graficos/entrevista_a_lg.png')}}"><!-- tablet -->

                                <!-- img tag for browsers that do not support picture element -->
                                <img src="{{asset('images/graficos/entrevista_a_xs.png')}}" alt="imagen decorativa" class="img-responsive mordisquitos"><!-- movil -->
                            </picture>


                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">


                            <time class="black">{{$lugar!=''?$lugar.'.':''}} {{$fecha}}</time>
                            <h1 class="white">{{$ruta!=''?link_to_route($ruta,$title=$titulo):$titulo}}</h1>


                        </div>

                    </div><!-- fin comun uno -->
                    @endfor
                </div><!-- fin sin destacar-->
            </div><!-- fin row-->
        </section>
    </section><!-- fin todas las entrevistas-->
    @endif


@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/entrevistas.css')}}"/>
@endsection
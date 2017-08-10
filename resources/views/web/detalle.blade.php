@extends('layouts.web')

@section('contenido')
<?php
    $fecha='';
    if ($content->fecha != ''){
        $time= strtotime($content->fecha);
        $fecha = date('d/m/Y',$time);
    }
        ?>
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
    <section id="noticias">
        <div class="row">
            <div class="col-xs-12">
                <article>
                    <hgroup>

                        <h1>{{$textosidioma->titulo}}</h1>
                        <h2>{{$textosidioma->subtitulo}}</h2>
                        <h3>{{$content->lugar!=''?strtoupper($content->lugar).'.':''}} {{$fecha}}</h3>
                    </hgroup>
                    <div class="columnas">
                        {!! $textosidioma->contenido !!}
                    </div><!-- fin columnas -->
                    @if ($content->imagen != '')
                    <picture>
                        <source media="(min-width: 1200px)" srcset="{{asset('images/contenido/l')}}/{{$content->imagen or 'sinimagen.png'}}"><!-- pc -->
                        <source media="(min-width: 992px)" srcset="{{asset('images/contenido/m')}}/{{$content->imagen or 'sinimagen.png'}}"><!-- medio pc -->
                        <source media="(min-width: 768px)" srcset="{{asset('images/contenido/s')}}/{{$content->imagen or 'sinimagen.png'}}"><!-- tablet -->

                        <!-- img tag for browsers that do not support picture element -->
                        <img src="{{asset('images/contenido/l')}}/{{$content->imagen or 'sinimagen.png'}}" alt="{{$textosidioma->titulo}}" class="img-responsive"><!-- movil -->
                    </picture>
                    @endif
                </article>




            </div><!-- fin col 12 -->

        </div>  <!-- fin row -->
    </section><!-- fin  noticias-->

@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/detalle.css')}}"/>
@endsection
@extends('layouts.web')

@section('contenido')

    <!-- comienza contenido de la página-->
    <section id="migadepan">
        <div class="col-xs-12">
            <ul>
                <li>INICIO</li>
                <li>//</li>
                <li><a href="#">EL FESTIVAL</a></li>
                <li>//</li>
                <li>TÍO KIM</li>
            </ul>
        </div>

    </section><!-- fin migadepan -->

    <!-- Start Content -->
    <div id="content">



        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 todosloschefs">

            <hgroup>
                <h1>Descubre quién nos acompaño/acompañará en GijónSeCome</h1>
                <h2>COCINEROS, PONENTES, BLOGUEROS, ETC.</h2>
            </hgroup>
        </div>

        <?php
        $contador = 1;
        $elementos = count($ponentes);
        ?>
        @foreach ($ponentes as $ponente)
            @if ($contador == 1)
            <?php
                $idioma_actual = Session::get('idioma');
                //se muestran los 4 primeros chefs luego en el siguiente div general se muestran todos menos estos cuatro
            ?>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

                <div class="portfolio-3column">
                    <ul id="portfolio-list" data-animated="fadeIn">
            @endif
                        <li>
                            <img src="{{asset('images/chefs/m')}}/{{$ponente->imagen or 'sinimagen.png'}}" alt="" />
                            <div class="portfolio-item-content">
                                <span class="header">{{is_object($ponente->textos_idioma)?$ponente->textos_idioma->titulo:''}}</span>
                                <p class="body">{{is_object($ponente->textos_idioma)?$ponente->textos_idioma->subtitulo:''}}</p>
                            </div>
                            <a href="{{route('detalleponentes_web_'.$idioma_actual,[is_object($ponente->textos_idioma)?$ponente->textos_idioma->slug:''])}}"><i class="more">+</i></a>

                        </li>
            @if ($contador == 4 && $elementos>4)
                </ul>

            </div>

        </div><!-- fin col lg8 -->

        <?php //se muestran todos los chefs excepto los cuatro primeros
        ?>

        <div class="col-lg-12">
            <div class="portfolio-4column">
                <ul id="portfolio-list" data-animated="fadeIn">
            @endif
            <?php
            $contador++;
            ?>
        @endforeach
                </ul>




            </div>     <!-- End Portfolio Items -->

        </div><!-- fin col lg12 -->





    </div><!-- fin contentr -->

@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/chefs.css')}}"/>
@endsection
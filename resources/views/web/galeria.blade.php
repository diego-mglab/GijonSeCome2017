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
                    @if(pos($breadcrum) != 'Galería')
                        <li>//</li>
                    @endif
                @endforeach
            </ul>
        </div>

    </section><!-- fin migadepan -->




    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 todosloschefs">

        <hgroup>
            @if ($anio != '2016')
                <h1>Galería fotográfica: Festival gastronómico y sostenible de Asturias</h1>
                <h2>Gijón se come {{date('Y')}}</h2>
            @else
                <h1>Galería fotográfica: Primer festival gastronómico y sostenible de Asturias</h1>
                <h2>Gijón se come 2016</h2>
            @endif
        </hgroup>
    </div>
    <?php
    $contador = 1;
    $elementos = count($galeria);
    ?>
    @foreach ($galeria as $elemento)
        @if ($contador == 1)
            <?php
            $idioma_actual = Session::get('idioma');
            //se muestran las 4 primeras galerías luego en el siguiente div general se muestran todas menos estas cuatro
            ?>
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

        <div class=" gallery-post portfolio-3column">

            <ul id="portfolio-list" data-animated="fadeIn">
                @endif
                <li>

                    <div class="portfolio-item item">
                        <div class="portfolio-border">
                            <div class="portfolio-thumb">
                                <a class="lightbox" title="This is an image title" href="images/fotos/01.jpg" data-lightbox-gallery="gallery1">
                                    <div class="thumb-overlay"><i class="fa fa-arrows-alt"></i></div>
                                    <img alt="" src="images/fotos/01.jpg"/>
                                </a>
                            </div>
                            <div class="portfolio-details">

                            </div>
                        </div>
                    </div>
                </li>
                @if ($contador == 4 && $elementos>4)
            </ul>
        </div>
    </div>

            <?php //se muestran todas las galerías excepto las cuatro primeras
            ?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class=" portfolio-page portfolio-4column">

            <ul id="portfolio-list" data-animated="fadeIn">
                @endif
                <?php
                $contador++;
                ?>
                @endforeach
            </ul>

        </div>

    </div>


@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/galeria.css')}}"/>
@endsection
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
                <h1>{{__('galeria.festival_gastronomico')}}</h1>
                <h2>{{__('galeria.gijonsecome')}} {{date('Y')}}</h2>
            @else
                <h1>{{__('galeria.primer_festival')}}</h1>
                <h2>{{__('galeria.gijonsecome')}} 2016</h2>
            @endif
        </hgroup>
    </div>
    @if (isset($multimedia))
        <?php
        $contador = 1;
        $elementos = count($multimedia);
        ?>
        @foreach ($multimedia as $elemento)
            <?php
                $titulo = '';
                if (is_object($elemento->textos_idioma)){
                    $titulo = $elemento->textos_idioma->titulo;
                }
            ?>
            @if ($contador == 1)
                <?php
                $idioma_actual = Session::get('idioma');
                //se muestran las 4 primeras imagenes luego en el siguiente div general se muestran todas menos estas cuatro
                ?>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

            <div class=" gallery-post portfolio-3column">

                <ul id="portfolio-list" data-animated="fadeIn">
            @endif
                    <li>
                        <div class="portfolio-item item">
                            <div class="portfolio-border">
                                <div class="portfolio-thumb">
                                    <a class="lightbox" title="{{$titulo}}" href="{{asset('images/galerias/'.$galeria->carpeta)}}/{{$elemento->imagen or 'sinimagen.png'}}" data-lightbox-gallery="gallery1">
                                        <div class="thumb-overlay"><i class="fa fa-arrows-alt"></i></div>
                                        <img alt="{{$titulo}}" src="{{asset('images/galerias/'.$galeria->carpeta.'/th')}}/{{$elemento->imagen or 'sinimagen.png'}}"/>
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

                <?php //se muestran todas las imagenes excepto las cuatro primeras
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
    @endif

@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/galeria.css')}}"/>
@endsection
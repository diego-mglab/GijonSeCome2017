
<?php
$idioma_actual = Session::get('idioma');
?>
<section id="chefs">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row-eq-height chefs" >
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 ">
                <h1><a href="{{route('ponentes_web_'.$idioma_actual)}}">{{__('inicio.quien_nos_acompanara')}}</a></h1>

            </div>
            <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12" >
                <div class="clients-carousel">
                    <div class="projects-carousel touch-carousel owl-carousel owl-theme" data-appeared-items="5">

                        @foreach ($ponentes as $ponente)
                            <div class="client-item item">
                                <div class="imagenchef">

                                    <div class="portfolio-thumb">
                                        <a  href="{{route('detalleponentes_web_'.$idioma_actual,[is_object($ponente->textos_idioma)?$ponente->textos_idioma->slug:''])}}">
                                            <img alt="" src="{{asset('images/chefs/s')}}/{{$ponente->imagenslide or 'sinimagen.png'}}" />
                                        </a>
                                    </div>
                                    <div class="nombrechef">

                                        <h4>{{is_object($ponente->textos_idioma)?$ponente->textos_idioma->titulo:''}}</h4>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!--End Clients Carousel-->
            </div>
            <!-- fin 10 -->

        </div><!-- fin 12 -->
    </div><!-- fin row -->
</section>
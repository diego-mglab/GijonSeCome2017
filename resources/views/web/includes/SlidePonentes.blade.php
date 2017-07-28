
<section id="chefs">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row-eq-height chefs" >
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 ">
                <h1><a href="#">Quien nos acompañó en la pasada edición</a></h1>

            </div>
            <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12" >
                <div class="clients-carousel">
                    <div class="projects-carousel touch-carousel owl-carousel owl-theme" data-appeared-items="5">

                        @foreach ($ponentes as $ponente)
                            <div class="client-item item">
                                <div class="imagenchef">

                                    <div class="portfolio-thumb">
                                        <a  href="detalleponentes/4">
                                            <img alt="" src="{{asset('images/ponentes/s')}}/{{$ponente->imagen or 'sinimagen.png'}}" />
                                        </a>
                                    </div>
                                    <div class="nombrechef">

                                        <h4>{{$ponente->textos_idioma->titulo}}</h4>

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
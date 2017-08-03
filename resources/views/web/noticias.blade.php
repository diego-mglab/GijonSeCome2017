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
    <section id="todaslasnoticias">




        <div class="row">


            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row-eq-height">

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 destacadauna">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <picture>
                            <!-- img tag for browsers that do not support picture element -->
                            <img src="{{asset('images/fotos/destacadauna.png')}}" alt="..." class="img-responsive"><!-- movil -->
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
                                <time>GIJÓN. 24/04/2017</time>
                                <h1><a href="#">Titular de página interior. Kim Ossemblok posa como un auténtico maizón.</a></h1>
                                <h2>SUBTÍTULO DE PÁGINA INTERIOR. KIM ESTÁ HASTA LA POLLA DE POSAR.</h2>

                                <p>Texto general de página interior. Kim es más de té. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>
                            </hgroup>

                        </article>

                    </div>

                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 destacadados">

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <picture>
                            <!-- img tag for browsers that do not support picture element -->
                            <img src="images/fotos/destacadauna.png" alt="..." class="img-responsive"><!-- movil -->
                        </picture>
                        <picture>
                            <source media="(min-width: 992px)" srcset="images/graficos/destacadonoticiasB.png"><!-- pc -->
                            <source media="(min-width: 768px)" srcset="images/graficos/destacadonoticiasB.png"><!-- tablet -->

                            <!-- img tag for browsers that do not support picture element -->
                            <img src="images/graficos/mordiscodestacadodosxs.png" alt="imagen decorativa" class="mordisquitos"><!-- movil -->
                        </picture>

                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <article>
                            <hgroup>
                                <h3>ANTETÍTULO. FIRMA DE LIBROS</h3>
                                <h1><a href="#">Titular de página interior. Kim Ossemblok posa como un auténtico maizón.</a></h1>
                                <h2>SUBTÍTULO DE PÁGINA INTERIOR. KIM ESTÁ HASTA LA POLLA DE POSAR.</h2>

                                <time>GIJÓN. 24/04/2017</time>
                            </hgroup>
                            <p>Texto general de página interior. Kim es más de té. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>
                        </article>
                    </div>


                </div>
            </div>

        </div><!-- fin row -->


        <!-- noticias comunes todas las noticas sin destacar -->
        <section class="sindestacar">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


                    <!-- se repiten los cuatro primeros los dos últimos tienen una clase diferente -->


                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 vira">
                            <picture>
                                <source media="(min-width: 1200px)" srcset="images/pc/06.png"><!-- pc -->
                                <source media="(min-width: 992px)" srcset="images/laptop/06.png"><!-- medio pc -->
                                <source media="(min-width: 768px)" srcset="images/tablet/06.png"><!-- tablet -->

                                <!-- img tag for browsers that do not support picture element -->
                                <img src="images/smartphone/06.png" alt="..." class="img-responsive"><!-- movil -->
                            </picture>
                            <picture>

                                <source media="(min-width: 768px)" srcset="images/graficos/noticia_a_lg.png"><!-- tablet -->

                                <!-- img tag for browsers that do not support picture element -->
                                <img src="images/graficos/noticia_a_xs.png" alt="imagen decorativa" class="img-responsive mordisquitos"><!-- movil -->
                            </picture>


                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">


                            <h1 class="white"><a href="#">Estos 3 elementos tienen pinta de mangarla cuando cierran el bus.</a></h1>
                            <time class="black">GIJÓN. 24/04/2017</time>


                        </div>

                    </div><!-- fin comun uno -->
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 vira">
                            <picture>
                                <source media="(min-width: 1200px)" srcset="images/pc/06.png"><!-- pc -->
                                <source media="(min-width: 992px)" srcset="images/laptop/06.png"><!-- medio pc -->
                                <source media="(min-width: 768px)" srcset="images/tablet/06.png"><!-- tablet -->

                                <!-- img tag for browsers that do not support picture element -->
                                <img src="images/smartphone/06.png" alt="..." class="img-responsive"><!-- movil -->
                            </picture>
                            <picture>

                                <source media="(min-width: 768px)" srcset="images/graficos/noticia_b_LG.png"><!-- tablet -->

                                <!-- img tag for browsers that do not support picture element -->
                                <img src="images/graficos/noticia_b_xs.png" alt="imagen decorativa" class="img-responsive mordisquitos"><!-- movil -->
                            </picture>

                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">


                            <h1 class="black"><a href="#">Titular de página interior. Kim Ossemblok posa como un auténtico maizón.</a></h1>
                            <time class="white">GIJÓN. 24/04/2017</time>


                        </div>
                    </div><!-- fin comun dos -->

                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 vira inversa">
                            <picture>
                                <source media="(min-width: 1200px)" srcset="images/pc/06.png"><!-- pc -->
                                <source media="(min-width: 992px)" srcset="images/laptop/06.png"><!-- medio pc -->
                                <source media="(min-width: 768px)" srcset="images/tablet/06.png"><!-- tablet -->

                                <!-- img tag for browsers that do not support picture element -->
                                <img src="images/smartphone/06.png" alt="..." class="img-responsive"><!-- movil -->
                            </picture>
                            <picture>

                                <source media="(min-width: 768px)" srcset="images/graficos/noticia_a_lg.png"><!-- tablet -->

                                <!-- img tag for browsers that do not support picture element -->
                                <img src="images/graficos/noticia_a_xs.png" alt="imagen decorativa" class="img-responsive mordisquitos"><!-- movil -->
                            </picture>


                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">


                            <h1 class="white"><a href="#">Estos 3 elementos tienen pinta de mangarla cuando cierran el bus.</a></h1>
                            <time class="black">GIJÓN. 24/04/2017</time>


                        </div>

                    </div><!-- fin comun uno -->
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 vira inversa">
                            <picture>
                                <source media="(min-width: 1200px)" srcset="images/pc/06.png"><!-- pc -->
                                <source media="(min-width: 992px)" srcset="images/laptop/06.png"><!-- medio pc -->
                                <source media="(min-width: 768px)" srcset="images/tablet/06.png"><!-- tablet -->

                                <!-- img tag for browsers that do not support picture element -->
                                <img src="images/smartphone/06.png" alt="..." class="img-responsive"><!-- movil -->
                            </picture>
                            <picture>

                                <source media="(min-width: 768px)" srcset="images/graficos/noticia_b_LG.png"><!-- tablet -->

                                <!-- img tag for browsers that do not support picture element -->
                                <img src="images/graficos/noticia_b_xs.png" alt="imagen decorativa" class="img-responsive mordisquitos"><!-- movil -->
                            </picture>

                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">


                            <h1 class="black"><a href="#">Titular de página interior. Kim Ossemblok posa como un auténtico maizón.</a></h1>
                            <time class="white">GIJÓN. 24/04/2017</time>


                        </div>
                    </div><!-- fin comun dos -->

                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 vira">
                            <picture>
                                <source media="(min-width: 1200px)" srcset="images/pc/06.png"><!-- pc -->
                                <source media="(min-width: 992px)" srcset="images/laptop/06.png"><!-- medio pc -->
                                <source media="(min-width: 768px)" srcset="images/tablet/06.png"><!-- tablet -->

                                <!-- img tag for browsers that do not support picture element -->
                                <img src="images/smartphone/06.png" alt="..." class="img-responsive"><!-- movil -->
                            </picture>
                            <picture>

                                <source media="(min-width: 768px)" srcset="images/graficos/noticia_a_lg.png"><!-- tablet -->

                                <!-- img tag for browsers that do not support picture element -->
                                <img src="images/graficos/noticia_a_xs.png" alt="imagen decorativa" class="img-responsive mordisquitos"><!-- movil -->
                            </picture>


                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">


                            <h1 class="white"><a href="#">Estos 3 elementos tienen pinta de mangarla cuando cierran el bus.</a></h1>
                            <time class="black">GIJÓN. 24/04/2017</time>


                        </div>

                    </div><!-- fin comun uno -->
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 vira">
                            <picture>
                                <source media="(min-width: 1200px)" srcset="images/pc/06.png"><!-- pc -->
                                <source media="(min-width: 992px)" srcset="images/laptop/06.png"><!-- medio pc -->
                                <source media="(min-width: 768px)" srcset="images/tablet/06.png"><!-- tablet -->

                                <!-- img tag for browsers that do not support picture element -->
                                <img src="images/smartphone/06.png" alt="..." class="img-responsive"><!-- movil -->
                            </picture>
                            <picture>

                                <source media="(min-width: 768px)" srcset="images/graficos/noticia_b_LG.png"><!-- tablet -->

                                <!-- img tag for browsers that do not support picture element -->
                                <img src="images/graficos/noticia_b_xs.png" alt="imagen decorativa" class="img-responsive mordisquitos"><!-- movil -->
                            </picture>

                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">


                            <h1 class="black"><a href="#">Titular de página interior. Kim Ossemblok posa como un auténtico maizón.</a></h1>
                            <time class="white">GIJÓN. 24/04/2017</time>


                        </div>
                    </div><!-- fin comun dos -->

                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 vira inversa">
                            <picture>
                                <source media="(min-width: 1200px)" srcset="images/pc/06.png"><!-- pc -->
                                <source media="(min-width: 992px)" srcset="images/laptop/06.png"><!-- medio pc -->
                                <source media="(min-width: 768px)" srcset="images/tablet/06.png"><!-- tablet -->

                                <!-- img tag for browsers that do not support picture element -->
                                <img src="images/smartphone/06.png" alt="..." class="img-responsive"><!-- movil -->
                            </picture>
                            <picture>

                                <source media="(min-width: 768px)" srcset="images/graficos/noticia_a_lg.png"><!-- tablet -->

                                <!-- img tag for browsers that do not support picture element -->
                                <img src="images/graficos/noticia_a_xs.png" alt="imagen decorativa" class="img-responsive mordisquitos"><!-- movil -->
                            </picture>


                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">


                            <h1 class="white"><a href="#">Estos 3 elementos tienen pinta de mangarla cuando cierran el bus.</a></h1>
                            <time class="black">GIJÓN. 24/04/2017</time>


                        </div>

                    </div><!-- fin comun uno -->
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 vira inversa">
                            <picture>
                                <source media="(min-width: 1200px)" srcset="images/pc/06.png"><!-- pc -->
                                <source media="(min-width: 992px)" srcset="images/laptop/06.png"><!-- medio pc -->
                                <source media="(min-width: 768px)" srcset="images/tablet/06.png"><!-- tablet -->

                                <!-- img tag for browsers that do not support picture element -->
                                <img src="images/smartphone/06.png" alt="..." class="img-responsive"><!-- movil -->
                            </picture>
                            <picture>

                                <source media="(min-width: 768px)" srcset="images/graficos/noticia_b_LG.png"><!-- tablet -->

                                <!-- img tag for browsers that do not support picture element -->
                                <img src="images/graficos/noticia_b_xs.png" alt="imagen decorativa" class="img-responsive mordisquitos"><!-- movil -->
                            </picture>

                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">


                            <h1 class="black"><a href="#">Titular de página interior. Kim Ossemblok posa como un auténtico maizón.</a></h1>
                            <time class="white">GIJÓN. 24/04/2017</time>


                        </div>
                    </div><!-- fin comun dos -->


                </div><!-- fin sin destacar-->
            </div><!-- fin row-->
        </section>
    </section><!-- fin todas las noticias-->


@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/noticias.css')}}"/>
@endsection
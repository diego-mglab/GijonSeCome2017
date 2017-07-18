@extends('layouts.LayoutWeb')

@section('contenido')


@include('web.includes.ArticulosPortada')
@include('web.includes.SlidePonentes')


@endsection




























        <!doctype html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
<html lang="es">

<head>
    <!-- OJO tiene un css único gijonsecome.css-->
    <!-- Basic -->
    <title>Gijon beta test</title>

    <!-- Define Charset -->
    <meta charset="utf-8">

    <!-- Responsive Metatag -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Page Description and Author -->
    <meta name="description" content="gijon se come">
    <meta name="author" content="www.mglab.es">

    <!-- Bootstrap CSS  -->
    <link rel="stylesheet" href="asset/css/bootstrap.min.css" type="text/css" media="screen">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" media="screen">

    <!-- Slicknav -->
    <link rel="stylesheet"  href="css/slicknav.css" type="text/css" media="screen">

    <!-- Margo CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen">

    <!-- Responsive CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="css/responsive.css" media="screen">

    <!-- Css3 Transitions Styles  -->
    <link rel="stylesheet"  href="css/animate.css" type="text/css" media="screen">

    <!-- Color CSS Styles  -->

    <link rel="stylesheet" type="text/css" href="css/colors/jade.css" title="jade" media="screen" />



    <!-- Margo JS  -->
    <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="js/jquery.migrate.js"></script>
    <script type="text/javascript" src="js/modernizrr.js"></script>
    <script type="text/javascript" src="asset/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.fitvids.js"></script>
    <script type="text/javascript" src="js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="js/nivo-lightbox.min.js"></script>
    <script type="text/javascript" src="js/jquery.isotope.min.js"></script>
    <script type="text/javascript" src="js/jquery.appear.js"></script>
    <script type="text/javascript" src="js/count-to.js"></script>
    <script type="text/javascript" src="js/jquery.textillate.js"></script>
    <script type="text/javascript" src="js/jquery.lettering.js"></script>
    <script type="text/javascript" src="js/jquery.easypiechart.min.js"></script>
    <script type="text/javascript" src="js/jquery.nicescroll.min.js"></script>
    <script type="text/javascript" src="js/jquery.parallax.js"></script>
    <script type="text/javascript" src="js/jquery.slicknav.js"></script>

    <!--[if IE 8]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

    <!-- mglab -->
    <link href="https://fonts.googleapis.com/css?family=Cormorant:400,600,600i|Source+Sans+Pro:300,400,400i" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="css/gijonsecome.css"/>
</head>

<body>

<!-- Container -->
<div id="container">


    <!-- Start Header -->
    <div class="hidden-header"></div>
    <header>

        <!-- Start Top Bar -->
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <!-- Start Contact Info -->
                        <ul class="contact-details">
                            <li><a href="#"><i class="fa fa-map-marker"></i> Recinto Ferial Luis Adaro</a>
                            </li>
                            <li><a href="mialto:info@gijonsecome.es"><i class="fa fa-envelope-o"></i> info@gijonsecome.es</a>
                            </li>
                            <li><a href="#"><i class="fa fa-phone"></i>+34 984 05 04 09</a></li>
                            <li><a href="#"><i class="fa fa-mobile"></i>+34 658 05 73 38</a></li>
                        </ul>
                        <!-- End Contact Info -->
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                        <!-- idiomas -->
                        <ul class="social-list idiomas">
                            <li>
                                <a class="itl-tooltip" data-placement="bottom" title="Castellano" href=""><i class="fa">CAS</i></a>
                            </li>
                            <li>
                                <a class="itl-tooltip" data-placement="bottom" title="Asturianu" href="ast"><i class="fa">AST</i></a>
                            </li>
                        </ul>
                        <!-- fin idiomas -->



                        <!-- Start Social Links -->
                        <ul class="social-list idiomas">
                            <li>
                                <a class="facebook itl-tooltip" data-placement="bottom" title="Facebook" href="https://facebook.com/gijonsecome" target="new"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a class="twitter itl-tooltip" data-placement="bottom" title="Twitter" href="https://twitter.com/gijonsecome" target="new"><i class="fa fa-twitter"></i></a>
                            </li>

                            <li>
                                <a class="instgram itl-tooltip" data-placement="bottom" title="Instagram" href="https://www.instagram.com/gijonsecome/" target="new"><i class="fa fa-instagram"></i></a>
                            </li>
                            <li>
                                <a class="google itl-tooltip" data-placement="bottom" title="Google Plus" href="https://plus.google.com/b/118212033616852336692/+GijonsecomeEs" target="new"><i class="fa fa-google-plus"></i></a>
                            </li>

                            <li>
                                <a class="google itl-tooltip" data-placement="bottom" title="youtube" href="https://www.youtube.com/channel/UC0Pwb36yxSlDTZhcXzZZLKQ" target="new"><i class="fa fa-youtube"></i></a>
                            </li>


                        </ul>
                        <!-- End Social Links -->


                    </div>
                </div>
            </div>
        </div>
        <!-- End Top Bar -->

        <!-- Start Header ( Logo & Naviagtion ) -->
        <div class="navbar gijonsecome navbar-default navbar-top">
            <div class="container">

                <div class="navbar-header">

                    <!-- Stat Toggle Nav Link For Mobiles -->
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- End Toggle Nav Link For Mobiles -->
                    <a href="index.html"><picture>
                            <source media="(min-width: 1200px)" srcset="images/graficos/logo_cabLG.png"><!-- pc -->
                            <source media="(min-width: 992px)" srcset="images/graficos/logo_cabMD.png"><!-- pc medio- tablet  -->
                            <source media="(min-width: 768px)" srcset="images/graficos/logo_cabXS.png"><!-- tablet -->
                            <!-- img tag for browsers that do not support picture element -->
                            <img src="images/graficos/logo_cabXS.png" alt="logo gijón se come" class="logo img-responsive" border="0"><!-- movil -->

                        </picture></a>

                </div>
                <div class="navbar-collapse collapse">
                    <!--Menu pc -->
                    <!-- Start Navigation List -->
                    <ul class="nav navbar-nav navbar-right">



                        <li> <a href="#">Inicio</a>


                            <ul class="dropdown">
                            </ul></li>

                        <li> <a href="noticias.html">El Festival</a>


                            <ul class="dropdown">


                                <li>  <a href="detallenoticia.html">Nuestra filosof&iacute;a</a>




                                <li>  <a href="detallenoticia.html">Gij&oacute;nSeCome es sostenible</a>


                            </ul></li>

                        <li> <a href="#">Primera edici&oacute;n</a>


                            <ul class="dropdown">

                                <li>  <a href="chefs.html">Ponentes</a>


                                <li>  <a href="agenda.html">Programa</a>

                            </ul></li>

                        <li> <a href="#">Zona de prensa</a>


                            <ul class="dropdown">


                                <li>  <a href="noticias.html">Hemeroteca </a>


                            </ul></li>

                        <li> <a href="http://gijonsecome.es/contacta">Contacto</a>


                            <ul class="dropdown">
                            </ul></li>
                    </ul>

                    <!-- end navigation list -->
                    <!--Menu PC -->
                </div>
            </div>
            <!-- Mobile Menu Start -->
            <ul class="wpb-mobile-menu">



                <li> <a href="http://gijonsecome.es">Inicio</a>


                    <ul class="dropdown">
                    </ul></li>

                <li> <a href="#">El Festival</a>


                    <ul class="dropdown">


                        <li>  <a href="http://gijonsecome.es/detalle/11">Nuestra filosof&iacute;a</a>




                        <li>  <a href="http://gijonsecome.es/detalle/38">Gij&oacute;nSeCome es sostenible</a>


                    </ul></li>

                <li> <a href="#">Primera edici&oacute;n</a>


                    <ul class="dropdown">

                        <li>  <a href="http://gijonsecome.es/ponentes">Ponentes</a>


                        <li>  <a href="http://gijonsecome.es/agenda">Programa</a>

                    </ul></li>

                <li> <a href="http://gijonsecome.es/contactaprensa">Zona de prensa</a>


                    <ul class="dropdown">


                        <li>  <a href="http://gijonsecome.es/detalle/15">Hemeroteca </a>


                    </ul></li>

                <li> <a href="http://gijonsecome.es/contacta">Contacto</a>


                    <ul class="dropdown">
                    </ul></li>
            </ul>


            <!-- Mobile Menu End -->


        </div>
        <!-- End Header ( Logo & Naviagtion ) -->

    </header>
    <!-- End Header -->


    <!-- comienza contenido de la página-->

    <!-- ***********************zona variable 5 módulos*****************************-->
    <section id="zonavariable">


        <div class="row row-eq-height"><!-- row zona variable-->


            <!-- *********************************variante primera******************************** -->
            <div class="dedosendos">

                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-xs-12 varianteprimera">



                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 row-eq-height">

                        <picture>
                            <source media="(min-width: 1200px)" srcset="images/fotos/01.jpg"><!-- pc -->
                            <source media="(min-width: 992px)" srcset="images/fotos/01.jpg"><!-- medio pc -->
                            <source media="(min-width: 768px)" srcset="images/fotos/01.jpg"><!-- tablet -->
                            <!-- img tag for browsers that do not support picture element -->
                            <a href="detallenoticia.html"> <img src="images/fotos/01.jpg" alt="..."></a><!-- movil -->
                        </picture>

                        <picture>
                            <source media="(min-width: 992px)" srcset="images/graficos/A_mord.png"><!-- pc -->
                            <source media="(min-width: 768px)" srcset="images/graficos/A_mord.png"><!-- tablet -->

                            <!-- img tag for browsers that do not support picture element -->
                            <img src="images/graficos/A_mord_XS.png" alt="imagen decorativa" class="mordisquitos" border="0"><!-- movil -->
                        </picture>

                    </div><!-- fin col lg7 -->


                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 row-eq-height destacado">
                        <article>
                            <hgroup>
                                <h1><a href="detallenoticia.html">“Todos los mordisquitos de esta web son míos. Que al lado de mi foto tenga una zanahoria es coincidencia.”</a></h1>
                                <h2>Cita a ciegas con Carme Ruscalleda.</h2>
                            </hgroup>
                        </article>
                    </div><!-- fin col 5 -->



                </div><!-- fin col 7 -->



                <!-- *********************************variante segunda******************************** -->


                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 variantesegunda">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row-eq-height">
                        <picture>
                            <source media="(min-width: 1200px)" srcset="images/fotos/02.jpg"><!-- pc -->
                            <source media="(min-width: 992px)" srcset="images/fotos/02.jpg"><!-- medio pc -->
                            <source media="(min-width: 768px)" srcset="images/fotos/02.jpg"><!-- tablet -->

                            <!-- img tag for browsers that do not support picture element -->
                            <a href="detallecocina.html"><img src="images/fotos/02.jpg" alt="..."></a><!-- movil -->
                        </picture>
                        <picture>

                            <source media="(min-width: 768px)" srcset="images/graficos/B_mord.png"><!-- tablet -->

                            <!-- img tag for browsers that do not support picture element -->
                            <img src="images/graficos/B_mord_XS.png" alt="imagen decorativa" class="img-responsive mordisquitos"><!-- movil -->
                        </picture>


                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row-eq-height">
                        <article>
                            <hgroup>

                                <h1><a href="detallecocina.html">Llamada a la acción para expositores interesados</a></h1>
                                <h2>Espacio para expositores</h2>
                            </hgroup>
                        </article>
                    </div>


                </div><!-- fin col lg 5 -->

            </div>


            <!-- *********************************variante tercera******************************** -->


            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 variantetercera">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <picture>
                        <source media="(min-width: 1200px)" srcset="images/fotos/02.jpg"><!-- pc -->
                        <source media="(min-width: 992px)" srcset="images/fotos/02.jpg"><!-- medio pc -->
                        <source media="(min-width: 768px)" srcset="images/fotos/02.jpg"><!-- tablet -->

                        <!-- img tag for browsers that do not support picture element -->
                        <a href="detallenoticia.html"><img src="images/fotos/02.jpg" alt="..."></a><!-- movil -->
                    </picture>
                    <picture>

                        <source media="(min-width: 768px)" srcset="images/graficos/C_mord.png"><!-- tablet -->

                        <!-- img tag for browsers that do not support picture element -->
                        <img src="images/graficos/C_mord.png" alt="imagen decorativa" class="img-responsive mordisquitos"><!-- movil -->
                    </picture>


                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row-eq-height destacado">
                    <article>
                        <hgroup>

                            <h1><a href="detallenoticia.html">Llamada a la acción para expositores interesados</a></h1>
                            <h2>Espacio para expositores</h2>
                        </hgroup>
                    </article>
                </div>


            </div><!-- fin col lg 5 -->


            <!-- *********************************variante cuarta******************************** -->
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 variantecuarta">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <picture>
                        <source media="(min-width: 1200px)" srcset="images/fotos/04.jpg"><!-- pc -->
                        <source media="(min-width: 992px)" srcset="images/fotos/04.jpg"><!-- medio pc -->
                        <source media="(min-width: 768px)" srcset="images/fotos/04.jpg"><!-- tablet -->

                        <!-- img tag for browsers that do not support picture element -->
                        <img src="images/fotos/04.jpg" alt="..." border="0"><!-- movil -->
                    </picture>
                    <picture>
                        <source media="(min-width: 992px)" srcset="images/graficos/d_mord.png"><!-- pc -->
                        <source media="(min-width: 768px)" srcset="images/graficos/d_mord.png"><!-- tablet -->

                        <!-- img tag for browsers that do not support picture element -->
                        <img src="images/graficos/D_mord_XS.png" alt="imagen decorativa" class="img-responsive mordisquitos"><!-- movil -->
                    </picture>


                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row-eq-height destacado">
                    <article>
                        <hgroup>

                            <h1><a href="detallecocina.html">Llamada a la acción para expositores interesados</a></h1>
                            <h2>Espacio para expositores</h2>
                        </hgroup>
                    </article>
                </div>


            </div><!-- fin col lg 5 -->

            <!-- *********************************variante quinta******************************** -->

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 variantequinta">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <picture>
                        <source media="(min-width: 1200px)" srcset="images/fotos/05.jpg"><!-- pc -->
                        <source media="(min-width: 992px)" srcset="images/fotos/05.jpg"><!-- medio pc -->
                        <source media="(min-width: 768px)" srcset="images/fotos/05.jpg"><!-- tablet -->

                        <!-- img tag for browsers that do not support picture element -->
                        <a href="detallecocina.html"><img src="images/fotos/02.jpg" alt="..."></a><!-- movil -->
                    </picture>
                    <picture>
                        <source media="(min-width: 992px)" srcset="images/graficos/e_mord.png"><!-- pc -->
                        <source media="(min-width: 768px)" srcset="images/graficos/e_mord.png"><!-- tablet -->

                        <!-- img tag for browsers that do not support picture element -->
                        <img src="images/graficos/e_mord_XS.png" alt="imagen decorativa" class="img-responsive mordisquitos"><!-- movil -->
                    </picture>


                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row-eq-height destacado">
                    <article>
                        <hgroup>

                            <h1><a href="detallecocina.html">Llamada a la acción para expositores interesados</a></h1>
                            <h2>Espacio para expositores</h2>
                        </hgroup>
                    </article>
                </div>


            </div><!-- fin col lg 5 -->




        </div><!-- fin row zona variable-->
    </section><!-- fin zona variable -->

    <section id="elfestival">


        <div class="row row-eq-height">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row-eq-height">

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 programa">



                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 vira">

                        <picture>
                            <source media="(min-width: 1200px)" srcset="images/fotos/06.jpg"><!-- pc -->
                            <source media="(min-width: 992px)" srcset="images/fotos/06.jpg"><!-- medio pc -->
                            <source media="(min-width: 768px)" srcset="images/fotos/06.jpg"><!-- tablet -->

                            <!-- img tag for browsers that do not support picture element -->
                            <img src="images/fotos/06XS.jpg" alt="..." class="img-responsive"><!-- movil -->
                        </picture>
                        <picture>
                            <source media="(min-width: 769px)" srcset="images/graficos/f_mord.png"><!-- pc -->
                            <source media="(min-width: 480px)" srcset="images/graficos/f_mord.png"><!-- tablet -->

                            <!-- img tag for browsers that do not support picture element -->
                            <img src="images/graficos/F_mord_XS.png" alt="imagen decorativa" class="mordisquitos"><!-- movil -->
                        </picture>

                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <article>
                            <hgroup>
                                <h1><a href="noticias.html">Así hablan de GijónSeCome</a></h1>
                                <h2>Consulta la hemeroteca</h2>
                            </hgroup>
                        </article>
                    </div>

                </div><!-- fin col md 4-->


                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 newspaper">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 vira">

                        <picture>
                            <source media="(min-width: 1200px)" srcset="images/fotos/07.jpg"><!-- pc -->
                            <source media="(min-width: 992px)" srcset="images/fotos/07.jpg"><!-- medio pc -->
                            <source media="(min-width: 768px)" srcset="images/fotos/07.jpg"><!-- tablet -->

                            <!-- img tag for browsers that do not support picture element -->
                            <img src="images/fotos/07XS.jpg" alt="..." ><!-- movil -->
                        </picture>

                        <picture>
                            <source media="(min-width: 992px)" srcset="images/graficos/g_mord.png"><!-- pc -->
                            <source media="(min-width: 768px)" srcset="images/graficos/g_mord.png"><!-- tablet -->

                            <!-- img tag for browsers that do not support picture element -->
                            <img src="images/graficos/g_mord_XS.png" alt="imagen decorativa" class="img-responsive mordisquitos"><!-- movil -->
                        </picture>


                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                        <article>
                            <hgroup>
                                <h1><a href="noticias.html">Newspapper</a></h1>
                                <h2>Espacio para prensa</h2>
                            </hgroup>
                        </article>
                    </div>

                </div><!-- fin col md 4-->


                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 row-eq-height">

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 llegar">
                        <article>
                            <hgroup>
                                <h1><a href="#">Cómo llegar</a></h1>
                                <h2>No te pierdas nada. Aquí podrás ver nuestra agenda.</h2>
                            </hgroup>
                        </article>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 row-eq-height alojamiento">
                        <article>
                            <hgroup>
                                <h1><a href="#">Alojamiento</a></h1>
                                <h2>Planifica tu estancia en Gijón.</h2>
                            </hgroup>
                        </article>
                    </div>

                </div><!-- fin col md 4-->



            </div><!-- fin col md 12-->
        </div><!-- fin row -->



    </section><!-- fin el festival -->



    <section id="chefs">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row-eq-height chefs" >
                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 ">
                    <h1><a href="#">Quien nos acompañó en la pasada edición</a></h1>

                </div>
                <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12" >
                    <div class="clients-carousel">
                        <div class="projects-carousel touch-carousel owl-carousel owl-theme" data-appeared-items="5">

                            <!-- Client 1 -->
                            <div class="client-item item">
                                <div class="imagenchef">

                                    <div class="portfolio-thumb">
                                        <a  href="detalleponentes/4">
                                            <img alt="" src="images/fotos/indice.jpg" />
                                        </a>
                                    </div>
                                    <div class="nombrechef">

                                        <h4>Marcos Morán</h4>

                                    </div>
                                </div>
                            </div>
                            <div class="client-item item">
                                <div class="imagenchef">

                                    <div class="portfolio-thumb">
                                        <a  href="detalleponentes/4">
                                            <img alt="" src="images/fotos/indice.jpg" />
                                        </a>
                                    </div>
                                    <div class="nombrechef">

                                        <h4>Marcos Morán</h4>

                                    </div>
                                </div>
                            </div>
                            <div class="client-item item">
                                <div class="imagenchef">

                                    <div class="portfolio-thumb">
                                        <a  href="detalleponentes/4">
                                            <img alt="" src="images/fotos/indice.jpg" />
                                        </a>
                                    </div>
                                    <div class="nombrechef">

                                        <h4>Marcos Morán</h4>

                                    </div>
                                </div>
                            </div>
                            <div class="client-item item">
                                <div class="imagenchef">

                                    <div class="portfolio-thumb">
                                        <a  href="detalleponentes/4">
                                            <img alt="" src="images/fotos/indice.jpg" />
                                        </a>
                                    </div>
                                    <div class="nombrechef">

                                        <h4>Marcos Morán</h4>

                                    </div>
                                </div>
                            </div>
                            <div class="client-item item">
                                <div class="imagenchef">

                                    <div class="portfolio-thumb">
                                        <a  href="detalleponentes/4">
                                            <img alt="" src="images/fotos/indice.jpg" />
                                        </a>
                                    </div>
                                    <div class="nombrechef">

                                        <h4>Marcos Morán</h4>

                                    </div>
                                </div>
                            </div>		<div class="client-item item">
                                <div class="imagenchef">

                                    <div class="portfolio-thumb">
                                        <a  href="detalleponentes/4">
                                            <img alt="" src="images/fotos/indice.jpg" />
                                        </a>
                                    </div>
                                    <div class="nombrechef">

                                        <h4>Marcos Morán</h4>

                                    </div>
                                </div>
                            </div>		<div class="client-item item">
                                <div class="imagenchef">

                                    <div class="portfolio-thumb">
                                        <a  href="detalleponentes/4">
                                            <img alt="" src="images/fotos/indice.jpg" />
                                        </a>
                                    </div>
                                    <div class="nombrechef">

                                        <h4>Marcos Morán</h4>

                                    </div>
                                </div>
                            </div>






                        </div>
                    </div>
                    <!--End Clients Carousel-->
                </div>
                <!-- fin 10 -->

            </div><!-- fin 12 -->
        </div><!-- fin row -->
    </section>

    <section id="patrocinadores">

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="col-lg-1 col-md-1">
                    <!-- Start Clients Carousel -->
                    <div>

                        <!-- Classic Heading -->
                        <h4 class="classic-title"><span>Organiza</span></h4>

                        <div class="clients-carousel custom-carousel touch-carousel" data-appeared-items="1">

                            <!-- Client 1 -->
                            <div class="client-item item">
                                <a href="http://www.mglab.es" title="va a la web de mglab " target="new"><img src="http://gijonsecome.es/images_web/logos/mglab.png" alt="Logo mglab" /></a>
                            </div>


                        </div>
                    </div>
                    <!--End Clients Carousel-->
                </div>


                <div class="col-lg-3 col-lg-offset-1 col-md-3">
                    <!-- Start Clients Carousel -->
                    <div>

                        <!-- Classic Heading -->
                        <h4 class="classic-title"><span>Patrocinadores</span></h4>

                        <div class="clients-carousel custom-carousel touch-carousel" data-appeared-items="4">

                            <!-- Client 1 -->
                            <div class="client-item item">
                                <a href="http://www.ikea.com/es/es/" title="va a la web de IKEA España " target="new"><img src="http://gijonsecome.es/images_web/logos/ikea.png" alt="Logo IKEA" /></a>
                            </div>
                            <div class="client-item item">
                                <a href="http://www.mahou.es/" title="va a la web de cervezas mahou" target="new"><img src="http://gijonsecome.es/images_web/logos/mahou.png" alt="logo cervezas mahou" /></a>
                            </div>
                            <div class="client-item item">
                                <a href="https://www.miele.es/" title="va a la web de electrodomésticos Miele" target="new"><img src="http://gijonsecome.es/images_web/logos/miele.png" alt="logo electrodomésticos miele" /></a>
                            </div>

                        </div>
                    </div>
                    <!--End Clients Carousel-->
                </div>

                <div class="col-lg-5 col-lg-offset-1  col-md-5">
                    <!-- Start Clients Carousel -->
                    <div>

                        <!-- Classic Heading -->
                        <h4 class="classic-title"><span>Proveedores oficiales</span></h4>

                        <div class="clients-carousel custom-carousel touch-carousel" data-appeared-items="5">

                            <!-- Client 1 -->
                            <div class="client-item item">
                                <a href="http://www.cocinaconbra.com" title="va a la web de cocina con bra" target="new"><img src="http://gijonsecome.es/images_web/logos/bra.png" alt="Logo cocinas bra" /></a>
                            </div>
                            <div class="client-item item">
                                <a href="http://www.masymas.es/" title="va a la web de supermercados mas y mas" target="new"><img src="http://gijonsecome.es/images_web/logos/masy-mas.png" alt="Logo supermercados mas y mas" /></a>
                            </div>
                            <div class="client-item item">
                                <a href="http://www.cafento.com/" title="va a la web de cafento" target="new"><img src="http://gijonsecome.es/images_web/logos/montecelio.png" alt="Logo tés montecelio"></a>
                            </div>
                            <div class="client-item item">
                                <a href="http://www.oleoestepa.com/" title="va a la web de aceites oleo estepa" target="new"><img src="http://gijonsecome.es/images_web/logos/oleostepa.png" alt="Logo aceite oleoestepa"></a>
                            </div>

                            <div class="client-item item">
                                <a href="http://porvasal.es/" title="va a la web de porvasal vajillas" target="new"><img src="http://gijonsecome.es/images_web/logos/porvasal.png" alt="Logo porvasal vajillas" /></a>
                            </div>



                        </div>
                    </div>
                    <!--End Clients Carousel-->
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <!-- Start Clients Carousel -->
                    <div>

                        <!-- Classic Heading -->
                        <h4 class="classic-title"><span>Colaboradores</span></h4>

                        <div class="clients-carousel custom-carousel touch-carousel" data-appeared-items="12">

                            <!-- Client 1 -->
                            <div class="client-item item">
                                <a href="http://www.anaya.es/" title="va a la web de grupo Anaya" target="new"><img src="http://gijonsecome.es/images_web/logos/Grupo-Anaya.png" alt="Logo anaya grupo " /></a>
                            </div>

                            <div class="client-item item">
                                <a href="https://www.cocacola.es/home/" title="va a la web de cocacola España" target="new"><img src="http://gijonsecome.es/images_web/logos/cocacola.png" alt=" Logo cocacola" /></a>
                            </div>
                            <div class="client-item item">
                                <a href="http://www.cogersa.es/" title="va a la web de COGERSA" target="new"><img src="http://gijonsecome.es/images_web/logos/cogersa.png" alt="Logo Cogersa" /></a>
                            </div>
                            <div class="client-item item">
                                <a href="http://cuidadoambiental.gijon.es/" title="va a la web de cuidado ambiental de Gijón"><img src="http://gijonsecome.es/images_web/logos/emulsa.png" alt="Logo EMULSA" /></a>
                            </div>
                            <div class="client-item item">
                                <a href="http://www.sidradeasturias.es/" title="va a la web de sidra de Asturias" target="new"><img src="http://gijonsecome.es/images_web/logos/sidradop.png" alt="Logo Sidra de Asturias" /></a>
                            </div>
                            <div class="client-item item">
                                <a href="http://www.milar.es/" title="va a la web de electrodomesticos milar" target="new"><img src="http://gijonsecome.es/images_web/logos/milar.png" alt="Logo milar" /></a>
                            </div>
                            <div class="client-item item">
                                <a href="http://www.terneraasturiana.org/" title="va a la web de ternera Asturiana" target="new"><img src="http://gijonsecome.es/images_web/logos/tenera-asturiana.png" alt="Logo ternera Asturiana"/></a>
                            </div>
                            <div class="client-item item">
                                <a href="https://www.turismoasturias.es/" title="va a la web de turismo de Asturias" target="new"><img src="http://gijonsecome.es/images_web/logos/asturias.png" alt="Logo turismo Asturias" /></a>
                            </div>
                            <div class="client-item item">
                                <a href="http://www.renfe.com/" title="va a la web de RENFE" target="new"><img src="http://gijonsecome.es/images_web/logos/renfe.png" alt="Logo RENFE" /></a>
                            </div>
                            <div class="client-item item">
                                <a href="https://www.alsa.es" title="va a la web de ALSA" target="new"><img src="http://gijonsecome.es/images_web/logos/alsa.png" alt="Logo ALSA" /></a>
                            </div>
                            <div class="client-item item">
                                <a href="http://www.iberia.com/" title="va a la web de IBERIA" target="new"><img src="http://gijonsecome.es/images_web/logos/iberia.png" alt="Logo IBERIA" /></a>
                            </div>
                            <div class="client-item item">
                                <a href="http://www.talpesa.com/" title="va a la web de concesionario TALPESA" target="new"><img src="http://gijonsecome.es/images_web/logos/talpesa.png" alt="Logo talpesa" /></a>
                            </div>




                        </div>
                        <!--End Clients Carousel-->
                    </div>


                </div>



            </div>
        </div>
    </section> <!--fin patrocinadores-->



    <!--  Suscríbete & Social GSC -->
    <footer class="footer">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 footer">
            <div clas="row">

                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12  ">

                    <div class="footer-widget mail-subscribe-widget">
                        <h4 class="head-line">Suscríbete a nuestra newsletter</h4>
                        <p>Toda la información actualizada</p>
                        <!-- Begin MailChimp Signup Form -->
                        <div id="mc_embed_signup">
                            <form action="//gijonsecome.us14.list-manage.com/subscribe/post?u=7d3394bce3bcd4a9e1df1e497&amp;id=86f11804a6" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                <div id="mc_embed_signup_scroll">
                                    <div class="mc-field-group">
                                        <label for="mce-EMAIL">Email </label>
                                        <input type="email" value="" name="EMAIL" id="mce-EMAIL">
                                    </div>
                                    <div id="mce-responses" class="clear">
                                        <div class="response" id="mce-error-response" style="display:none"></div>
                                        <div class="response" id="mce-success-response" style="display:none"></div>
                                    </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                    <div style="position: absolute; left: -5000px;" aria-hidden="true">
                                        <input type="text" name="b_7d3394bce3bcd4a9e1df1e497_86f11804a6" tabindex="-1" value=""></div>
                                    <div class="clear"><input type="submit" value="Suscríbete" name="Subscribe" id="mc-embedded-subscribe" class="button"></div>
                                </div>
                            </form>
                        </div>

                        <!--End mc_embed_signup-->
                    </div>
                    <!-- nuestras redes -->
                    <div class="footer-widget social-widget">
                        <h4 class="head-line">Nuestras redes</h4>
                        <ul class="social-icons">
                            <li>
                                <a class="facebook itl-tooltip" data-placement="bottom" title="Facebook" href="https://facebook.com/gijonsecome" target="new"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a class="twitter itl-tooltip" data-placement="bottom" title="Twitter" href="https://twitter.com/gijonsecome" target="new"><i class="fa fa-twitter"></i></a>
                            </li>

                            <li>
                                <a class="instgram itl-tooltip" data-placement="bottom" title="Instagram" href="https://www.instagram.com/gijonsecome/" target="new"><i class="fa fa-instagram"></i></a>
                            </li>
                            <li>
                                <a class="google itl-tooltip" data-placement="bottom" title="Google Plus" href="https://plus.google.com/b/118212033616852336692/+GijonsecomeEs" target="new"><i class="fa fa-google-plus"></i></a>
                            </li>

                            <li>
                                <a class="google itl-tooltip" data-placement="bottom" title="youtube" href="https://www.youtube.com/channel/UC0Pwb36yxSlDTZhcXzZZLKQ" target="new"><i class="fa fa-youtube"></i></a>
                            </li>



                        </ul>
                    </div>

                </div>
                <!-- .col-md-3 +1 -->

                <!-- mapa web -->
                <div class="col-lg-2 col-lg-offset-1 col-md-2 col-md-offset-1 col-sm-4 col-xs-12 ">

                    <ul class="mapaweb">
                        <li>EL FESTIVAL<ul>
                                <li><a href="#">NUESTRA FILOSOFÍA</a></li>
                                <li><a href="#"> GIJÓNSECOME ES SOSTENIBLE</a></li>
                            </ul></li></ul>
                    <ul>
                        <li> PRIMERA EDICIÓN
                            <ul> <li><a href="#">PONENTES</a></li>
                                <li><a href="#">PROGRAMA</a></li></ul>
                        </li>
                    </ul>
                    <ul>
                        <li> ZONA DE PRENSA
                            <ul>       <li><a href="#">HEMEROTECA</a></li>

                                <li><a href="#">CONTACTO</a></li></ul>
                        </li>

                    </ul>
                </div>
                <div class="col-lg-2 col-md-2 col-xs-12">
                    <div class="footer-widget contacta">
                        <h4 class="head-line">Contacto</h4>
                        <p><strong>Teléfono</strong>: <a href="tel:+34984050409">+34 984 05 04 09</a></p>
                        <p><strong>Email</strong>: <a href="mailto:info@gijonsecome.es">info@gijonsecome.es</a></p>
                        <p><strong>Web</strong>: <a href="http://www.mglab.es">www.mglab.es</a></p>
                    </div>

                </div>
                <!-- imagen decorativa -->
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 decora">

                </div>
            </div><!-- fin row -->
        </div><!-- fin .col-md-12 -->
    </footer>

    <div class="col-lg-12 col-md-12 col-xs-12 fin">
        <p class="fin">mg.lab 2017</p>
    </div>
</div>
<!-- End Container -->

<!-- Go To Top Link -->
<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

<script type="text/javascript" src="js/script.js"></script>

</body>

</html>
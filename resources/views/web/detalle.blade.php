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
    <section id="noticias">
        <div class="row">
            <div class="col-xs-12">
                <article>
                    <hgroup>

                        <h1>Titular de página interior. Kim Ossemblok firma un libro a un hombre feliz.</h1>
                        <h2>SUBTÍTULO DE PÁGINA INTERIOR. KIM ESTÁ HASTA LA POLLA.</h2>
                        <h3>GIJÓN. 24/04/2017</h3>
                    </hgroup>
                    <div class="columnas">
                        <p>Marcos es tataranieto, bisnieto, nieto e hijo de  profesionales de la cocina. Desde 2005, se encuentra al frente, junto con su  padre, Pedro Morán, del restaurante Casa Gerardo, todo un referente de la  gastronomía que abrió sus puertas hace ya   más de 130 años.</p>
                        <p>Aunque Marcos iba para periodista, en segundo curso de  carrera deja los estudios y vuelve a casa. Siempre había vivido la cocina de  cerca pero, a partir de este momento, comienza a sentirla, a vivirla desde  dentro y a engancharse mientras pasa los primeros años entre Casa Gerardo y  algunas de los más prestigiosos restaurantes del territorio nacional.</p>
                        <p>Hablar de Casa Gerardo supone adentrarnos en el perfecto  equilibrio entre tradición y vanguardia; en los sabores más auténticos de la  cocina asturiana contemporánea. Porque Pedro y Marcos Morán forman un tándem  único que ha llevado a su restaurante a lo más alto de la gastronomía.</p>
                        <p>Eso sólo se consigue poniendo una pasión infinita en lo que  se hace, y apostando por una cocina honesta. La gastronomía tradicional  asturiana juega un papel importantísimo para la familia Morán, pero la  contemporaneidad da ese toque tan especial que les caracteriza; el golpe  maestro. Marcos Morán, jefe de cocina de Casa Gerardo, deja huella en sus  creaciones, sorprendentes y llenas de personalidad.</p>
                        <p>En enero de 2013, abre sus puertas <strong>Hispania London</strong>, donde  Marcos ejerce de chef ejecutivo. Es el mayor espacio gastronómico dedicado a la  cocina española fuera de nuestras fronteras. En Hispania, Marcos presenta una  amplia de oferta, desde las tapas más tradicionales a los platos de más  vanguardia.</p>
                        <p>En febrero de 2016, Marcos Morán ha sido escogido como Chef  de l'Avenir (cocinero del futuro) por la Academia Internacional de Gastronomía.  Un premio que se otorga a cocineros jóvenes que destacan por su talento y su  proyección.</p>
                        <p>En otoño de 2016, está prevista la apertura de Hispania  Brussel, donde Marcos volverá a ejercer de chef ejecutivo en este ambicioso  proyecto gastronómico del NH Collection Grand Sablon, donde Morán se hará cargo  de los desayunos, el room service, el bar de tapas, el catering y el  restaurante gastronómico.</p>
                        <p>PUBLICACIONES: &ldquo;Casa Gerardo: 50 pasos de la cocina  contemporánea&rdquo;. Montagud Editores.</p>
                        <p>WEB:</p>
                        <p><a href="www.restaurantecasagerardo.es">www.restaurantecasagerardo.es</a><br>
                            <a href="www.hispanialondon.com">www.hispanialondon.com</a></p>
                    </div><!-- fin columnas -->
                    <picture>
                        <source media="(min-width: 1200px)" srcset="images/pc/noticia01.png"><!-- pc -->
                        <source media="(min-width: 992px)" srcset="images/laptop/noticia01.png"><!-- medio pc -->
                        <source media="(min-width: 768px)" srcset="images/tablet/noticia01.png"><!-- tablet -->

                        <!-- img tag for browsers that do not support picture element -->
                        <img src="images/smartphone/noticia01.png" alt="..." class="img-responsive"><!-- movil -->
                    </picture>
                </article>




            </div><!-- fin col 12 -->

        </div>  <!-- fin row -->
    </section><!-- fin  noticias-->

@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="css/detalle.css"/>
@endsection
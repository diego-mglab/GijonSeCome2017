    <!-- OJO tiene un css único gijonsecome.css-->
    <!-- Basic -->
    <title>{{$metas[0]}}</title>

    <!-- Define Charset -->
    <meta charset="utf-8">

    <!-- Responsive Metatag -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Page Description and Author -->
    <meta name="description" content="{{$metas[1]}}">
    <meta name="author" content="www.mglab.es">

    <!-- Cabeceras para el Facebook en las páginas de contenido (noticias y entrevistas) y detalle ponentes -->
    @if (isset($textosidioma))
        <?php
            $es_contenido_rrss = false;
            $titulo = '';
            $imagen = '';
            $descripcion = '';
        ?>

        @if($textosidioma->tipo_contenido_id == 1)
            @if($content->pagina_estatica != '1')
                <?php
                    $imagen = asset('images/contenido/l').'/'.$content->imagen or 'sinimagen.png';
                    $es_contenido_rrss = true;
                    $descripcion = $content->getSubString($textosidioma->contenido,150);
                ?>
            @endif
        @endif
        @if($textosidioma->tipo_contenido_id == 3)
            <?php
                $imagen = asset('images/chefs/l').'/'.$ponente->imagen or 'sinimagen.png';
                $es_contenido_rrss = true;
                $titulo = $textosidioma->titulo;
                $descripcion = $ponente->getSubString($textosidioma->contenido,150);
            ?>
        @endif

        @if($es_contenido_rrss)
            <meta property="og:title" content="{{$titulo}}" />
            <meta property="og:type" content="article" />
            <meta property="og:url" content="http://{{$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]}}" />
            <meta property="og:image" content="{{$imagen}}" />
            <meta property="og:description" content="{{$descripcion}}" />

            <meta name="twitter:card" content="summary" />
            <meta name="twitter:site" content="@gijonsecome">
            <meta name="twitter:title" content="{{$titulo}}" />
            <meta name="twitter:description" content="{{$descripcion}}" />
            <meta name="twitter:creator" content="@gijonsecome">
        @endif
    @endif

    <!-- Bootstrap CSS  -->
    <link rel="stylesheet" href="{{asset('asset/css/bootstrap.min.css')}}" type="text/css" media="screen">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" type="text/css" media="screen">

    <!-- Slicknav -->
    <link rel="stylesheet"  href="{{asset('css/slicknav.css')}}" type="text/css" media="screen">

    <!-- Margo CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}" media="screen">

    <!-- Responsive CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/responsive.css')}}" media="screen">

    <!-- Css3 Transitions Styles  -->
    <link rel="stylesheet"  href="{{asset('css/animate.css')}}" type="text/css" media="screen">

    <!-- Color CSS Styles  -->

    <link rel="stylesheet" type="text/css" href="{{asset('css/colors/jade.css')}}" title="jade" media="screen" />



    <!-- Margo JS  -->
    <script type="text/javascript" src="{{asset('js/jquery-2.1.4.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.migrate.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/modernizrr.js')}}"></script>
    <script type="text/javascript" src="{{asset('asset/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.fitvids.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/owl.carousel.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/nivo-lightbox.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.isotope.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.appear.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/count-to.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.textillate.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.lettering.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.easypiechart.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.nicescroll.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.parallax.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.slicknav.js')}}"></script>

    <!--[if IE 8]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

    @if(isset($content))
        @if ($content->fb_pixel != '')
            <!-- Facebook Pixel Code -->
                {{$content->fb_pixel}}
            <!-- Facebook Pixel Code -->
        @endif
    @endif

    <!-- mglab -->
    <link href="https://fonts.googleapis.com/css?family=Cormorant:400,600,600i|Source+Sans+Pro:300,400,400i" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset('css/gijonsecome.css')}}"/>
    @yield('css')

    @include('web.includes.ganalytics')
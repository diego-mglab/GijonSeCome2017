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
                        <li><a href="#"><i class="fa fa-map-marker"></i> {{__('cabecera.recinto_ferial_luis_adaro')}}</a>
                        </li>
                        <li><a href="mailto:info@gijonsecome.es"><i class="fa fa-envelope-o"></i> info@gijonsecome.es</a>
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
                            <a class="itl-tooltip" data-placement="bottom" title="Castellano" href="{{ url('', ['es']) }}"><i class="fa">CAS</i></a>
                        </li>
                        <li>
                            <a class="itl-tooltip" data-placement="bottom" title="Asturianu" href="{{ url('', ['as']) }}"><i class="fa">AST</i></a>
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
                <a href="/"><picture>
                        <source media="(min-width: 1200px)" srcset="{{asset('images/graficos/logo_cabLG.png')}}"><!-- pc -->
                        <source media="(min-width: 992px)" srcset="{{asset('images/graficos/logo_cabMD.png')}}"><!-- pc medio- tablet  -->
                        <source media="(min-width: 768px)" srcset="{{asset('images/graficos/logo_cabXS.png')}}"><!-- tablet -->
                        <!-- img tag for browsers that do not support picture element -->
                        <img src="{{asset('images/graficos/logo_cabXS.png')}}" alt="logo gijón se come" class="logo img-responsive" border="0"><!-- movil -->

                    </picture></a>

            </div>
            <div class="navbar-collapse collapse">
                <!--Menu pc -->
                <!-- Start Navigation List -->
                <ul class="nav navbar-nav navbar-right">
                    <?php
                    $idioma_actual = Session::get('idioma');
                    ?>
                    @foreach ($menus as $menu)

                        @if (count($menu->submenu) >=1)

                            <li>
                                @if ($menu->url != '')
                                    {{link_to($idioma_actual.'/'.$menu->url, $title = is_object($menu->textos_idioma)?$menu->textos_idioma->titulo:'', $parameters = [])}}
                                @elseif ($menu->content_id > 0)
                                    {{link_to_route(is_object($menu->content)?str_replace("-","",$menu->content->textos_idioma->slug).'_web_'.Session::get('idioma'):'principal',$title = is_object($menu->textos_idioma)?$menu->textos_idioma->titulo:'', $parameters = [])}}
                                @else
                                    <a href="#">{{is_object($menu->textos_idioma)?$menu->textos_idioma->titulo:''}}</a>
                                @endif

                                <ul class="dropdown">

                                    @foreach($menu->submenu as $submenu)

                                        <li>
                                            @if ($submenu->url != '')
                                                {{link_to($idioma_actual.'/'.$submenu->url, $title = is_object($submenu->textos_idioma)?$submenu->textos_idioma->titulo:'', $parameters = [])}}
                                            @else
                                                {{link_to_route(is_object($submenu->content)?str_replace("-","",$submenu->content->textos_idioma->slug).'_web_'.Session::get('idioma'):'principal',$title = is_object($submenu->textos_idioma)?$submenu->textos_idioma->titulo:'', $parameters = [])}}
                                            @endif

                                        </li>


                                    @endforeach

                                </ul></li>

                        @elseif ($menu->parent_id == 0)
                            <li>
                                @if ($menu->url != '') ?>
                                    {{link_to($idioma_actual.'/'.$menu->url, $title = is_object($menu->textos_idioma)?$menu->textos_idioma->titulo:'', $parameters = [])}}
                                @else
                                    {{link_to_route(is_object($menu->content)?str_replace("-","",$menu->content->textos_idioma->slug).'_web_'.Session::get('idioma'):'principal',$title = is_object($menu->textos_idioma)?$menu->textos_idioma->titulo:'', $parameters = [])}}
                                @endif
                            </li>
                        @endif

                    @endforeach

                </ul>

                <!-- end navigation list -->
                <!--Menu PC -->
            </div>
        </div>
        <!-- Mobile Menu Start -->
        <ul class="wpb-mobile-menu">

            @foreach ($menus as $menu)

                @if (count($menu->submenu) >=1)

                    <li>
                        @if ($menu->url != '') ?>
                        {{link_to($menu->url, $title = is_object($menu->textos_idioma)?$menu->textos_idioma->titulo:'', $parameters = [])}}
                        @else
                            {{link_to_route(is_object($menu->content)?str_replace("-","",$menu->content->textos_idioma->slug).'_web_'.Session::get('idioma'):'principal',$title = is_object($menu->textos_idioma)?$menu->textos_idioma->titulo:'', $parameters = [])}}
                        @endif

                        <ul class="dropdown">

                            @foreach($menu->submenu as $submenu)

                                <li>
                                    @if ($submenu->url != '') ?>
                                    {{link_to($submenu->url, $title = is_object($submenu->textos_idioma)?$submenu->textos_idioma->titulo:'', $parameters = [])}}
                                    @else
                                        {{link_to_route(is_object($submenu->content)?str_replace("-","",$submenu->content->textos_idioma->slug).'_web_'.Session::get('idioma'):'principal',$title = is_object($submenu->textos_idioma)?$submenu->textos_idioma->titulo:'', $parameters = [])}}
                                    @endif
                                </li>


                            @endforeach

                        </ul></li>

                @elseif ($menu->parent_id == 0)
                    <li>
                        @if ($menu->url != '') ?>
                        {{link_to($menu->url, $title = is_object($menu->textos_idioma)?$menu->textos_idioma->titulo:'', $parameters = [])}}
                        @else
                            {{link_to_route(is_object($menu->content)?str_replace("-","",$menu->content->textos_idioma->slug).'_web_'.Session::get('idioma'):'principal',$title = is_object($menu->textos_idioma)?$menu->textos_idioma->titulo:'', $parameters = [])}}
                        @endif
                    </li>
                @endif

            @endforeach

        </ul>
        <!-- Mobile Menu End -->


    </div>
    <!-- End Header ( Logo & Naviagtion ) -->

</header>
<!-- End Header -->
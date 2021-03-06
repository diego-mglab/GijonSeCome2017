<!-- comienza contenido de la página-->

<!-- ***********************zona variable 5 módulos*****************************-->
<section id="zonavariable">


    <div class="row row-eq-height"><!-- row zona variable-->

        <div class="dedosendos">

            <?php
                $idioma_actual = Session::get('idioma');
            ?>
            @if (isset($portada[0]))
                <?php
                $elemento = $portada[0];
                //Sacamos el link si lo tuviera, bien de contenido o bien externo
                $link = '';
                if (is_object($elemento->contenido)) {
                    $tipo_pagina = $elemento->contenido->tipo_contenido;
                    if (is_object($elemento->contenido->textos_idioma)){
                        $pagina = str_replace('-','',$elemento->contenido->textos_idioma->slug);
                        $ruta = route($pagina.'_web_'.$idioma_actual,[]);
                        $link = $ruta;
                    }
                } elseif ($elemento->url!=''){
                    $link = $elemento->url;
                }
                ?>
                <!-- *********************************variante primera******************************** -->
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-xs-12 varianteprimera">



                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 row-eq-height">

                        <picture>
                            <source media="(min-width: 1200px)" srcset="{{asset('images/portada/l')}}/{{$elemento->imagen or 'sinimagen.png'}}"><!-- pc -->
                            <source media="(min-width: 992px)" srcset="{{asset('images/portada/l')}}/{{$elemento->imagen or 'sinimagen.png'}}"><!-- medio pc -->
                            <source media="(min-width: 768px)" srcset="{{asset('images/portada/s')}}/{{$elemento->imagen or 'sinimagen.png'}}"><!-- tablet -->
                            <!-- img tag for browsers that do not support picture element -->
                            @if ($link != '')
                                <a href="{{$link}}">
                            @endif
                                    <img src="{{asset('images/portada/l')}}/{{$elemento->imagen or 'sinimagen.png'}}" alt="{{is_object($elemento->textos_idioma)?$elemento->textos_idioma->titulo:''}}">
                            @if ($link != '')
                                </a><!-- movil -->
                            @endif
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
                                <h1>
                                @if ($link != '')
                                    <a href="{{$link}}">
                                @endif
                                {{is_object($elemento->textos_idioma)?$elemento->textos_idioma->titulo:''}}
                                @if ($link != '')
                                    </a>
                                @endif
                                </h1>
                                <h2>{{is_object($elemento->textos_idioma)?$elemento->textos_idioma->subtitulo:''}}</h2>
                            </hgroup>
                        </article>
                    </div><!-- fin col 5 -->



                </div><!-- fin col 7 -->
            @endif


            @if (isset($portada[1]))
                <?php
                $elemento = $portada[1];
                //Sacamos el link si lo tuviera, bien de contenido o bien externo
                $link = '';
                if (is_object($elemento->contenido)) {
                    $tipo_pagina = $elemento->contenido->tipo_contenido;
                    if (is_object($elemento->contenido->textos_idioma)){
                        $pagina = str_replace('-','',$elemento->contenido->textos_idioma->slug);
                        $ruta = route($pagina.'_web_'.$idioma_actual,[]);
                        $link = $ruta;
                    }
                } elseif ($elemento->url!=''){
                    $link = $elemento->url;
                }
                ?>
                <!-- *********************************variante segunda******************************** -->
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 variantesegunda">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row-eq-height">
                        <picture>
                            <source media="(min-width: 1200px)" srcset="{{asset('images/portada/m')}}/{{$elemento->imagen or 'sinimagen.png'}}"><!-- pc -->
                            <source media="(min-width: 992px)" srcset="{{asset('images/portada/m')}}/{{$elemento->imagen or 'sinimagen.png'}}"><!-- medio pc -->
                            <source media="(min-width: 768px)" srcset="{{asset('images/portada/s')}}/{{$elemento->imagen or 'sinimagen.png'}}"><!-- tablet -->

                            <!-- img tag for browsers that do not support picture element -->
                            @if ($link != '')
                                <a href="{{$link}}">
                            @endif
                                    <img src="{{asset('images/portada/m')}}/{{$elemento->imagen or 'sinimagen.png'}}" alt="{{is_object($elemento->textos_idioma)?$elemento->textos_idioma->titulo:''}}">
                            @if ($link != '')
                                </a><!-- movil -->
                            @endif
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

                                <h1>
                                @if ($link != '')
                                    <a href="{{$link}}">
                                @endif
                                {{is_object($elemento->textos_idioma)?$elemento->textos_idioma->titulo:''}}
                                @if ($link != '')
                                    </a>
                                @endif
                                </h1>
                                <h2>{{is_object($elemento->textos_idioma)?$elemento->textos_idioma->subtitulo:''}}</h2>
                            </hgroup>
                        </article>
                    </div>


                </div><!-- fin col lg 5 -->
            @endif
        </div>


        @if (isset($portada[2]))
            <?php
            $elemento = $portada[2];
            //Sacamos el link si lo tuviera, bien de contenido o bien externo
            $link = '';
            if (is_object($elemento->contenido)) {
                $tipo_pagina = $elemento->contenido->tipo_contenido;
                if (is_object($elemento->contenido->textos_idioma)){
                    $pagina = str_replace('-','',$elemento->contenido->textos_idioma->slug);
                    $ruta = route($pagina.'_web_'.$idioma_actual,[]);
                    $link = $ruta;
                }
            } elseif ($elemento->url!=''){
                $link = $elemento->url;
            }
            ?>
            <!-- *********************************variante tercera******************************** -->
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 variantetercera">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <picture>
                        <source media="(min-width: 1200px)" srcset="{{asset('images/portada/m')}}/{{$elemento->imagen or 'sinimagen.png'}}"><!-- pc -->
                        <source media="(min-width: 992px)" srcset="{{asset('images/portada/m')}}/{{$elemento->imagen or 'sinimagen.png'}}"><!-- medio pc -->
                        <source media="(min-width: 768px)" srcset="{{asset('images/portada/s')}}/{{$elemento->imagen or 'sinimagen.png'}}"><!-- tablet -->

                        <!-- img tag for browsers that do not support picture element -->
                        @if ($link != '')
                            <a href="{{$link}}">
                        @endif
                            <img src="{{asset('images/portada/m')}}/{{$elemento->imagen or 'sinimagen.png'}}" alt="{{is_object($elemento->textos_idioma)?$elemento->textos_idioma->titulo:''}}">
                        @if ($link != '')
                            </a><!-- movil -->
                        @endif
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
                            <h1>
                                @if ($link != '')
                                    <a href="{{$link}}">
                                @endif
                                {{is_object($elemento->textos_idioma)?$elemento->textos_idioma->titulo:''}}
                                @if ($link != '')
                                    </a>
                                @endif
                            </h1>
                            <h2>{{is_object($elemento->textos_idioma)?$elemento->textos_idioma->subtitulo:''}}</h2>
                        </hgroup>
                    </article>
                </div>


            </div><!-- fin col lg 5 -->
        @endif

        @if (isset($portada[3]))
            <?php
            $elemento = $portada[3];
            //Sacamos el link si lo tuviera, bien de contenido o bien externo
            $link = '';
            if (is_object($elemento->contenido)) {
                $tipo_pagina = $elemento->contenido->tipo_contenido;
                if (is_object($elemento->contenido->textos_idioma)){
                    $pagina = str_replace('-','',$elemento->contenido->textos_idioma->slug);
                    $ruta = route($pagina.'_web_'.$idioma_actual,[]);
                    $link = $ruta;
                }
            } elseif ($elemento->url!=''){
                $link = $elemento->url;
            }
            ?>
            <!-- *********************************variante cuarta******************************** -->
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 variantecuarta">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <picture>
                        <source media="(min-width: 1200px)" srcset="{{asset('images/portada/m')}}/{{$elemento->imagen or 'sinimagen.png'}}"><!-- pc -->
                        <source media="(min-width: 992px)" srcset="{{asset('images/portada/m')}}/{{$elemento->imagen or 'sinimagen.png'}}"><!-- medio pc -->
                        <source media="(min-width: 768px)" srcset="{{asset('images/portada/s')}}/{{$elemento->imagen or 'sinimagen.png'}}"><!-- tablet -->

                        <!-- img tag for browsers that do not support picture element -->
                        @if ($link != '')
                            <a href="{{$link}}">
                        @endif
                            <img src="{{asset('images/portada/m')}}/{{$elemento->imagen or 'sinimagen.png'}}" alt="{{is_object($elemento->textos_idioma)?$elemento->textos_idioma->titulo:''}}">
                        @if ($link != '')
                            </a><!-- movil -->
                        @endif
                    </picture>
                    <picture>
                        <source media="(min-width: 992px)" srcset="images/graficos/D_mord.png"><!-- pc -->
                        <source media="(min-width: 768px)" srcset="images/graficos/D_mord.png"><!-- tablet -->

                        <!-- img tag for browsers that do not support picture element -->
                        <img src="images/graficos/D_mord_XS.png" alt="imagen decorativa" class="img-responsive mordisquitos"><!-- movil -->
                    </picture>


                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row-eq-height destacado">
                    <article>
                        <hgroup>
                            <h1>
                                @if ($link != '')
                                    <a href="{{$link}}">
                                @endif
                                {{is_object($elemento->textos_idioma)?$elemento->textos_idioma->titulo:''}}
                                @if ($link != '')
                                    </a>
                                @endif
                            </h1>
                            <h2>{{is_object($elemento->textos_idioma)?$elemento->textos_idioma->subtitulo:''}}</h2>
                        </hgroup>
                    </article>
                </div>


            </div><!-- fin col lg 5 -->
        @endif

        @if (isset($portada[4]))
            <?php
            $elemento = $portada[4];
            //Sacamos el link si lo tuviera, bien de contenido o bien externo
            $link = '';
            if (is_object($elemento->contenido)) {
                $tipo_pagina = $elemento->contenido->tipo_contenido;
                if (is_object($elemento->contenido->textos_idioma)){
                    $pagina = str_replace('-','',$elemento->contenido->textos_idioma->slug);
                    $ruta = route($pagina.'_web_'.$idioma_actual,[]);
                    $link = $ruta;
                }
            } elseif ($elemento->url!=''){
                $link = $elemento->url;
            }
            ?>
            <!-- *********************************variante quinta******************************** -->

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 variantequinta">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <picture>
                        <source media="(min-width: 1200px)" srcset="{{asset('images/portada/m')}}/{{$elemento->imagen or 'sinimagen.png'}}"><!-- pc -->
                        <source media="(min-width: 992px)" srcset="{{asset('images/portada/m')}}/{{$elemento->imagen or 'sinimagen.png'}}"><!-- medio pc -->
                        <source media="(min-width: 768px)" srcset="{{asset('images/portada/s')}}/{{$elemento->imagen or 'sinimagen.png'}}"><!-- tablet -->

                        <!-- img tag for browsers that do not support picture element -->
                        @if ($link != '')
                            <a href="{{$link}}">
                        @endif
                            <img src="{{asset('images/portada/m')}}/{{$elemento->imagen or 'sinimagen.png'}}" alt="{{is_object($elemento->textos_idioma)?$elemento->textos_idioma->titulo:''}}">
                        @if ($link != '')
                            </a><!-- movil -->
                        @endif
                    </picture>
                    <picture>
                        <source media="(min-width: 992px)" srcset="images/graficos/E_mord.png"><!-- pc -->
                        <source media="(min-width: 768px)" srcset="images/graficos/E_mord.png"><!-- tablet -->

                        <!-- img tag for browsers that do not support picture element -->
                        <img src="images/graficos/E_mord_XS.png" alt="imagen decorativa" class="img-responsive mordisquitos"><!-- movil -->
                    </picture>


                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row-eq-height destacado">
                    <article>
                        <hgroup>
                            <h1>
                                @if ($link != '')
                                    <a href="{{$link}}">
                                @endif
                                {{is_object($elemento->textos_idioma)?$elemento->textos_idioma->titulo:''}}
                                @if ($link != '')
                                    </a>
                                @endif
                            </h1>
                            <h2>{{is_object($elemento->textos_idioma)?$elemento->textos_idioma->subtitulo:''}}</h2>
                        </hgroup>
                    </article>
                </div>


            </div><!-- fin col lg 5 -->
        @endif



    </div><!-- fin row zona variable-->
</section><!-- fin zona variable -->

<section id="elfestival">


    <div class="row row-eq-height">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row-eq-height">

            @if (isset($portada[5]))
                <?php
                $elemento = $portada[5];
                //Sacamos el link si lo tuviera, bien de contenido o bien externo
                $link = '';
                if (is_object($elemento->contenido)) {
                    $tipo_pagina = $elemento->contenido->tipo_contenido;
                    if (is_object($elemento->contenido->textos_idioma)){
                        $pagina = str_replace('-','',$elemento->contenido->textos_idioma->slug);
                        $ruta = route($pagina.'_web_'.$idioma_actual,[]);
                        $link = $ruta;
                    }
                } elseif ($elemento->url!=''){
                    $link = $elemento->url;
                }
                ?>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 programa">

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 vira">

                        <picture>
                            <source media="(min-width: 1200px)" srcset="{{asset('images/portada/l')}}/{{$elemento->imagen or 'sinimagen.png'}}"><!-- pc -->
                            <source media="(min-width: 992px)" srcset="{{asset('images/portada/l')}}/{{$elemento->imagen or 'sinimagen.png'}}"><!-- medio pc -->
                            <source media="(min-width: 768px)" srcset="{{asset('images/portada/s')}}/{{$elemento->imagen or 'sinimagen.png'}}"><!-- tablet -->

                            <!-- img tag for browsers that do not support picture element -->
                            @if ($link != '')
                                <a href="{{$link}}">
                            @endif
                                <img src="{{asset('images/portada/l')}}/{{$elemento->imagen or 'sinimagen.png'}}" alt="{{is_object($elemento->textos_idioma)?$elemento->textos_idioma->titulo:''}}">
                            @if ($link != '')
                                </a><!-- movil -->
                            @endif
                        </picture>
                        <picture>
                            <source media="(min-width: 769px)" srcset="images/graficos/F_mord.png"><!-- pc -->
                            <source media="(min-width: 480px)" srcset="images/graficos/F_mord.png"><!-- tablet -->

                            <!-- img tag for browsers that do not support picture element -->
                            <img src="images/graficos/F_mord_XS.png" alt="imagen decorativa" class="mordisquitos"><!-- movil -->
                        </picture>

                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <article>
                            <hgroup>
                                <h1>
                                    @if ($link != '')
                                        <a href="{{$link}}">
                                    @endif
                                    {{is_object($elemento->textos_idioma)?$elemento->textos_idioma->titulo:''}}
                                    @if ($link != '')
                                        </a>
                                    @endif
                                </h1>
                                <h2>{{is_object($elemento->textos_idioma)?$elemento->textos_idioma->subtitulo:''}}</h2>
                            </hgroup>
                        </article>
                    </div>

                </div><!-- fin col md 4-->
            @endif


            @if (isset($portada[6]))
                <?php
                $elemento = $portada[6];
                    //Sacamos el link si lo tuviera, bien de contenido o bien externo
                    $link = '';
                    if (is_object($elemento->contenido)) {
                        $tipo_pagina = $elemento->contenido->tipo_contenido;
                        if (is_object($elemento->contenido->textos_idioma)){
                            $pagina = str_replace('-','',$elemento->contenido->textos_idioma->slug);
                            $ruta = route($pagina.'_web_'.$idioma_actual,[]);
                            $link = $ruta;
                        }
                    } elseif ($elemento->url!=''){
                        $link = $elemento->url;
                    }
                ?>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 newspaper">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 vira">

                        <picture>
                            <source media="(min-width: 1200px)" srcset="{{asset('images/portada/l')}}/{{$elemento->imagen or 'sinimagen.png'}}"><!-- pc -->
                            <source media="(min-width: 992px)" srcset="{{asset('images/portada/l')}}/{{$elemento->imagen or 'sinimagen.png'}}"><!-- medio pc -->
                            <source media="(min-width: 768px)" srcset="{{asset('images/portada/s')}}/{{$elemento->imagen or 'sinimagen.png'}}"><!-- tablet -->

                            <!-- img tag for browsers that do not support picture element -->
                            @if ($link != '')
                                <a href="{{$link}}">
                            @endif
                                <img src="{{asset('images/portada/l')}}/{{$elemento->imagen or 'sinimagen.png'}}" alt="{{is_object($elemento->textos_idioma)?$elemento->textos_idioma->titulo:''}}">
                            @if ($link != '')
                                </a><!-- movil -->
                            @endif
                        </picture>

                        <picture>
                            <source media="(min-width: 992px)" srcset="images/graficos/G_mord.png"><!-- pc -->
                            <source media="(min-width: 768px)" srcset="images/graficos/G_mord.png"><!-- tablet -->

                            <!-- img tag for browsers that do not support picture element -->
                            <img src="images/graficos/G_mord_XS.png" alt="imagen decorativa" class="img-responsive mordisquitos"><!-- movil -->
                        </picture>


                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                        <article>
                            <hgroup>
                                <h1>
                                    @if ($link != '')
                                        <a href="{{$link}}">
                                    @endif
                                    {{is_object($elemento->textos_idioma)?$elemento->textos_idioma->titulo:''}}
                                    @if ($link != '')
                                        </a>
                                    @endif
                                </h1>
                                <h2>{{is_object($elemento->textos_idioma)?$elemento->textos_idioma->subtitulo:''}}</h2>
                            </hgroup>
                        </article>
                    </div>

                </div><!-- fin col md 4-->
            @endif

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 row-eq-height">

                @if (isset($portada[7]))
                    <?php
                    $elemento = $portada[7];
                    //Sacamos el link si lo tuviera, bien de contenido o bien externo
                    $link = '';
                    if (is_object($elemento->contenido)) {
                        $tipo_pagina = $elemento->contenido->tipo_contenido;
                        if (is_object($elemento->contenido->textos_idioma)){
                            $pagina = str_replace('-','',$elemento->contenido->textos_idioma->slug);
                            $ruta = route($pagina.'_web_'.$idioma_actual,[]);
                            $link = $ruta;
                        }
                    } elseif ($elemento->url!=''){
                        $link = $elemento->url;
                    }
                    ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 llegar">
                        <article>
                            <hgroup>
                                <h1>
                                    @if ($link != '')
                                        <a href="{{$link}}">
                                    @endif
                                    {{is_object($elemento->textos_idioma)?$elemento->textos_idioma->titulo:''}}
                                    @if ($link != '')
                                        </a>
                                    @endif
                                </h1>
                                <h2>{{is_object($elemento->textos_idioma)?$elemento->textos_idioma->subtitulo:''}}</h2>
                            </hgroup>
                        </article>
                    </div>
                @endif

                @if (isset($portada[8]))
                    <?php
                    $elemento = $portada[8];
                    //Sacamos el link si lo tuviera, bien de contenido o bien externo
                    $link = '';
                    if (is_object($elemento->contenido)) {
                        $tipo_pagina = $elemento->contenido->tipo_contenido;
                        if (is_object($elemento->contenido->textos_idioma)){
                            $pagina = str_replace('-','',$elemento->contenido->textos_idioma->slug);
                            $ruta = route($pagina.'_web_'.$idioma_actual,[]);
                            $link = $ruta;
                        }
                    } elseif ($elemento->url!=''){
                        $link = $elemento->url;
                    }
                    ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 row-eq-height alojamiento">
                        <article>
                            <hgroup>
                                <h1>
                                    @if ($link != '')
                                        <a href="{{$link}}">
                                    @endif
                                    {{is_object($elemento->textos_idioma)?$elemento->textos_idioma->titulo:''}}
                                    @if ($link != '')
                                        </a>
                                    @endif
                                </h1>
                                <h2>{{is_object($elemento->textos_idioma)?$elemento->textos_idioma->subtitulo:''}}</h2>
                            </hgroup>
                        </article>
                    </div>
                @endif
            </div><!-- fin col md 4-->



        </div><!-- fin col md 12-->
    </div><!-- fin row -->



</section><!-- fin el festival -->



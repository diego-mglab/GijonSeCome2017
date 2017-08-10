@extends('adminlte::page')

@section('content_header')
    <h1>
        Insertar
        <small>Contenido</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Contenidos</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <!-- general form elements -->
            <div class="box box-default">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            <!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(['route' => 'contents.store','files' => true, 'name' => 'form_contents']) !!}



                <div class="box-body">

                    <div class="contenedor_iconos_menu_formulario">
                        <div class="icono_menu_formulario">
                            <a onclick="muestraOcultaCampos('pagina');" title="Página"><i class="fa fa-file-text fa-5x" aria-hidden="true"></i></a>
                        </div>
                        <div class="icono_menu_formulario">
                            <a onclick="muestraOcultaCampos('noticia');" title="Noticia"><i class="fa fa-newspaper-o fa-5x" aria-hidden="true"></i></a>
                        </div>
                        <div class="icono_menu_formulario">
                            <a onclick="muestraOcultaCampos('entrevista');" title="Cita a ciegas"><i class="fa fa-users fa-5x" aria-hidden="true"></i></a>
                        </div>
                        <h2 id="titulo_tipo_contenido" class="icono_menu_formulario titulo_tipo_contenido">
                            Noticia
                        </h2>
                    </div>

                    <div class="form-group">

                        {{Form::hidden('tipo_contenido','noticia',['id' => 'tipo_contenido'])}}

                    </div>

                    <div class="form-group" id="contenedor_lugar">

                        {{Form::label('lugar', 'Autor')}}
                        {{Form::text('lugar', null, ['class' => 'form-control' ,'placeholder' => 'Autor'])}}

                    </div>

                    <div class="form-group" id="contenedor_fecha">
                        {{Form::label('fecha', 'Fecha Noticia')}}

                        <div class="input-group date">

                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>

                            {{Form::text('fecha', null, ['class' => 'form-control pull-right datepicker' , 'id' => 'fecha',])}}

                        </div>

                    </div>

                    <div class="form-group" id="contenedor_fecha">
                        {{Form::label('fecha_publicacion', 'Fecha Publicación')}}

                        <div class="input-group date">

                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>

                            {{Form::text('fecha_publicacion', null, ['class' => 'form-control pull-right datepicker' , 'id' => 'fecha_publicacion',])}}

                        </div>

                    </div>

                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="nav-tabs-custom">
                        <!-- Tabs within a box -->
                        <ul class="nav nav-tabs pull-right">
                            @foreach($idiomas as $idioma)
                                <li
                                        @if($idioma->principal==1)
                                            class="active"
                                        @endif
                                ><a href="#{{$idioma->codigo}}" data-toggle="tab"><img src="/images/idiomas/{{$idioma->imagen}}" alt="{{$idioma->idioma}}">&nbsp;{{$idioma->idioma}}</a></li>
                            @endforeach
                        </ul>
                        <div class="tab-content no-padding">

                            @foreach($idiomas as $idioma)
                                {{Form::hidden('idioma_id[]',$idioma->id,['id' => 'idioma_id'])}}
                                <div class="chart tab-pane
                                        @if($idioma->principal == 1)
                                            active
                                        @endif
                                        " id="{{$idioma->codigo}}" style="position: relative;">

                                    <!-- /.nav-tabs-custom -->

                                    <div class="form-group">

                                        {{Form::label('titulo', 'Título')}}
                                        {{Form::text('titulo[]', null, ['class' => 'form-control' ,'placeholder' => 'Título', 'id' => 'titulo'.$idioma->id, 'onkeyup' => '$("#slug'.$idioma->id.'").val(slug($("#titulo'.$idioma->id.'").val()));'])}}

                                    </div>


                                    <div class="form-group" id="contenedor_subtitulo_{{$idioma->codigo}}">

                                        {{Form::label('subtitulo', 'Subtítulo')}}
                                        {{Form::text('subtitulo[]', null, ['class' => 'form-control' ,'placeholder' => 'Subtítulo'])}}

                                    </div>

                                    <div class="form-group">

                                        {{Form::label('contenido', 'Contenido')}}
                                        {{Form::textarea('contenido[]', null, ['class' => 'form-control'])}}

                                    </div>

                                    <div class="form-group">

                                        {{Form::label('metatitulo', 'Meta título')}}
                                        {{Form::text('metatitulo[]', null, ['class' => 'form-control' ,'placeholder' => 'Meta título'])}}

                                    </div>

                                    <div class="form-group">

                                        {{Form::label('metadescripcion', 'Meta descripción')}}
                                        {{Form::text('metadescripcion[]', null, ['class' => 'form-control' ,'placeholder' => 'Meta descripción'])}}

                                    </div>

                                    <div class="form-group">

                                        {{Form::label('slug', 'URL amigable')}}
                                        {{Form::text('slug[]', null, ['class' => 'form-control' ,'placeholder' => 'URL amigable', 'id' => 'slug'.$idioma->id])}}

                                    </div>

                                    <div class="form-group">

                                        {{Form::label('visible', 'Visible/Oculto')}}
                                        {{Form::checkbox('visible[]', $idioma->id, true,['class' => 'flat-green'])}}

                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>

                    <div class="form-group" id="contenedor_imagen">

                        {{Form::label('imagen', 'Imagen')}}
                        {{Form::file('imagen', null, ['class' => 'form-control'])}}
                    </div>

                    <div class="form-group" id="contenedor_pagina_estatica">

                        {{Form::label('pagina_estatica', 'Página estática')}}
                        {{Form::checkbox('pagina_estatica', null, false,['class' => 'flat-green'])}}

                    </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-default">Insertar</button>
                </div>

                {!! Form::close() !!}

            </div>
            <!-- /.box -->
        </div>
    </div>


@endsection

@section('css')

    <!-- General -->
    <link rel="stylesheet" href="{{asset('vendor/adminlte/css/general.css')}}">

    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('vendor/adminlte/plugins/iCheck/flat/green.css')}}">

    <!-- Bootstrap Datepicker Sandbox -->
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker.standalone.css')}}">

@stop

@section('js')

    <!-- TinyMCE -->
    <script src="{{asset('vendor/adminlte/plugins/tinymce/tinymce.min.js')}}"></script>
    <script>
        var editor_config = {
            path_absolute : "/",
            selector: "textarea",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
            file_browser_callback : function(field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.open({
                    file : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no"
                });
            }
        };

        tinymce.init(editor_config);
    </script>

    <!-- iCheck -->
    <script src="{{asset('vendor/adminlte/plugins/iCheck/icheck.min.js')}}"></script>
    <script>
        //Green color scheme for iCheck
        $('input[type="checkbox"].flat-green').iCheck({
            checkboxClass: 'icheckbox_flat-green'
        });
    </script>

    <!-- Bootstrap Datepicker Sandbox -->
    <script src="{{asset('datePicker/js/bootstrap-datepicker.js')}}"></script>
    <!-- Languaje -->
    <script src="{{asset('datePicker/locales/bootstrap-datepicker.es.min.js')}}"></script>
    <script language="JavaScript">
        $('.datepicker').datepicker({
            format: "dd/mm/yyyy",
            language: "es",
            autoclose: true
        });
    </script>

    <!-- Tipo Contenido -->
    <script language="JavaScript">
        $('#contenedor_pagina_estatica').hide();
        function muestraOcultaCampos(tipo_contenido){
            switch (tipo_contenido){
                case 'pagina':
                    $('#contenedor_lugar').hide();
                    $('#contenedor_fecha').hide();
                    $('#contenedor_pagina_estatica').show();
                    @foreach($idiomas as $idioma)
                            $('#contenedor_subtitulo_{{$idioma->codigo}}').hide();
                    @endforeach
                    titulo = "Página";
                    break;
                case 'noticia':
                    $('#contenedor_lugar').show();
                    $('#contenedor_fecha').show();
                    $('#contenedor_pagina_estatica').hide();
                    @foreach($idiomas as $idioma)
                            $('#contenedor_subtitulo_{{$idioma->codigo}}').show();
                    @endforeach
                    titulo = "Noticia";
                    break;
                case 'entrevista':
                    $('#contenedor_lugar').show();
                    $('#contenedor_fecha').hide();
                    $('#contenedor_pagina_estatica').hide();
                    titulo = "Cita a ciegas";
                    break;
            }
            $('#tipo_contenido').val(tipo_contenido);
            $('#titulo_tipo_contenido').html(titulo);
        }
    </script>

    <!-- Crear URL amigable a partir de lo que se escriba en el título -->
    <script language="JavaScript">
        var slug = function(str) {
            str = str.replace(/^\s+|\s+$/g, ''); // trim
            str = str.toLowerCase();

            // remove accents, swap ñ for n, etc
            var from = "ÁÄÂÀÃÅČÇĆĎÉĚËÈÊẼĔȆÍÌÎÏŇÑÓÖÒÔÕØŘŔŠŤÚŮÜÙÛÝŸŽáäâàãåčçćďéěëèêẽĕȇíìîïňñóöòôõøðřŕšťúůüùûýÿžþÞĐđßÆa·/_,:;";
            var to   = "AAAAAACCCDEEEEEEEEIIIINNOOOOOORRSTUUUUUYYZaaaaaacccdeeeeeeeeiiiinnooooooorrstuuuuuyyzbBDdBAa------";
            for (var i=0, l=from.length ; i<l ; i++) {
                str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
            }

            str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                .replace(/\s+/g, '-') // collapse whitespace and replace by -
                .replace(/-+/g, '-'); // collapse dashes

            return str;
        };
    </script>

@stop

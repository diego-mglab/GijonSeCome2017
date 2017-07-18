@extends('adminlte::page')

@section('content_header')
    <h1>
        Editar
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
                    {{ Form::model($content, ['route' => ['contents.update', $content],'method' => 'PATCH','files' => true ])}}



                <div class="box-body">

                    <div class="contenedor_iconos_menu_formulario">
                        <h2 id="titulo_tipo_contenido" class="icono_menu_formulario titulo_tipo_contenido">
                            {{ucwords($content->tipo_contenido)}}
                        </h2>
                    </div>

                    @if ($content->tipo_contenido == 'noticia')
                        <?php
                            //Convertimos la fecha que nos llega en formato dd/mm/yyyy
                            $time= strtotime($content->fecha);
                            $fecha = date('d/m/Y',$time);
                        ?>
                        <div class="form-group" id="contenedor_lugar">

                            {{Form::label('lugar', 'Lugar')}}
                            {{Form::text('lugar', null, ['class' => 'form-control' ,'placeholder' => 'Lugar'])}}

                        </div>

                        <div class="form-group" id="contenedor_fecha">
                            {{Form::label('fecha', 'Fecha')}}

                            <div class="input-group date">

                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>

                                {{Form::text('fecha', $fecha, ['class' => 'form-control pull-right datepicker' , 'id' => 'fecha',])}}

                            </div>
                        </div>
                    @endif

                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="nav-tabs-custom">
                        <!-- Tabs within a box -->
                        <ul class="nav nav-tabs pull-right">
                            <?php $nidiomas = count($idiomas); ?>
                            @foreach($idiomas as $idioma)
                                <li
                                        @if($idioma->principal==1)
                                        class="active"
                                        @endif
                                ><a href="#{{$idioma->codigo}}" data-toggle="tab">{{$idioma->idioma}}</a></li>
                            @endforeach
                        </ul>
                        <div class="tab-content no-padding">

                            <?php
                                $nregs=count($textos);
                                $contador = $nidiomas-1;
                            ?>
                            @foreach($idiomas as $idioma)
                                <?php
                                    $titulo = $contador<$nregs?$textos[$contador]->titulo:null;
                                    $subtitulo = $contador<$nregs?$textos[$contador]->subtitulo:null;
                                    $contenido = $contador<$nregs?$textos[$contador]->contenido:null;
                                    $metatitulo = $contador<$nregs?$textos[$contador]->metatitulo:null;
                                    $metadescripcion = $contador<$nregs?$textos[$contador]->metadescripcion:null;
                                    $visible = $contador<$nregs?$textos[$contador]->visible:null;
                                ?>
                                <div class="chart tab-pane
                                        @if($idioma->principal == 1)
                                            active
                                        @endif
                                        " id="{{$idioma->codigo}}" style="position: relative;">

                                    <!-- /.nav-tabs-custom -->

                                    <div class="form-group">

                                        {{Form::label('titulo', 'Título')}}
                                        {{Form::text('titulo[]', $titulo, ['class' => 'form-control' ,'placeholder' => 'Título'])}}

                                    </div>


                                    @if ($content->tipo_contenido == 'noticia')
                                        <div class="form-group" id="contenedor_subtitulo">

                                            {{Form::label('subtitulo', 'Subtítulo')}}
                                            {{Form::text('subtitulo[]', $subtitulo, ['class' => 'form-control' ,'placeholder' => 'Subtítulo'])}}

                                        </div>
                                    @endif

                                    <div class="form-group">

                                        {{Form::label('contenido', 'Contenido')}}
                                        {{Form::textarea('contenido[]', $contenido, ['class' => 'form-control'])}}

                                    </div>

                                    <div class="form-group">

                                        {{Form::label('metatitulo', 'Meta título')}}
                                        {{Form::text('metatitulo[]', $metatitulo, ['class' => 'form-control' ,'placeholder' => 'Meta título'])}}

                                    </div>

                                    <div class="form-group">

                                        {{Form::label('metadescripcion', 'Meta descripción')}}
                                        {{Form::text('metadescripcion[]', $metadescripcion, ['class' => 'form-control' ,'placeholder' => 'Meta descripción'])}}

                                    </div>

                                    <div class="form-group">

                                        {{Form::label('visible', 'Visible/Oculto')}}
                                        {{Form::checkbox('visible[]', '1', $visible,['class' => 'flat-green'])}}

                                    </div>
                                    @if (!$idioma->principal)
                                        <div class="form-group">

                                            {{Form::label('elimina_texto_idioma', 'Eliminar idioma')}}
                                            {{Form::checkbox('elimina_texto_idioma[]', '1', false,['class' => 'flat-green'])}}

                                        </div>
                                    @endif
                                </div>
                                <?php $contador-- ?>
                            @endforeach

                        </div>
                    </div>

                    <div class="form-group" id="contenedor_imagen">

                        {{Form::label('imagen', 'Imagen')}}
                        {{Form::file('imagen', null, ['class' => 'form-control'])}}
                        <div class="label_imagen_editar"><strong>Imagen actual:</strong></div>
                        <div class="contenedor_imagen_editar"><img src="/images/contenido/s/{{$content->imagen or 'sinimagen.png'}}" alt="" class="img-responsive" ></div>
                    </div>


                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-default">Editar</button>
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
            selector: "#contenido",
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
        function muestraOcultaCampos(tipo_contenido){
            switch (tipo_contenido){
                case 'pagina':
                    $('#contenedor_lugar').hide();
                    $('#contenedor_fecha').hide();
                    @foreach($idiomas as $idioma)
                            $('#contenedor_subtitulo_{{$idioma->codigo}}').hide();
                    @endforeach
                        titulo = "Página";
                    break;
                case 'noticia':
                    $('#contenedor_lugar').show();
                    $('#contenedor_fecha').show();
                    @foreach($idiomas as $idioma)
                            $('#contenedor_subtitulo_{{$idioma->codigo}}').show();
                    @endforeach
                        titulo = "Noticia";
                    break;
            }
            $('#tipo_contenido').val(tipo_contenido);
            $('#titulo_tipo_contenido').html(titulo);
        }
    </script>

@stop

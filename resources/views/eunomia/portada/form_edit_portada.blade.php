@extends('adminlte::page')

@section('content_header')
    <h1>
        Editar
        <small>Portada</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Portada</li>
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
                {{ Form::model($portada, ['route' => ['portada.update', $portada],'method' => 'PATCH','files' => true ])}}



                <div class="box-body">

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
                                ><a href="#{{$idioma->codigo}}" data-toggle="tab"><img src="/images/idiomas/{{$idioma->imagen}}" alt="{{$idioma->idioma}}">&nbsp;{{$idioma->idioma}}</a></li>
                            @endforeach
                        </ul>
                        <div class="tab-content no-padding">

                            @foreach($idiomas as $idioma)
                                <?php
                                $titulo = null;
                                $subtitulo = null;
                                $contenido = null;
                                $metatitulo = null;
                                $metadescripcion = null;
                                $visible = false;
                                ?>
                                @foreach($textos as $texto)
                                    <?php
                                    if ($texto->idioma_id == $idioma->id) {
                                        $titulo = $texto->titulo;
                                        $subtitulo = $texto->subtitulo;
                                        $contenido = $texto->contenido;
                                        $metatitulo = $texto->metatitulo;
                                        $metadescripcion = $texto->metadescripcion;
                                        $visible = $texto->visible;
                                    }
                                    ?>
                                @endforeach
                                {{Form::hidden('idioma_id[]',$idioma->id)}}
                                <div class="chart tab-pane
                                        @if($idioma->principal == 1)
                                        active
@endif
                                        " id="{{$idioma->codigo}}" style="position: relative;">

                                    <!-- /.nav-tabs-custom -->

                                    <div class="form-group">

                                        {{Form::label('titulo', 'Título')}}
                                        {{Form::text('titulo', $titulo, ['class' => 'form-control' ,'placeholder' => 'Título'])}}

                                    </div>


                                    <div class="form-group" id="contenedor_subtitulo">

                                        {{Form::label('subtitulo', 'Subtítulo')}}
                                        {{Form::text('subtitulo[]', $subtitulo, ['class' => 'form-control' ,'placeholder' => 'Subtítulo'])}}

                                    </div>

                                    <div class="form-group">

                                        {{Form::label('visible', 'Visible/Oculto')}}
                                        {{Form::checkbox('visible[]', $idioma->id, $visible,['class' => 'flat-green'])}}

                                    </div>
                                    @if (!$idioma->principal && false)
                                        <div class="form-group">

                                            {{Form::label('elimina_texto_idioma', 'Eliminar idioma')}}
                                            {{Form::checkbox('elimina_texto_idioma[]', '1', false,['class' => 'flat-green'])}}

                                        </div>
                                    @endif
                                </div>
                            @endforeach

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg12">
                            {{Form::label('contenido_id', 'Página')}}
                        </div>
                        <div class="col-lg-12">
                            <div class="col-lg-9">
                                {{ Form::select('contenido_id',$paginas,null,['class' => 'form-control','placeholder' => 'Seleccione una página', 'onchange' => '$("#sel_pagina").prop("checked",true)'])}}
                            </div>
                            <div class="col-lg-1">
                                {{ Form::radio('sel_link',1,$portada->contenido_id>0?'checked':'',['id' => 'sel_pagina'])}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg12">
                            {{Form::label('url', 'URL')}}
                        </div>
                        <div class="col-lg-12">
                            <div class="col-lg-9">
                                {{ Form::text('url',$portada->url,['class'=>'form-control', 'onkeypress' => '$("#sel_url").prop("checked",true)'])}}
                            </div>
                            <div class="col-lg-1">
                                {{ Form::radio('sel_link',2,$portada->url!=''?'checked':'',['id' => 'sel_url'])}}
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="contenedor_imagen">

                        {{Form::label('imagen', 'Imagen')}}
                        {{Form::file('imagen', null, ['class' => 'form-control'])}}
                        @if ($portada->imagen != '')
                            <div class="label_imagen_editar"><strong>Imagen actual:</strong></div>
                            <div class="contenedor_imagen_editar"><img src="/images/portada/s/{{$portada->imagen or 'sinimagen.png'}}" alt="" class="img-responsive" ></div>
                        @endif
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
            language: 'es',
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
@stop

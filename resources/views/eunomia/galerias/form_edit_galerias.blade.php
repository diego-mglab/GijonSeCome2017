@extends('adminlte::page')

@section('content_header')
    <h1>
        Editar
        <small>Galería</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Galerías</li>
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
                    {{ Form::model($galeria, ['route' => ['galerias.update', $galeria],'method' => 'PATCH','files' => true ])}}



                <div class="box-body">

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
                                <?php
                                $titulo = null;
                                $subtitulo = null;
                                $metatitulo = null;
                                $metadescripcion = null;
                                $visible = false;
                                ?>
                                @foreach($textos as $texto)
                                    <?php
                                    if ($texto->idioma_id == $idioma->id) {
                                        $titulo = $texto->titulo;
                                        $subtitulo = $texto->subtitulo;
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
                                        {{Form::text('titulo[]', $titulo, ['class' => 'form-control' ,'placeholder' => 'Título'])}}

                                    </div>


                                    <div class="form-group" id="contenedor_subtitulo_{{$idioma->codigo}}">

                                        {{Form::label('subtitulo', 'Subtítulo')}}
                                        {{Form::text('subtitulo[]', $subtitulo, ['class' => 'form-control' ,'placeholder' => 'Subtítulo'])}}

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
                                        {{Form::checkbox('visible[]', $idioma->id, $visible,['class' => 'flat-green'])}}

                                    </div>
                                </div>
                            @endforeach

                        </div>
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

    <div class="row">
        <div class="col-xs-12">
            <!-- general form elements -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Multimedia</h3>
                </div>


                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(['route' => 'galerias.store','files' => true]) !!}



                <div class="box-body">


                    <div class="form-group">

                        {{Form::label('imagen', 'Imagen')}}
                        {{Form::file('imagen', null, ['class' => 'form-control'])}}
                        {{-- <p class="help-block">Imagen principal!</p> --}}
                    </div>

                    <div class="form-group">

                        {{Form::label('url', 'URL video')}}
                        {{Form::text('url', null, ['class' => 'form-control' ,'placeholder' => 'URL video'])}}

                    </div>


                    {{Form::hidden('galeria_id',$galeria->id)}}

                    <div class="box-footer">
                        <button type="submit" class="btn btn-default">Insertar</button>
                    </div>



                    {!! Form::close() !!}





                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <!-- general form elements -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Imagenes</h3>
                </div>


                <!-- /.box-header -->
                <!-- form start -->




                <div class="box-body">

                    @foreach ($imagenes as $imagen)
                        <div class="col-xs-6 col-md-3 " style="padding-bottom:1em">
                            <?php
                                  if ($imagen->url != '') { ?>

                            <?php } else { ?>
                                    <img src="{{asset('images/galerias/'.$galeria->carpeta)}}/{{$imagen->imagen or 'sinimagen.png'}}" style="width:100%">

                            <?php } ?>
                            {{ Form::open(array('method'=> 'DELETE', 'route' => array('galerias.destroy', $imagen),'style'=>'display:inline')) }}
                            {{Form::hidden('imagen_id',$imagen->id)}}
                            {{ Form::submit('Eliminar', array('class' => 'btn btn-block btn-danger btn-xs')) }}
                            {{ Form::close() }}
                        </div>


                    @endforeach






                </div>
                <!-- /.box-body -->
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

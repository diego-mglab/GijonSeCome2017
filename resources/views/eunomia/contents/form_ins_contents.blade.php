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
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="nav-tabs-custom">
                        <!-- Tabs within a box -->
                        <ul class="nav nav-tabs pull-right">
                            <li><a href="#ingles" data-toggle="tab">Inglés</a></li>
                            <li class="active"><a href="#espanol" data-toggle="tab">Español</a></li>
                        </ul>
                        <div class="tab-content no-padding">

                            <div class="chart tab-pane active" id="espanol" style="position: relative;">

                                <!-- /.nav-tabs-custom -->


                                <div class="form-group">

                                    {{Form::label('tipo_contenido', 'Tipo de contenido')}}
                                    {{Form::select('tipo_contenido', $tiposContenido, null, ['class' => 'form-control' ,'placeholder' => 'Seleccione un tipo de contenido'])}}

                                </div>

                                <div class="form-group">

                                    {{Form::label('titulo', 'Título')}}
                                    {{Form::text('titulo', null, ['class' => 'form-control' ,'placeholder' => 'Título'])}}

                                </div>


                                <div class="form-group">

                                    {{Form::label('subtitulo', 'Subtítulo')}}
                                    {{Form::text('subtitulo', null, ['class' => 'form-control' ,'placeholder' => 'Subtítulo'])}}

                                </div>

                                <div class="form-group">

                                    {{Form::label('contenido', 'Contenido')}}
                                    {{Form::textarea('contenido', null, ['class' => 'form-control'])}}

                                </div>

                                <div class="form-group">

                                    {{Form::label('imagen', 'Imagen')}}
                                    {{Form::file('imagen', null, ['class' => 'form-control'])}}
                                </div>

                                <div class="form-group">

                                    {{Form::label('metatitulo', 'Meta título')}}
                                    {{Form::text('metatitulo', null, ['class' => 'form-control' ,'placeholder' => 'Meta título'])}}

                                </div>

                                <div class="form-group">

                                    {{Form::label('metadescripcion', 'Meta descripción')}}
                                    {{Form::text('metadescripcion', null, ['class' => 'form-control' ,'placeholder' => 'Meta descripción'])}}

                                </div>

                                <div class="form-group">

                                    {{Form::label('visible', 'Visible/Oculto')}}
                                    {{Form::checkbox('visible', '1', true,['class' => 'flat-green'])}}

                                </div>
                            </div>

                            <div class="chart tab-pane" id="ingles" style="position: relative;"></div>

                        </div>
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

    <link rel="stylesheet" href="{{asset('vendor/adminlte/plugins/iCheck/flat/green.css')}}">

@stop

@section('js')

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

        tinymce.init(editor_config);    </script>
    <script src="{{asset('vendor/adminlte/plugins/iCheck/icheck.min.js')}}"></script>
    <script>
        //Green color scheme for iCheck
        $('input[type="checkbox"].flat-green').iCheck({
            checkboxClass: 'icheckbox_flat-green'
        });
    </script>
@stop

@extends('adminlte::page')

@section('content_header')
    <h1>
        Editar
        <small>Evento</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Agenda</li>
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
                    {{ Form::model($agenda, ['route' => ['agenda.update', $agenda],'method' => 'PATCH','files' => true ])}}



                <div class="box-body">

                    <?php
                        //Convertimos la fecha que nos llega en formato dd/mm/yyyy
                        $fecha = '';
                        if ($agenda->fecha != '') {
                            $time= strtotime($agenda->fecha);
                            $fecha = date('d/m/Y',$time);
                        }
                    ?>
                    <div class="form-group" id="contenedor_fecha">
                        {{Form::label('fecha', 'Fecha Evento')}}

                        <div class="input-group date">

                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>

                            {{Form::text('fecha', $fecha, ['class' => 'form-control pull-right datepicker' , 'id' => 'fecha' ,'placeholder' => 'Fecha'])}}

                        </div>

                    </div>

                    <div class="form-group" id="contenedor_lugar">

                        {{Form::label('hora', 'Hora Evento')}}
                        {{Form::text('hora', null, ['class' => 'form-control' ,'placeholder' => 'Hora'])}}

                    </div>

                    <div class="form-group">

                        {{Form::label('zona_id', 'Zona')}}
                        {{Form::select('zona_id', $zonas, null, ['class' => 'form-control', 'placeholder'=>'selecciona una zona'])}}

                    </div>

                    <div class="form-group">

                        {{Form::label('ponentes', 'Ponentes')}}
                        {{Form::select('ponentes[]', $allponentes, $ponentes, ['class' => 'form-control select2', 'data-placeholder'=>'selecciona uno o varios ponentes', 'multiple'=>'multiple'])}}

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
                                        {{Form::text('titulo[]', $titulo, ['class' => 'form-control' ,'placeholder' => 'Título'])}}

                                    </div>


                                    <div class="form-group" id="contenedor_subtitulo_{{$idioma->codigo}}">

                                        {{Form::label('subtitulo', 'Subtítulo')}}
                                        {{Form::text('subtitulo[]', $subtitulo, ['class' => 'form-control' ,'placeholder' => 'Subtítulo'])}}

                                    </div>

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
                                        {{Form::checkbox('visible[]', $idioma->id, $visible,['class' => 'flat-green'])}}

                                    </div>
                                </div>
                            @endforeach

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

    <!-- General -->
    <link rel="stylesheet" href="{{asset('vendor/adminlte/css/general.css')}}">

    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('vendor/adminlte/plugins/iCheck/flat/green.css')}}">

    <!-- Bootstrap Datepicker Sandbox -->
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker.standalone.css')}}">

    <!-- JQuery Timepicker -->
    <link rel="stylesheet" href="{{asset('css/jquery.timepicker.css')}}">

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
            autoclose: true,
            startDate: '02/12/2017',
            endDate: '04/12/2017'
        });
    </script>

    <!-- JQuery Timepicker -->
    <script src="{{asset('js/jquery.timepicker.min.js')}}"></script>
    <script language="JavaScript">
        $('#hora').timepicker({
            timeFormat: 'H:i',
            minTime: '08:00',
            maxTime: '23:30'
        });
    </script>

    <!-- Select2 -->
    <script src="{{asset('vendor/adminlte/plugins/select2/select2.full.min.js')}}"></script>
    <script language="JavaScript">
        $(function () {
            //Initialize Select2 Elements
            $(".select2").select2();
        });
    </script>

@stop

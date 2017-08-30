@extends('adminlte::page')

@section('content_header')
    <h1>
        Editar
        <small>Documento de prensa</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Documentos de prensa</li>
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
                {{ Form::model($documentosPrensa, ['route' => ['documentos_prensa.update', $documentosPrensa],'method' => 'PATCH','files' => true ])}}



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
                                ?>
                                @foreach($textos as $texto)
                                    <?php
                                    if ($texto->idioma_id == $idioma->id) {
                                        $titulo = $texto->titulo;
                                    }
                                    ?>
                                @endforeach
                                {{Form::hidden('idioma_id[]',$idioma->id,['id' => 'idioma_id'])}}
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
                                </div>
                            @endforeach

                        </div>
                    </div>

                    <div class="form-group" id="contenedor_imagen">

                        <span class="btn btn-primary btn-file">
                            {{Form::label('fichero', 'Elija un fichero')}}
                            {{Form::file('fichero', null, ['class' => 'form-control'])}}
                        </span>
                        @if ($documentosPrensa->fichero != '')
                            <div class="label_imagen_editar"><strong>Fichero actual:</strong></div>
                            <div class="contenedor_imagen_editar"><a href="{{asset('files/prensa/'.$documentosPrensa->fichero)}}" target="_blank">{{$documentosPrensa->fichero}}</a></div>
                        @endif
                    </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Editar</button>
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

@stop

@section('js')

@stop

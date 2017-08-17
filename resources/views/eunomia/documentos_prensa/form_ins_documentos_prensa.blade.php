@extends('adminlte::page')

@section('content_header')
    <h1>
        Insertar
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
                {!! Form::open(['route' => 'documentos_prensa.store','files' => true, 'name' => 'form_documentos_prensa']) !!}



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
                                {{Form::hidden('idioma_id[]',$idioma->id,['id' => 'idioma_id_'.$idioma->codigo])}}
                                <div class="chart tab-pane
                                        @if($idioma->principal == 1)
                                        active
@endif
                                        " id="{{$idioma->codigo}}" style="position: relative;">

                                    <!-- /.nav-tabs-custom -->

                                    <div class="form-group">

                                        {{Form::label('titulo', 'Título')}}
                                        {{Form::text('titulo[]', null, ['class' => 'form-control' ,'placeholder' => 'Título'])}}

                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>

                    <div class="form-group" id="contenedor_imagen">

                        {{Form::label('fichero', 'Fichero')}}
                        {{Form::file('fichero', null, ['class' => 'form-control'])}}
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

@stop

@section('js')

@stop

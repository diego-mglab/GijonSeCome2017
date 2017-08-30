@extends('adminlte::page')

@section('content_header')
    <h1>
        Insertar
        <small>Zona</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Zonas</li>
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
                {!! Form::open(['route' => 'zonas.store','files' => true]) !!}



                <div class="box-body">


                    <div class="form-group">

                        {{Form::label('nombre', 'Nombre')}}
                        {{Form::text('nombre', null, ['class' => 'form-control' ,'placeholder' => 'Nombre'])}}

                    </div>


                    <div class="form-group">

                        {{Form::label('color', 'Color')}}
                        {{Form::text('color', null, ['class' => 'form-control colorpicker' ,'placeholder' => 'Color'])}}

                    </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Insertar</button>
                </div>

                {!! Form::close() !!}

            </div>
            <!-- /.box -->
        </div>
    </div>


@endsection

@section('css')

    <!-- Colorpicker -->
    <link rel="stylesheet" href="{{asset('vendor/adminlte/plugins/colorpicker/bootstrap-colorpicker.css')}}">

@stop

@section('js')

    <!-- Colorpicker -->
    <script src="{{asset('vendor/adminlte/plugins/colorpicker/bootstrap-colorpicker.js')}}"></script>
    <script>
        $('.colorpicker').colorpicker();
    </script>
@stop

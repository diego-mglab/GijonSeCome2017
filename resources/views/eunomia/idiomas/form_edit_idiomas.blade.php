@extends('adminlte::page')

@section('content_header')
    <h1>
        Editar
        <small>Idioma</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Idiomas</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <!-- general form elements -->
            <div class="box box-default">

                <!-- /.box-header -->
                <!-- form start -->
                {{ Form::model($idioma, ['route' => ['idiomas.update', $idioma],'method' => 'PATCH','files' => true ])}}



                <div class="box-body">


                    <div class="form-group">

                        {{Form::label('idioma', 'Nombre')}}
                        {{Form::text('idioma', null, ['class' => 'form-control' ,'placeholder' => 'Nombre'])}}

                    </div>


                    <div class="form-group">

                        {{Form::label('codigo', 'Código')}}
                        {{Form::text('codigo', null, ['class' => 'form-control' ,'placeholder' => 'Código'])}}

                    </div>

                    <div class="form-group">

                        {{Form::label('imagen', 'Icono')}}
                        {{Form::file('imagen', null, ['class' => 'form-control'])}}
                        @if ($idioma->imagen != '')
                            <img src="/images/idiomas/{{$idioma->imagen}}" alt="{{$idioma->idioma}}">
                        @endif
                    </div>

                    <div class="form-group">

                        {{Form::label('principal', 'Idioma principal')}}
                        {{Form::checkbox('principal', '1', $idioma->principal,['class' => 'flat-green'])}}

                    </div>

                    <div class="form-group">

                        {{Form::label('activado', 'Activado')}}
                        {{Form::checkbox('activado', '1', $idioma->activado,['class' => 'flat-green'])}}

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

    <link rel="stylesheet" href="{{asset('vendor/adminlte/plugins/iCheck/flat/green.css')}}">

@stop

@section('js')

    <script src="{{asset('vendor/adminlte/plugins/iCheck/icheck.min.js')}}"></script>
    <script>
        //Green color scheme for iCheck
        $('input[type="checkbox"].flat-green').iCheck({
            checkboxClass: 'icheckbox_flat-green'
        });
    </script>

@stop

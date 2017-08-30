@extends('adminlte::page')

@section('content_header')
    <h1>
        Editar
        <small>Módulo</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Módulos</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <!-- general form elements -->
            <div class="box box-default">

                <!-- /.box-header -->
                <!-- form start -->
                {{ Form::model($modulo, ['route' => ['modulos.update', $modulo],'method' => 'PATCH','files' => true ])}}



                <div class="box-body">


                    <div class="form-group">

                        {{Form::label('nombre', 'Nombre')}}
                        {{Form::text('nombre', null, ['class' => 'form-control' ,'placeholder' => 'Nombre'])}}

                    </div>


                    <div class="form-group">

                        {{Form::label('descripcion', 'Descripción')}}
                        {{Form::text('descripcion',null, ['class' => 'form-control' ,'placeholder' => 'Descripción'])}}

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

@stop

@section('js')

@stop

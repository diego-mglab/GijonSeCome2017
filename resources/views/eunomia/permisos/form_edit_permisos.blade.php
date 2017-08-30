@extends('adminlte::page')

@section('content_header')
    <h1>
        Editar
        <small>Permiso</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Permisos</li>
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
                    {{ Form::model($permission, ['route' => ['permisos.update', $permission],'method' => 'PATCH','files' => true ])}}



                <div class="box-body">


                    <div class="form-group">

                        {{Form::label('name', 'Nombre')}}
                        {{Form::text('name', null, ['class' => 'form-control' ,'placeholder' => 'Nombre'])}}

                    </div>


                    <div class="form-group">

                        {{Form::label('slug', 'Slug')}}
                        {{Form::text('slug', null, ['class' => 'form-control' ,'placeholder' => 'Slug'])}}

                    </div>

                    <div class="form-group">

                        {{Form::label('model', 'Módulo')}}
                        {{Form::select('model', $modulos,null, ['class' => 'form-control' ,'placeholder' => 'Elija un módulo'])}}

                    </div>

                    <div class="form-group">
                        {{Form::label('permission_type','Tipo permiso')}}
                        <select name="permission_type" class="form-control" id="permission_type">
                            <option value="">Seleccione un tipo</option>
                            <option value="crear" <?php if($permission->permission_type=='crear') echo 'selected="selected"'; ?>>Crear</option>
                            <option value="editar" <?php if($permission->permission_type=='editar') echo 'selected="selected"'; ?>>Editar</option>
                            <option value="eliminar" <?php if($permission->permission_type=='eliminar') echo 'selected="selected"'; ?>>Eliminar</option>
                            <option value="mostrar" <?php if($permission->permission_type=='mostrar') echo 'selected="selected"'; ?>>Mostrar</option>
                        </select>
                    </div>

                    <div class="form-group">

                        {{Form::label('description', 'Descripción')}}
                        {{Form::text('description',null, ['class' => 'form-control' ,'placeholder' => 'Descripción'])}}

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

@extends('adminlte::page')

@section('content_header')
    <h1>
        Editar
        <small>Usuario</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Usuarios</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <!-- general form elements -->
            <div class="box box-default">

                <!-- /.box-header -->
                <!-- form start -->
                {{ Form::model($user, ['route' => ['usuarios.update', $user],'method' => 'PATCH','files' => true ])}}



                <div class="box-body">


                    <div class="form-group">

                        {{Form::label('name', 'Nombre')}}
                        {{Form::text('name', null, ['class' => 'form-control' ,'placeholder' => 'Nombre'])}}

                    </div>


                    <div class="form-group">

                        {{Form::label('email', 'E-Mail')}}
                        {{Form::email('email', null, ['class' => 'form-control' ,'placeholder' => 'tumail@mglab.es'])}}

                    </div>

                    @if (\Auth::user()->compruebaSeguridad('editar-usuario'))
                    <div class="form-group">

                        {{Form::label('roles', 'Roles')}}
                        {{Form::select('roles[]', $allroles, $roles, ['class' => 'form-control select2', 'data-placeholder'=>'selecciona uno o varios roles', 'multiple'=>'multiple'])}}

                    </div>
                    @endif

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
    <!-- Select2 -->
    <script src="{{asset('vendor/adminlte/plugins/select2/select2.full.min.js')}}"></script>
    <script language="JavaScript">
        $(function () {
            //Initialize Select2 Elements
            $(".select2").select2();
        });
    </script>

@stop

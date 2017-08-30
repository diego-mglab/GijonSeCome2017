@extends('adminlte::page')

@section('content_header')
    <h1>
        Cambiar
        <small>Contraseña</small>
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
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (Session::has('message'))
                    <div class="alert alert-danger">
                        {{Session::get('message')}}
                    </div>
                @endif

                <!-- /.box-header -->
                <!-- form start -->
                <form method="post" action="{{url('eunomia/usuarios/updatepassword')}}">
                    {{csrf_field()}}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="mypassword">Introduce tu contraseña actual:</label>
                            <input type="password" name="mypassword" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Introduce tu nueva contraseña:</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="mypassword">Confirma tu nueva contraseña:</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Cambiar mi contraseña</button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>

@endsection

@section('css')

@stop

@section('js')

@stop

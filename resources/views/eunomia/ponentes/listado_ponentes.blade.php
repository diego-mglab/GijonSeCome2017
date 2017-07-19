@extends('adminlte::page')

@section('content_header')
    <h1>
        Listado
        <small>Ponentes</small>
    </h1>
    <h2>{{ link_to_route('ponentes.create', 'Nuevo', null, array('class' => 'btn btn-block btn-success btn-xs')) }}</h2>

    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Ponentes</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">

            <div class="box">

                <!-- /.box-header -->
                <div class="box-body">

                    <table id="list" class="table table-bordered mce-table-striped">

                        <thead>
                        <tr>
                            <th>Orden</th>
                            <th>Nombre</th>
                            <th>Restaurante</th>
                            <th>Visible</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($ponentes as $ponente)
                            @if ($ponente->principal == 1)
                                <tr>
                                    <td>{{$ponente->orden}}</td>
                                    <td>{{$ponente->titulo}}{{--Nombre del ponente --}}</td>
                                    <td>{{$ponente->subtitulo}}{{--Restaurante del ponente --}}</td>
                                    <td>{{$ponente->visible==1?'Si':'No'}}</td>
                                    <td>{{ link_to_route('ponentes.edit', 'Editar', $ponente->id, array('class' => 'btn btn btn-warning btn-xs')) }}
                                        {{ Form::open(array('method'=> 'DELETE', 'route' => array('ponentes.destroy', $ponente->id),'style'=>'display:inline')) }}
                                        {{ Form::submit('Eliminar', array('class' => 'btn btn btn-danger btn-xs')) }}
                                        {{ Form::close() }}

                                    </td>
                                </tr>
                            @endif
                        @endforeach

                        </tbody>

                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

@endsection

@section('css')
    <!-- General -->
    <link rel="stylesheet" href="{{asset('vendor/adminlte/css/general.css')}}">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset("vendor/adminlte/plugins/datatables/dataTables.bootstrap.css")}}">

@stop

@section('js')

    <!-- page script -->

    <!-- DataTables -->

    <script src="{{asset("vendor/adminlte/plugins/datatables/jquery.dataTables.min.js")}}"> </script>
    <script src="{{asset("vendor/adminlte/plugins/datatables/dataTables.bootstrap.min.js")}}"> </script>

    <script src="{{asset("js/scripts.js")}}"></script>
@stop

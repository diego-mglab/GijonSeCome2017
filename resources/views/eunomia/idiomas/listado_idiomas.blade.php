@extends('adminlte::page')

@section('content_header')
    <h1>
        Listado
        <small>Idiomas</small>
    </h1>
    <h2>{{ link_to_route('idiomas.create', 'Nuevo', null, array('class' => 'btn btn-block btn-success btn-xs')) }}</h2>

    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Idiomas</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">

            <div class="box">

                <!-- /.box-header -->
                <div class="box-body">

                    <table id="list" class="table table-bordered table-striped">

                        <thead>
                        <tr>
                            <th>Idioma</th>
                            <th>Código</th>
                            <th>Icono</th>
                            <th>Idioma principal</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($idiomas as $idioma)

                            <tr>
                                <td>{{$idioma->idioma}}</td>
                                <td>{{$idioma->codigo}}</td>
                                <td>
                                    @if ($idioma->imagen != '')
                                        <img src="/images/idiomas/{{$idioma->imagen}}" alt="{{$idioma->idioma}}">
                                    @endif
                                </td>
                                <td>{{$idioma->principal}}</td>
                                <td>{{ link_to_route('idiomas.edit', 'Editar', $idioma, array('class' => 'btn btn btn-warning btn-xs')) }}
                                    {{ Form::open(array('method'=> 'DELETE', 'route' => array('usuarios.destroy', $idioma->id),'style'=>'display:inline')) }}
                                    {{ Form::submit('Eliminar', array('class' => 'btn btn btn-danger btn-xs')) }}
                                    {{ Form::close() }}

                                </td>
                            </tr>

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

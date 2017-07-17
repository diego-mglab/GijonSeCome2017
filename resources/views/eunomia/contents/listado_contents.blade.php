@extends('adminlte::page')

@section('content_header')
    <h1>
        Listado
        <small>Contenido</small>
    </h1>
    <h2>{{ link_to_route('contents.create', 'Nuevo', null, array('class' => 'btn btn-block btn-success btn-xs')) }}</h2>

    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Contenidos</li>
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
                            <th>Título</th>
                            <th>Subtítulo</th>
                            <th>Tipo</th>
                            <th>Visible</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>{{$contents_principal[0]->titulo}}</td>
                                <td>{{$contents_principal[0]->subtitulo}}</td>
                                <td>{{$contents_principal[0]->tipo_contenido}}</td>
                                <td>{{$contents_principal[0]->visible==1?'Si':'No'}}</td>
                                <td>{{ link_to_route('contents.edit', 'Editar', $contents[0]->id, array('class' => 'btn btn btn-warning btn-xs')) }}
                                    {{ Form::open(array('method'=> 'DELETE', 'route' => array('contents.destroy', $contents_principal[0]->id),'style'=>'display:inline')) }}
                                    {{ Form::submit('Eliminar', array('class' => 'btn btn btn-danger btn-xs')) }}
                                    {{ Form::close() }}

                                </td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <table class="table">

                                        @foreach ($contents as $content)
                                            <tr>
                                                <td>{{$content->titulo}}</td>
                                                <td>{{$content->subtitulo}}</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endforeach

                                    </table>
                                </td>
                            </tr>




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

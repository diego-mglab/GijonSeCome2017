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

                            @foreach ($contents as $content)
                                @if ($content->principal == 1)
                                    <tr>
                                        <td><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus-square verde" aria-hidden="true"></i></button><img src="/images/idiomas/{{$content->imagen}}" alt="{{$content->idioma}}"><span class="bloque_fila_tabla">{{$content->titulo}}</span></td>
                                        <td>{{$content->subtitulo}}</td>
                                        <td>{{$content->tipo_contenido}}</td>
                                        <td>{{$content->visible==1?'Si':'No'}}</td>
                                        <td>{{ link_to_route('contents.edit', 'Editar', $content->id, array('class' => 'btn btn btn-warning btn-xs')) }}
                                            {{ Form::open(array('method'=> 'DELETE', 'route' => array('contents.destroy', $content->id),'style'=>'display:inline')) }}
                                            {{ Form::submit('Eliminar', array('class' => 'btn btn btn-danger btn-xs')) }}
                                            {{ Form::close() }}

                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td><span class="segunda_fila"><img src="/images/idiomas/{{$content->imagen}}" alt="{{$content->idioma}}"></span><span class="bloque_fila_tabla">{{$content->titulo}}</span></td>
                                        <td>{{$content->subtitulo}}</td>
                                        <td colspan="3"></td>
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

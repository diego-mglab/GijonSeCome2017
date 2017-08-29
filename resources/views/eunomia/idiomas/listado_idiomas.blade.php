@extends('adminlte::page')

@section('content_header')
    <h1>
        Listado
        <small>Idiomas</small>
    </h1>
    @if( \Auth::user()->compruebaSeguridad('crear-idioma') == true)
        <h2>{{ link_to_route('idiomas.create', 'Nuevo', null, array('class' => 'btn btn-block btn-success btn-xs')) }}</h2>
    @endif

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
                            <th>Activado</th>
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
                                <td>{{$idioma->principal==1?'Si':'No'}}</td>
                                <td>{{$idioma->activado==1?'Si':'No'}}</td>
                                <td>@if( \Auth::user()->compruebaSeguridad('editar-idioma') == true)
                                        {{ link_to_route('idiomas.edit', 'Editar', $idioma, array('class' => 'btn btn btn-warning btn-xs')) }}
                                    @endif
                                    @if( \Auth::user()->compruebaSeguridad('eliminar-idioma') == true)
                                        {{ Form::open(array('method'=> 'DELETE', 'route' => array('idiomas.destroy', $idioma->id),'style'=>'display:inline','class'=>'form_eliminar')) }}
                                        {{ Form::submit('Eliminar', array('class' => 'btn btn btn-danger btn-xs')) }}
                                        {{ Form::close() }}
                                    @endif

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

    <!-- Bootstrap Dialog -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.9/css/bootstrap-dialog.min.css" rel="stylesheet" type="text/css" />
@stop

@section('js')

    <!-- page script -->

    <!-- DataTables -->
    <script src="{{asset("vendor/adminlte/plugins/datatables/jquery.dataTables.min.js")}}"> </script>
    <script src="{{asset("vendor/adminlte/plugins/datatables/dataTables.bootstrap.min.js")}}"> </script>

    <!-- General -->
    <script src="{{asset("js/scripts.js")}}"></script>

    <!-- Bootstrap Dialog -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.9/js/bootstrap-dialog.min.js"></script>

    <script language="JavaScript">
        $('.btn-danger').click(function(e){
            e.preventDefault();
            boton = this;

            BootstrapDialog.confirm(
                '¿Está seguro que desea eliminar el registro?', function(result) {

                    if (result) {
                        $(boton).parent().submit();
                    }

                });
        });
    </script>
@stop

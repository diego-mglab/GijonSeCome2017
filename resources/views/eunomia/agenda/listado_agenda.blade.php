@extends('adminlte::page')

@section('content_header')
    <h1>
        Listado
        <small>Contenido</small>
    </h1>
    @if( \Auth::user()->compruebaSeguridad('crear-agenda') == true)
        <h2>{{ link_to_route('agenda.create', 'Nuevo', null, array('class' => 'btn btn-block btn-success btn-xs')) }}</h2>
    @endif

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

                    <table id="list" class="table table-bordered mce-table-striped">

                        <thead>
                        <tr>
                            <th>Título</th>
                            <th>Subtítulo</th>
                            <th>Fecha/Hora</th>
                            <th>Zona</th>
                            <th>Visible/Oculto</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($eventos as $evento)
                            @if ($evento->principal == 1)
                                <?php
                                    $fecha = "";
                                    $hora = "";
                                    if ($evento->fecha != '') {
                                    $time= strtotime($evento->fecha);
                                    $fecha = date('d/m/Y',$time);
                                    }
                                    if ($evento->hora != '') {
                                        $time= strtotime($evento->hora);
                                        $hora = date('H:i',$time);
                                    }
                                ?>
                                <tr>
                                    <td>{{$evento->titulo}}</td>
                                    <td>{{$evento->subtitulo}}</td>
                                    <td>{{$fecha." ".$hora}}</td>
                                    <td>{{$evento->zona}}</td>
                                    <td>{{$evento->visible==1?'Si':'No'}}</td>
                                    <td>@if( \Auth::user()->compruebaSeguridad('editar-agenda') == true)
                                            {{ link_to_route('agenda.edit', 'Editar', $evento->id, array('class' => 'btn btn btn-warning btn-xs')) }}
                                        @endif
                                        @if( \Auth::user()->compruebaSeguridad('eliminar-agenda') == true)
                                            {{ Form::open(array('method'=> 'DELETE', 'route' => array('agenda.destroy', $evento->id),'style'=>'display:inline','class'=>'form_eliminar')) }}
                                            {{ Form::submit('Eliminar', array('class' => 'btn btn btn-danger btn-xs')) }}
                                            {{ Form::close() }}
                                        @endif

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

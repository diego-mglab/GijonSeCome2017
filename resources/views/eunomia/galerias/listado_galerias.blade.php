@extends('adminlte::page')

@section('content_header')
    <h1>
        Listado
        <small>Portada</small>
    </h1>
    <h2>{{ link_to_route('galerias.create', 'Nuevo', null, array('class' => 'btn btn-block btn-success btn-xs')) }}</h2>

    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Portada</li>
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
                            <th>Título</th>
                            <th>Subtítulo</th>
                            <th>Visible</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($galerias as $galeria)
                            @if ($galeria->principal == 1)
                                <tr id="{{$galeria->id}}">
                                    <td class="ordena">{{$galeria->orden}}</td>
                                    <td>{{$galeria->titulo}}</td>
                                    <td>{{$galeria->subtitulo}}</td>
                                    <td>{{$galeria->visible==1?'Si':'No'}}</td>
                                    <td>{{ link_to_route('galerias.edit', 'Editar', $galeria->id, array('class' => 'btn btn btn-warning btn-xs')) }}
                                        {{ Form::open(array('method'=> 'DELETE', 'route' => array('galerias.destroy', $galeria->id),'style'=>'display:inline','class'=>'form_eliminar')) }}
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.0/css/rowReorder.dataTables.min.css">

    <!-- Bootstrap Dialog -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.9/css/bootstrap-dialog.min.css" rel="stylesheet" type="text/css" />
@stop

@section('js')

    <!-- page script -->

    <!-- DataTables -->
    <script src="{{asset("vendor/adminlte/plugins/datatables/jquery.dataTables.min.js")}}"> </script>
    <script src="{{asset("vendor/adminlte/plugins/datatables/dataTables.bootstrap.min.js")}}"> </script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/rowreorder/1.2.0/js/dataTables.rowReorder.min.js"></script>

    <script language="JavaScript">
        $(function () {
            table = $('#list').DataTable({
                paging: true,
                lengthChange: true,
                searching: true,
                ordering: true,
                info: true,
                stateSave: true,
                responsive: true,
                rowReorder: true,
                language: {
                    url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                }
            });
            table.on('row-reordered',function( e, diff, changes ){
                var nregs=diff.length;
                var datos = [];

                if (nregs>1) {
                    // Si el número de registros movidos es mayor que 2 quiere decir que hemos subido el registro mas de una posición, con lo cual
                    // tenemos que ver en qué dirección lo hemos movido para pasar los datos de la primera o la última fila.
                    if (diff[nregs-1].newPosition > diff[nregs-1].oldPosition+1) { // Hemos bajado el registro
                        datos = {
                            id : $(diff[nregs-1].node).attr('id'),
                            oldPosition : diff[nregs-1].oldPosition+1,
                            newPosition : diff[nregs-1].newPosition+1,
                            tabla : "galerias" // Tabla a ordenar
                        }
                    } else { // Hemos subido el registro
                        datos = {
                            id : $(diff[0].node).attr('id'),
                            oldPosition : diff[0].oldPosition+1,
                            newPosition : diff[0].newPosition+1,
                            tabla : "galerias"
                        }
                    }
                }
                //alert($(diff[i].node).attr('id')+' '+diff[i].oldPosition + ' '+diff[i].newPosition);
                $.ajax({
                    url: "{{asset('asset/ajax/reordenaTabla.php')}}",
                    type: "POST",
                    data: datos,
                    success: function(html){
                        //alert(html);
                    },
                    error: function(jqXHR, textStatus, errorThrown) { console.log(errorThrown); console.log(textStatus);
                    }
                });
            });
        });
    </script>

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

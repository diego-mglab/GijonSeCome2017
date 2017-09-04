@extends('adminlte::page')

@section('content_header')
    <h1>
        Listado
        <small>Permisos</small>
    </h1>
    @if( \Auth::user()->compruebaSeguridad('crear-permiso') == true)
        <h2>{{ link_to_route('permisos.create', 'Nuevo', null, array('class' => 'btn btn-block btn-success btn-xs')) }}</h2>
    @endif

    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Permisos</li>
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
                            <th>Nombre</th>
                            <th>Modulo</th>
                            <th>Tipo permiso</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <th>Nombre</th>
                            <th>Modulo</th>
                            <th>Tipo permiso</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                        </tfoot>
                        <tbody>

                        @foreach ($permissions as $permission)

                            <tr>
                                <td>{{$permission->name}}</td>
                                <td>{{$permission->modulo->nombre}}</td>
                                <td>{{$permission->permission_type}}</td>
                                <td>{{$permission->description}}</td>
                                <td>@if( \Auth::user()->compruebaSeguridad('editar-permiso') == true)
                                        {{ link_to_route('permisos.edit', 'Editar', $permission, array('class' => 'btn btn btn-warning btn-xs')) }}
                                    @endif
                                    @if( \Auth::user()->compruebaSeguridad('eliminar-permiso') == true)
                                        {{ Form::open(array('method'=> 'DELETE', 'route' => array('permisos.destroy', $permission->id),'style'=>'display:inline','class'=>'form_eliminar')) }}
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
                language: {
                    url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                },
                initComplete: function () {
                    var i = 1;
                    this.api().columns().every( function () {
                        if (i==2 || i==3) {
                            var column = this;
                            var select = $('<select><option value=""></option></select>')
                                .appendTo($(column.footer()).empty())
                                .on('change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );

                                    column
                                        .search(val ? '^' + val + '$' : '', true, false)
                                        .draw();
                                });

                            column.data().unique().sort().each(function (d, j) {
                                select.append('<option value="' + d + '">' + d + '</option>')
                            });
                        }
                        i++;
                    } );
                }
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
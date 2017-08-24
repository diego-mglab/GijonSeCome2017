<div class="col-md-12 connectedSortable ui-sortable">


    <div class="box box">
        <div class="box-header" style="background-color:#F2F2F2">
            <h3 class="box-title">Últimos ponentes</h3>

            <div class="box-tools pull-right">
                <span data-toggle="tooltip" title="" class="badge bg-grey" data-original-title="{{ $ponentes->count() }} Tareas">{{ $ponentes->count() }}</span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                </button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="display: block;">


            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                        <tr>

                            <th>Nombre</th>
                            <th>Restaurante</th>
                            <th>Año</th>
                        </tr>
                        </thead>
                        <tbody>



                        @foreach ($ponentes as $ponente)


                            <tr>



                                <td>{{is_object($ponente->textos_idioma_principal)?link_to_route('ponentes.edit',$ponente->textos_idioma_principal->titulo, array($ponente->id), array()):''}}</td>

                                <td>{{is_object($ponente->textos_idioma_principal)?link_to_route('ponentes.edit', $ponente->textos_idioma_principal->subtitulo, array($ponente) ):''}}</td>

                                <td>{{$ponente->anio}}</td>

                            </tr>

                        @endforeach


                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->



        </div>
        <!-- /.box-body -->

        {{-- pie boton añadir tarea --}}
        <div class="box-footer clearfix">
            {{ link_to_route('ponentes.create', 'Nuevo ponente', null, array('class' => 'btn btn-block btn-success btn-xs')) }}
        </div>

        <!-- /.box-footer -->

    </div>
</div>
<div class="col-md-6 connectedSortable ui-sortable">


    <div class="box box">
        <div class="box-header" style="background-color:#F2F2F2">
            <h3 class="box-title">Últimas entrevistas</h3>

            <div class="box-tools pull-right">
                <span data-toggle="tooltip" title="" class="badge bg-grey" data-original-title="{{ $entrevistas->count() }} Tareas">{{ $entrevistas->count() }}</span>
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

                            <th>Título</th>
                            <th>Subtítulo</th>
                            <th>Fecha</th>
                        </tr>
                        </thead>
                        <tbody>



                        @foreach ($entrevistas as $entrevista)


                            <tr>



                                <td>{{is_object($entrevista->textos_idioma_principal)?link_to_route('contents.edit',$entrevista->textos_idioma_principal->titulo, array($entrevista->id), array()):''}}</td>

                                <td>{{is_object($entrevista->textos_idioma_principal)?link_to_route('contents.edit', $entrevista->textos_idioma_principal->subtitulo, array($entrevista) ):''}}</td>

                                <td>{{$entrevista->fecha}}</td>

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
            {{ link_to_route('contents.create', 'Nueva entrevista', null, array('class' => 'btn btn-block btn-success btn-xs')) }}
        </div>

        <!-- /.box-footer -->

    </div>
</div>
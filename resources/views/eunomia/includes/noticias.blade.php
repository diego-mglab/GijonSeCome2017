<div class="col-md-6 connectedSortable ui-sortable">


    <div class="box box">
        <div class="box-header" style="background-color:#F2F2F2">
            <h3 class="box-title">Últimas noticias</h3>

            <div class="box-tools pull-right">
                <span data-toggle="tooltip" title="" class="badge bg-grey" data-original-title="{{ $noticias->count() }} Tareas">{{ $noticias->count() }}</span>
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



                        @foreach ($noticias as $noticia)


                            <tr>



                                <td>{{is_object($noticia->textos_idioma_principal)?link_to_route('contents.edit',$noticia->textos_idioma_principal->titulo, array($noticia->id), array()):''}}</td>

                                <td>{{is_object($noticia->textos_idioma_principal)?link_to_route('contents.edit', $noticia->textos_idioma_principal->subtitulo, array($noticia) ):''}}</td>

                                <td>{{$noticia->fecha}}</td>

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
            {{ link_to_route('contents.create', 'Nueva noticia', null, array('class' => 'btn btn-block btn-success btn-xs')) }}
        </div>

        <!-- /.box-footer -->

    </div>
</div>
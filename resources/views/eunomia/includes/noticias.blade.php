<div class="col-md-6">


    <div class="box box">
        <div class="box-header" style="background-color:#F2F2F2">
            <h3 class="box-title">Mis tareas para esta semana</h3>

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
                            <th>Visible</th>
                        </tr>
                        </thead>
                        <tbody>



                        @foreach ($noticias as $noticia)



                            <tr>



                                <td>{{link_to_route('noticias.edit',$noticia->textos_idioma_princicpal->titulo, array($noticia->id), array()) }}</td>

                                <td>{{ link_to_route('noticias.edit', $task->textos_idioma_principal->subtitulo, array($noticia) ) }}</td>

                                <td>{{$noticia->fecha}}</td>

                                <td>{{$noticia->visible}}</td>
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
            <a href="eunomia/noticias/create" class="btn btn-block btn-success btn-xs pull-left">Nueva noticia</a>
        </div>

        <!-- /.box-footer -->

    </div>
</div>
@extends('adminlte::page')

@section('content_header')
    <h1>
        Gestión
        <small>Menú</small>
    </h1>
    <h2><a href="#newModal" class="btn btn-block btn-success btn-xs" data-toggle="modal">nuevo</a></h2>

    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Menú</li>
    </ol>
@stop

@section('content')
  <div class="row">
    <div class="col-md-8">
      <div class="well">
        <div class="dd" id="nestable">
          <?php echo $menu ?>
          {{ csrf_field() }}
        </div>

        <p id="success-indicator" style="display:none; margin-right: 10px;">
          <span class="glyphicon glyphicon-ok"></span> El orden del menú ha sido actualizado
        </p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="well">
        <p>Arrastre elementos para moverlos en un orden diferente</p>
      </div>
    </div>
  </div>

  <!-- Create new item Modal -->
   <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
       <div class="modal-content">
        {{ Form::open(array('url'=>'eunomia/menu/new','class'=>'form-horizontal','role'=>'form'))}}
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Proporcione detalles del nuevo elemento de menú</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <label for="title" class="col-lg-2 control-label">Título</label>
                <div class="col-lg-10">
                  {{ Form::text('title',null,array('class'=>'form-control' ,'placeholder' => 'Título'))}}
                </div>
            </div>
            <!-- Custom tabs (Charts with tabs)-->
            <div class="nav-tabs-custom">
              <!-- Tabs within a box -->
              <ul class="nav nav-tabs pull-right">
                  @foreach($idiomas as $idioma)
                      <li
                              @if($idioma->principal==1)
                              class="active"
                              @endif
                      ><a href="#{{$idioma->codigo}}" data-toggle="tab"><img src="/images/idiomas/{{$idioma->imagen}}" alt="{{$idioma->idioma}}">&nbsp;{{$idioma->idioma}}</a></li>
                  @endforeach
              </ul>
              <div class="tab-content no-padding">

                  @foreach($idiomas as $idioma)
                      {{Form::hidden('idioma_id[]',$idioma->id,['id' => 'idioma_id'])}}
                      <div class="chart tab-pane
                                    @if($idioma->principal == 1)
                              active
            @endif
                              " id="{{$idioma->codigo}}" style="position: relative;">

                          <!-- /.nav-tabs-custom -->

                          <div class="form-group">
                              <label for="label" class="col-lg-2 control-label">Etiqueta</label>
                              <div class="col-lg-10">
                                  {{ Form::text('label[]',null,array('class'=>'form-control' ,'placeholder' => 'Etiqueta en '.$idioma->idioma))}}
                              </div>
                          </div>

                          <div class="form-group">

                              <label for="visible" class="col-lg-2 control-label">Visible/Oculto</label>
                              <div class="col-lg-10">
                                  {{Form::checkbox('visible[]', $idioma->id, true,['class' => 'flat-green'])}}
                              </div>
                          </div>
                      </div>
                  @endforeach

              </div>
            </div>
            <div class="form-group">
                <label for="url" class="col-lg-2 control-label">URL</label>
                <div class="col-lg-10">
                  {{ Form::text('url',null,array('class'=>'form-control' ,'placeholder' => 'URL'))}}
                </div>
            </div>
            <div class="form-group">
              <label for="menu_pie" class="col-lg-2 control-label">Menú pie</label>
              <div class="col-lg-10">
                  {{Form::checkbox('menu_pìe', 1, false,['class' => 'flat-green'])}}
              </div>
            </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
           <button type="submit" class="btn btn-primary">Crear</button>
         </div>
         {{ Form::close()}}
       </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
   </div><!-- /.modal -->
  
  <!-- Delete item Modal -->
   <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
       <div class="modal-content">
          {{ Form::open(array('url'=>'eunomia/menu/delete')) }}
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Proporcione detalles del nuevo elemento de menú</h4>
          </div>
          <div class="modal-body">
            <p>¿Está seguro de que desea eliminar este elemento del menú?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <input type="hidden" name="delete_id" id="postvalue" value="" />
            <input type="submit" class="btn btn-danger" value="Eliminar elemento" />
          </div>
          {{ Form::close() }}
       </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
   </div><!-- /.modal -->
@endsection

@section('css')
    <!-- Nestable -->
    <link rel="stylesheet" href="{{asset("vendor/nestable/nestable.css")}}">

    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('vendor/adminlte/plugins/iCheck/flat/green.css')}}">
@stop

@section('js')
    <!-- Nestable -->
    <script src="{{asset("vendor/nestable/jquery.nestable.js")}}"> </script>
    <script type="text/javascript">
        $(function() {
            $('.dd').nestable({
                dropCallback: function(details) {

                    var order = new Array();
                    $("li[data-id='"+details.destId +"']").find('ol:first').children().each(function(index,elem) {
                      order[index] = $(elem).attr('data-id');
                    });

                    if (order.length === 0){
                        var rootOrder = new Array();
                        $("#nestable > ol > li").each(function(index,elem) {
                            rootOrder[index] = $(elem).attr('data-id');
                        });
                    }

                    $.post('{{url("eunomia/menu/")}}',
                    { source : details.sourceId,
                      destination: details.destId,
                      order:JSON.stringify(order),
                      rootOrder:JSON.stringify(rootOrder),
                      _token:$("input[name='_token']").val() // Token generado en el campo de arriba para los formularios de Laravel (CSRF Protection)
                    }, function(data) {
                         console.log('data '+data);
                    }).done(function() {
                        $( "#success-indicator" ).fadeIn(100).delay(1000).fadeOut();
                    }).fail(function(data) { console.log('data '+data.responseText); }).always(function() {  });
                }
            });

            $('.delete_toggle').each(function(index,elem) {
                $(elem).click(function(e){
                    e.preventDefault();
                    $('#postvalue').attr('value',$(elem).attr('rel'));
                    $('#deleteModal').modal('toggle');
                });
            });
      });
    </script>

    <!-- iCheck -->
    <script src="{{asset('vendor/adminlte/plugins/iCheck/icheck.min.js')}}"></script>
    <script>
        //Green color scheme for iCheck
        $('input[type="checkbox"].flat-green').iCheck({
            checkboxClass: 'icheckbox_flat-green'
        });
    </script>
@stop

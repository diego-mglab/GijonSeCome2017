@extends('adminlte::page')

@section('content')
  <div class="row">
    <div class="col-md-8">  
      <div class="well">
        <p class="lead"><a href="{{ url('eunomia/menu')}}" class=""btn btn-primary pull-right">Volver</a> Menú:</p>

		{{ Form::model($item, array('url' => "eunomia/menu/edit/{$item->id}", 'class' => 'form-horizontal')) }}
		<div class="form-group">
		    <label for="title" class="col-lg-2 control-label">Título</label>
		    <div class="col-lg-10">
		      {{ Form::text('title',null,array('class'=>'form-control'))}}
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
				  <?php
					  $menu_pie = $item->menu_pie;
				  ?>
				  @foreach($idiomas as $idioma)
                      <?php
                      $titulo = "";
                      $visible = false;
                      //dd($textos);
                      ?>
					  @foreach($textos as $texto)
                          <?php
                          if ($texto->idioma_id == $idioma->id) {
                              $titulo = $texto->titulo;
                              $visible = $texto->visible;
                          }
                          ?>
					  @endforeach
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
								  {{ Form::text('label[]',$titulo,array('class'=>'form-control' ,'placeholder' => 'Etiqueta en '.$idioma->idioma))}}
							  </div>
						  </div>

						  <div class="form-group">

							  <label for="visible" class="col-lg-2 control-label">Visible/Oculto</label>
							  <div class="col-lg-10">
								  {{Form::checkbox('visible[]', $idioma->id, $visible,['class' => 'flat-green'])}}
							  </div>
						  </div>
					  </div>
				  @endforeach

			  </div>
		  </div>
		  <div class="form-group">
			  <label for="content_id" class="col-lg-2 control-label">Página</label>
			  <div class="col-lg-9">
				  {{ Form::select('content_id',$paginas,null,['class' => 'form-control','placeholder' => 'Seleccione una página', 'onchange' => '$("#sel_pagina").prop("checked",true)'])}}
			  </div>
			  <div class="col-lg-1">
				  {{ Form::radio('sel_link',1,$item->content_id>0?'checked':'',['id' => 'sel_pagina'])}}
			  </div>
		  </div>
		  <div class="form-group">
			  <label for="url" class="col-lg-2 control-label">URL</label>
			  <div class="col-lg-9">
				  {{ Form::text('url',null,['class'=>'form-control', 'onkeypress' => '$("#sel_url").prop("checked",true)'])}}
			  </div>
			  <div class="col-lg-1">
				  {{ Form::radio('sel_link',2,$item->url!=''?'checked':'',['id' => 'sel_url'])}}
			  </div>
		  </div>
		<div class="form-group">
		  <label for="menu_pie" class="col-lg-2 control-label">Menú pie</label>
		  <div class="col-lg-10">
			  {{Form::checkbox('menu_pie', '1', $menu_pie,['class' => 'flat-green'])}}
		  </div>
		</div>
		<div class="form-group">
		    <div class="col-md-6 col-md-offset-6 text-right">
		      <button type="submit" class="btn btn-lg btn-default">Actualizar elemento</button>
		    </div>
		</div>
		{{ Form::close()}}
      </div>
    </div>
    
  </div>
@stop

@section('css')
	<!-- iCheck -->
	<link rel="stylesheet" href="{{asset('vendor/adminlte/plugins/iCheck/flat/green.css')}}">

	<!-- jQuery editable select -->
	<link rel="stylesheet" href="{{asset('css/jquery-editable-select.css')}}">
@stop

@section('js')
	<!-- iCheck -->
	<script src="{{asset('vendor/adminlte/plugins/iCheck/icheck.min.js')}}"></script>
	<script>
        //Green color scheme for iCheck
        $('input[type="checkbox"].flat-green').iCheck({
            checkboxClass: 'icheckbox_flat-green'
        });
	</script>

	<!-- jQuery editable select -->
	<script src="{{asset("js/jquery-editable-select.js")}}"> </script>
	<script type="text/javascript">
        $('#url').editableSelect();
	</script>
@stop

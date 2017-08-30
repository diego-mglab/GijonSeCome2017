@extends('adminlte::page')

@section('content')
  <div class="row">
    <div class="col-md-8">  
      <div class="well">
        <p class="lead"><a href="{{ url('eunomia/menu_admin')}}" class=""btn btn-primary pull-right">Volver</a> Menú:</p>

		{{ Form::model($item, array('url' => "eunomia/menu_admin/edit/{$item->id}", 'class' => 'form-horizontal')) }}

        <?php
              $title = $item->title;
              $label = $item->label;
              $label_color = $item->label_color;
              $url = $item->url;
              $icono = $item->icon;
              $tabla = $item->table;
              $separator = $item->separator;
              $visible = $item->visible;
        ?>
        <div class="form-group">
		    <label for="title" class="col-lg-2 control-label">Título</label>
		    <div class="col-lg-10">
		      {{ Form::text('title',$title,array('class'=>'form-control'))}}
		    </div>
		</div>

		<div class="form-group">
			<label for="label" class="col-lg-2 control-label">Etiqueta</label>
			<div class="col-lg-10">
			  	{{ Form::text('label',$label,array('class'=>'form-control' ,'placeholder' => 'Etiqueta'))}}
			</div>
		</div>

        <div class="form-group">
            {{Form::label('label_color', 'Color del label',['class' => 'col-lg-2 control-label'])}}
            <div class="col-lg-10">
                <select name="label_color" class="form-control" id="label_color">
                    <option value="">Seleccione un color</option>
                    <option value="default"{{$label_color=='default'?' selected="selected"':''}}>Blanco</option>
                    <option value="primary"{{$label_color=='primary'?' selected="selected"':''}}>Azul marino</option>
                    <option value="success"{{$label_color=='success'?' selected="selected"':''}}>Verde</option>
                    <option value="info"{{$label_color=='info'?' selected="selected"':''}}>Azul claro</option>
                    <option value="warning"{{$label_color=='warning'?' selected="selected"':''}}>Naranja</option>
                    <option value="danger"{{$label_color=='danger'?' selected="selected"':''}}>Rojo</option>
                </select>
            </div>
        </div>

          <div class="form-group">
              {{Form::label('icono', 'Icono',['class' => 'col-lg-2 control-label'])}}
              <div class="col-lg-10">
                  <select name="icon" class="form-control" id="icon">
                      <option value="">Seleccione un icono</option>
                      @foreach($icons as $icon)
                          @foreach ($icon as $element)
                              <option value="{{$element['id']}}"<?=$element['id']==$icono?' selected="selected"':''?>>&#x{{$element['unicode']}}; fa-{{$element['id']}}</option>
                          @endforeach
                      @endforeach
                  </select>
              </div>
          </div>

          <div class="form-group">
            <label for="url" class="col-lg-2 control-label">URL</label>
            <div class="col-lg-10">
                {{ Form::text('url',$url,['class'=>'form-control', 'placeholder' => 'URL'])}}
            </div>
        </div>

          <div class="form-group">
              {{Form::label('modulo_id', 'Módulo',['class' => 'col-lg-2 control-label'])}}
              <div class="col-lg-10">
                  {{Form::select('modulo_id', $modulos, null, ['class' => 'form-control', 'placeholder'=>'selecciona un módulo'])}}
              </div>
          </div>

        <div class="form-group">
            {{Form::label('table','Contador (tabla)',['class' => 'col-lg-2 control-label'])}}
            <div class="col-lg-10">
                <select name="table" class="form-control" id="table">
                    <option value="">Seleccione un tabla</option>
                    <?php
                    $metodo = 'Tables_in_'.env('DB_DATABASE');
                    ?>
                    @foreach($tables as $table)
                        <option value="{{$table->$metodo}}"{{$table->$metodo==$tabla?'selected=" selected"':''}}>{{$table->$metodo}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="separator" class="col-lg-2 control-label">Separador</label>
            <div class="col-lg-10">
                {{Form::checkbox('separator', 1, $separator,['class' => 'flat-green'])}}
            </div>
        </div>

		<div class="form-group">
		    <label for="visible" class="col-lg-2 control-label">Visible/Oculto</label>
			<div class="col-lg-10">
			  	{{Form::checkbox('visible', 1, $visible,['class' => 'flat-green'])}}
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

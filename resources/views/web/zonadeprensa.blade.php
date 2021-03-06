@extends('layouts.web')

@section('contenido')

    <!-- comienza contenido de la página-->

    <!-- Start Map -->
    <div>

        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2892.303780182304!2d-5.639408984506004!3d43.537709179125464!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd367b83a8497939%3A0xc7d19cb62c3ce240!2sRecinto+Ferial+Luis+Adaro!5e0!3m2!1ses!2ses!4v1477056537105" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>

    </div>

    <!-- End Map -->
    <!-- Start Content -->
    <div id="content">
        <div class="container">

            <div class="row">

                <div class="col-md-8">

                    <!-- Classic Heading -->
                    <h4 class="classic-title"><span>{{__('zonadeprensa.zona_de_prensa')}}</span></h4>

                    <!-- Start Contact Form -->

                    {!! Form::open(['route' => 'zonadeprensa_web_post_'.Session::get('idioma'),'method' => 'POST', 'name' => 'form_contacto', 'class' =>'contact-form', 'id' => 'contact-form']) !!}

                        <div class="form-group">
                            <div class="controls">
                                {{Form::text('nombre', null, ['placeholder' => __('zonadeprensa.nombre')])}}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="controls">
                                {{Form::text('medio', null, ['placeholder' => __('zonadeprensa.medio_o_blog')])}}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="controls">
                                {{Form::email('email', null, ['class' => 'email', 'placeholder' => __('zonadeprensa.email')])}}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="controls">
                                {{Form::text('asunto', null, ['class' => 'requiredField', 'placeholder' => __('zonadeprensa.asunto')])}}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="controls">
                                {{Form::textarea('mensaje', null, ['rows' => '7', 'placeholder' => __('zonadeprensa.mensaje'), 'id' => 'mensaje'])}}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="controls">
                                <span class="checkbox">{{Form::checkbox('acepto', null,false, ['class' => 'flat-green', 'id' => 'acepto'])}} Acepto <a href="/{{\Session::get('idioma')}}/{{\Session::get('idioma')=='es'?'advertencia-legal':'alvertencia-llegal'}}" target="_blank">LOPD</a></span>

                            </div>
                        </div>

                        {{Form::hidden('email_envio',null,['id'  => 'email_envio'])}}
                        <button type="submit" id="submit" class="btn-system btn-large">{{__('zonadeprensa.enviar')}}</button>
                        <div id="success" style="color:#34495e;"></div>
                {!! Form::close() !!}
                    <!-- End Contact Form -->

                </div>

                <div class="col-md-4">

                    <!-- Classic Heading -->
                    <h4 class="classic-title"><span>{{__('zonadeprensa.documentos_para_prensa')}}</span></h4>
                    <ul class="list-unstyled">
                        @foreach($documentosPrensa as $documento)
                            @if (is_object($documento->textos_idioma))
                            <li>
                                <a href="{{asset('files/prensa')}}/{{$documento->fichero}}" target="_blank">{{$documento->textos_idioma->titulo}}</a>
                            </li>
                            @endif
                        @endforeach
                    </ul>

                    <!-- Classic Heading -->
                    <h4 class="classic-title"><span>{{__('zonadeprensa.informacion')}}</span></h4>

                    <!-- Some Info -->



                    <!-- Info - Icons List -->
                    <ul class="icons-list">
                        <li><i class="fa fa-globe">  </i> <strong>{{__('zonadeprensa.direccion')}}:</strong> {{__('zonadeprensa.recinto_ferial')}}.</li>
                        <li><i class="fa fa-envelope-o"></i> <strong>{{__('zonadeprensa.email')}}:</strong>info@gijonsecome.es</li>
                        <li><i class="fa fa-mobile"></i> <strong>{{__('zonadeprensa.telefono')}}:</strong> +34 985 17 15 52 </li>
                    </ul>

                    <!-- Divider -->
                    <div class="hr1" style="margin-bottom:15px;"></div>

                    <!-- Classic Heading -->
                    <h4 class="classic-title"><span>{{__('zonadeprensa.horario_atencion_telefonica')}} (mglab)</span></h4>

                    <!-- Info - List -->
                    <ul class="list-unstyled">
                        <li><strong>{{__('zonadeprensa.lunes')}} a {{__('zonadeprensa.viernes')}}</strong>- 9:00 a 18:00 </li>
                        <li><strong>{{__('zonadeprensa.sabado')}} y {{__('zonadeprensa.domingo')}}</strong> - {{__('zonadeprensa.cerrado')}}</li>
                    </ul>


                    <!-- Divider -->
                    <div class="hr1" style="margin-bottom:15px;"></div>

                    <h4 class="classic-title"><span>{{__('zonadeprensa.horario_festival')}} {{__('zonadeprensa.gijonsecome')}}</span></h4>

                    <!-- Info - List -->
                    <ul class="list-unstyled">
                        <li><strong>{{__('zonadeprensa.sabado')}} 3 y {{__('zonadeprensa.domingo')}} 4 de {{__('zonadeprensa.diciembre')}} </strong>- 11:00 a 22:00</li>
                        <li><strong>{{__('zonadeprensa.lunes')}} 5 de {{__('zonadeprensa.diciembre')}}</strong> - 11:00 a 22:00</li>
                    </ul>

                </div>

            </div>

            <!-- Divider -->
            <div class="hr1 margin-60"></div>
            <!-- fin contacta -->

        </div>
        <!-- End Container -->

@endsection

@section('css')

    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('vendor/adminlte/plugins/iCheck/flat/green.css')}}">

@endsection

@section('js')
    <!-- Jquery Validator -->
        <script src="{{asset('js/jquery.validate.js')}}"></script>
        <script language="JavaScript">
            $().ready(function() {
                // validate signup form on keyup and submit
                $("#contact-form").validate({
                    rules: {
                        nombre: "required",
                        medio: "required",
                        email: {
                            required: true,
                            email: true
                        },
                        asunto: "required",
                        mensaje: {
                            required: true,
                            maxlength: 2000
                        },
                        acepto: "required"
                    },
                    messages: {
                        nombre: "{{__('zonadeprensa.nombre_req')}}",
                        medio: "{{__('zonadeprensa.medio_req')}}",
                        email: "{{__('zonadeprensa.email_req')}}",
                        asunto: "{{__('zonadeprensa.asunto_req')}}",
                        mensaje: "{{__('zonadeprensa.mensaje_req')}}",
                        acepto: "{{__('contacto.acepto_req')}}"
                    }
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
@endsection

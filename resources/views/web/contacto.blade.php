@extends('layouts.web')

@section('contenido')

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
                    <h4 class="classic-title"><span>{{__('contacto.contacta_con_nosotros')}}</span></h4>

                    <!-- Start Contact Form -->

                    {!! Form::open(['route' => $ruta_formulario.'_web_post_'.Session::get('idioma'),'method' => 'POST', 'name' => 'form_contacto', 'class' =>'contact-form', 'id' => 'contact-form']) !!}
                        <div class="form-group">
                            <div class="controls">
                                {{Form::select('tipo_contacto', ['Expositores' => __('contacto.expositores'),'Patrocinadores' => __('contacto.patrocinadores'),'Programación del festival' => __('contacto.programacion_festival')],null, ['placeholder' => __('contacto.tipo_contacto'), 'id' => 'tipo_contacto'])}}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="controls">
                                {{Form::text('nombre', null, ['placeholder' => __('contacto.nombre')])}}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="controls">
                                {{Form::email('email', null, ['class' => 'email', 'placeholder' => __('contacto.email')])}}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="controls">
                                {{Form::text('asunto', null, ['class' => 'requiredField', 'placeholder' => __('contacto.asunto')])}}
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="controls">
                                {{Form::textarea('mensaje', null, ['rows' => '7', 'placeholder' => __('contacto.mensaje'), 'id' => 'mensaje'])}}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="controls">
                                <span class="checkbox">{{Form::checkbox('acepto', null,false, ['class' => 'flat-green', 'id' => 'acepto'])}} Acepto <a href="/{{\Session::get('idioma')}}/{{\Session::get('idioma')=='es'?'advertencia-legal':'alvertencia-llegal'}}" target="_blank">LOPD</a></span>

                            </div>
                        </div>

                    {{Form::hidden('email_envio',null,['id'  => 'email_envio'])}}
                        <button class="btn-system btn-large g-recaptcha" data-sitekey="{{env('RE_CAP_SITE')}}" data-callback="onSubmit">{{__('contacto.enviar')}}</button>
                        <div id="success" style="color:#34495e;"></div>
                {!! Form::close() !!}
                    <!-- End Contact Form -->

                </div>

                <div class="col-md-4">

                    <!-- Classic Heading -->
                    <h4 class="classic-title"><span>{{__('contacto.informacion')}}</span></h4>

                    <!-- Some Info -->



                    <!-- Info - Icons List -->
                    <ul class="icons-list">
                        <li><i class="fa fa-globe">  </i> <strong>{{__('contacto.direccion')}}:</strong> {{__('contacto.recinto_ferial')}}.</li>
                        <li><i class="fa fa-envelope-o"></i> <strong>{{__('contacto.email')}}:</strong>info@gijonsecome.es</li>
                        <li><i class="fa fa-mobile"></i> <strong>{{__('contacto.telefono')}}:</strong> +34 985 17 15 52 </li>
                    </ul>

                    <!-- Divider -->
                    <div class="hr1" style="margin-bottom:15px;"></div>

                    <!-- Classic Heading -->
                    <h4 class="classic-title"><span>{{__('contacto.horario_atencion_telefonica')}} (mglab)</span></h4>

                    <!-- Info - List -->
                    <ul class="list-unstyled">
                        <li><strong>{{__('contacto.lunes')}} a {{__('contacto.viernes')}}</strong>- 9:00 a 18:00 </li>
                        <li><strong>{{__('contacto.sabado')}} y {{__('contacto.domingo')}}</strong> - {{__('contacto.cerrado')}}</li>
                    </ul>


                    <!-- Divider -->
                    <div class="hr1" style="margin-bottom:15px;"></div>

                    <h4 class="classic-title"><span>{{__('contacto.horario_festival')}} {{__('contacto.gijonsecome')}}</span></h4>

                    <!-- Info - List -->
                    <ul class="list-unstyled">
                        <li><strong>{{__('contacto.sabado')}} 3 y {{__('contacto.domingo')}} 4 de {{__('contacto.diciembre')}} </strong>- 11:00 a 22:00</li>
                        <li><strong>{{__('contacto.lunes')}} 5 de {{__('contacto.diciembre')}}</strong> - 11:00 a 22:00</li>
                    </ul>

                </div>

            </div>

            <!-- Divider -->
            <div class="hr1 margin-60"></div>
            <!-- fin contacta -->

        </div>
        <!-- End Container -->
    </div>
    <!-- End Content -->

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
                    tipo_contacto: "required",
                    nombre: "required",
                    email: {
                        required: true,
                        email: true
                    },
                    asunto: "required",
                    mensaje: {
                        required: true,
                        maxlength: 2000
                    },
                    acepto: "required",
                    'g-recaptcha-response': "required|captcha"
        },
                messages: {
                    tipo_contacto: "{{__('contacto.tipo_contacto_req')}}",
                    nombre: "{{__('contacto.nombre_req')}}",
                    email: "{{__('contacto.email_req')}}",
                    asunto: "{{__('contacto.asunto_req')}}",
                    mensaje: "{{__('contacto.mensaje_req')}}",
                    acepto: "{{__('contacto.acepto_req')}}"
                }
            });
        });

    </script>

    <script language="JavaScript">
        $(function() {
            $('#tipo_contacto').change(function (e) {
                $("#email_envio").val(this.value);
            });
        });
    </script>

    <!-- Google reCaptcha -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script>
        function onSubmit(token) {
            document.getElementById("contact-form").submit();
        }
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

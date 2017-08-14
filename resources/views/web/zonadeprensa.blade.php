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
                    <h4 class="classic-title"><span>Zona de prensa</span></h4>

                    <!-- Start Contact Form -->

                    {!! Form::open(['action' => 'WebController@zonadeprensa','method' => 'POST', 'name' => 'form_contacto', 'class' =>'contact-form', 'id' => 'contact-form']) !!}

                        <div class="form-group">
                            <div class="controls">
                                {{Form::text('nombre', null, ['placeholder' => 'Nombre'])}}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="controls">
                                {{Form::text('medio', null, ['placeholder' => 'Medio o blog'])}}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="controls">
                                {{Form::email('email', null, ['class' => 'email', 'placeholder' => 'Email'])}}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="controls">
                                {{Form::text('asunto', null, ['class' => 'requiredField', 'placeholder' => 'Asunto'])}}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="controls">
                                {{Form::textarea('mensaje', null, ['rows' => '7', 'placeholder' => 'Mensaje'])}}
                            </div>
                        </div>
                        {{Form::hidden('email_envio',null,['id'  => 'email_envio'])}}
                        <button type="submit" id="submit" class="btn-system btn-large">Enviar</button>
                        <div id="success" style="color:#34495e;"></div>
                {!! Form::close() !!}
                    <!-- End Contact Form -->

                </div>

                <div class="col-md-4">

                    <!-- Classic Heading -->
                    <h4 class="classic-title"><span>Documentos para prensa</span></h4>
                    <ul>
                        <li>
                            <a href="#">DOCUMENTO PRUEBA</a>
                        </li>
                    </ul>

                    <!-- Classic Heading -->
                    <h4 class="classic-title"><span>Información</span></h4>

                    <!-- Some Info -->



                    <!-- Info - Icons List -->
                    <ul class="icons-list">
                        <li><i class="fa fa-globe">  </i> <strong>Dirección:</strong> Recinto Ferial Luis Adaro.</li>
                        <li><i class="fa fa-envelope-o"></i> <strong>Email:</strong>info@gijonsecome.es</li>
                        <li><i class="fa fa-mobile"></i> <strong>Teléfono:</strong> +34 985 17 15 52 </li>
                    </ul>

                    <!-- Divider -->
                    <div class="hr1" style="margin-bottom:15px;"></div>

                    <!-- Classic Heading -->
                    <h4 class="classic-title"><span>Horario de atención telefónica (mglab)</span></h4>

                    <!-- Info - List -->
                    <ul class="list-unstyled">
                        <li><strong>Lunes a viernes</strong>- 9:00 a 18:00 </li>
                        <li><strong>Sábado y domingo</strong> - cerrado</li>
                    </ul>


                    <!-- Divider -->
                    <div class="hr1" style="margin-bottom:15px;"></div>

                    <h4 class="classic-title"><span>Horario del festival GijónSeCome</span></h4>

                    <!-- Info - List -->
                    <ul class="list-unstyled">
                        <li><strong>Sábado 3 y domingo 4 de diciembre </strong>- 11:00 a 22:00</li>
                        <li><strong>Lunes 5 de diciembre</strong> - 11:00 a 22:00</li>
                    </ul>

                </div>

            </div>



            <!-- Start Services Icons -->
            <!-- End Services Icons -->




            <!-- Divider -->
            <div class="hr1 margin-60"></div>
            <!-- fin contacta -->


        </div>
        <!-- End Container -->

@endsection

@section('css')

@endsection

@section('js')

@endsection

@extends('layouts.web')

@section('contenido')

    <section id="migadepan">
        <div class="col-xs-12">
            <ul>
                <li>
                    INICIO // 404
                </li>
            </ul>
        </div>
    </section>

    <section id="error">
        <div class="row">
            <div class="col-xs-12">
                <article>
                    <h1>Ooops, la página que buscas no existe</h1>
                    <div style="width: 100%; text-align: center; margin-top: 1em;"><img src="{{asset('images/huevo-roto-rsm.jpg')}}"></div>
                </article>
            </div>
        </div>
    </section>

@endsection
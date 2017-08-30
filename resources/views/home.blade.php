@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

    @if (Session::has('status'))
        <hr />
        <div class='alert alert-success'>
            {{Session::get('status')}}
        </div>
        <hr />
    @endif

    @if( \Auth::user()->compruebaSeguridad('mostrar-contenidos') == true)
    <div class="row">
        @include('eunomia.includes.noticias')
        @include('eunomia.includes.entrevistas')
    </div>
    @endif
    @if( \Auth::user()->compruebaSeguridad('mostrar-ponentes') == true)
    <div class="row">
        @include('eunomia.includes.ponentes')
    </div>
    @endif
@stop

@section('js')
    <script src="{{asset("vendor/adminlte/plugins/jQueryUI/jquery-ui.min.js")}}"> </script>
    <script language="JavaScript">
        $('.connectedSortable').sortable({
            placeholder         : 'sort-highlight',
            connectWith         : '.connectedSortable',
            handle              : '.box-header, .nav-tabs',
            forcePlaceholderSize: true,
            zIndex              : 999999
        });
        $('.connectedSortable .box-header, .connectedSortable .nav-tabs-custom').css('cursor', 'move');    </script>
@endsection
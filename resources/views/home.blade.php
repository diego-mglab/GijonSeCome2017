@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    @include('eunomia.includes.box')

    <div class="row">
        @include('eunomia.includes.noticias')
        @include('eunomia.includes.entrevistas')
    </div>
    <div class="row">
        @include('eunomia.includes.ponentes')
    </div>
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
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
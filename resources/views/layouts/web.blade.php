<!DOCTYPE html>
<html>
<head>

    @include('web.includes.metas')
    @include('web.includes.css')

</head>


<body>


@include('web.includes.top')
@include('web.includes.menu')

@yield('contenido')



@include('web.includes.logos')
@include('web.includes.pie')

@include('web.includes.scripts')


</body>
</html>
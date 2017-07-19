<!doctype html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
<html lang="es">
<head>

    @include('web.includes.head')

</head>


<body>
<div id="container">


@include('web.includes.top')

@yield('contenido')



@include('web.includes.pie')


</div>
@include('web.includes.scripts')


</body>
</html>
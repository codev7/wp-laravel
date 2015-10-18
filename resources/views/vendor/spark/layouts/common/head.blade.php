@if(isProduction())
    

    <link rel="stylesheet" media="all" href="{{ elixir('css/cmv-app.css') }}">


@else

    <link rel="stylesheet" href="{{ asset('css/cmv-app.css') }}" media="screen">

@endif
@include('common/head')


<!-- Spark Globals -->
@include('spark::scripts.globals')

<!-- Injected Scripts -->
@yield('scripts', '')
<!DOCTYPE html>
<html lang="en">
<head>
    @include('spark::layouts.common.head')
</head>
<body class="with-top-navbar">
    <!-- Vue App For Spark Screens -->
    <div id="spark-app" v-cloak>
        <div class="growl" id="app-growl"></div>

        <!-- Navigation -->
        @if (Auth::check())
            @include('spark::nav.authenticated')
        @else
            @include('spark::nav.guest')
        @endif

        
        @yield('content')
        

        <!-- Footer -->
        @include('spark::common.footer')

        @include('common/footer')
    </div>
</body>
</html>

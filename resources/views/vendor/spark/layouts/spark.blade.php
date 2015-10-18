<!DOCTYPE html>
<html lang="en">
<head>
    @include('spark::layouts.common.head')
</head>
<body>
    <!-- Vue App For Spark Screens -->
    <div id="spark-app" v-cloak>
        <!-- Navigation -->
        @if (Auth::check())
            @include('spark::nav.authenticated')
        @else
            @include('spark::nav.guest')
        @endif

        <!-- Main Content -->
        @yield('content')

        <!-- Footer -->
        @include('spark::common.footer')

        @include('common/footer')
    </div>
</body>
</html>

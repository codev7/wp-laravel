<!DOCTYPE html>
<html lang="en">
    
    <head>
        
        @include('spark::layouts.common.head')
        
    <head>
    @yield('body','<body>')

    @yield('content')
    
    <!-- Footer -->
    @include('spark::common.footer')

    @include('common/footer')
</body>
</html>
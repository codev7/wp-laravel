<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<meta id="token" name="csrf-token" content="{{ csrf_token() }}"/>
<meta id="stripe-token" name="stripe-token" content="{{ env('STRIPE_PUBLIC') }}"/>

@yield('meta')

@yield('title','<title>Code My Views</title>')


<script type="text/javascript">

    CObj = {!! getCodeMyViewsUserObject() !!}

</script>


@yield('additional_js')

<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]--> 


@if(isProduction())
    <!-- Kissmetrics tracking snippet -->
    <script type="text/javascript">var _kmq = _kmq || [];
    var _kmk = _kmk || 'd80e293bb283d86681d2314affdd8c509b54a3a5';
    function _kms(u){
      setTimeout(function(){
        var d = document, f = d.getElementsByTagName('script')[0],
        s = d.createElement('script');
        s.type = 'text/javascript'; s.async = true; s.src = u;
        f.parentNode.insertBefore(s, f);
      }, 1);
    }
    _kms('//i.kissmetrics.com/i.js');
    _kms('//scripts.kissmetrics.com/' + _kmk + '.2.js');
    </script>

    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-63852413-1', 'auto');
    ga('send', 'pageview');

    @if(Auth::check())
    ga('set', '&uid', '{{ Auth::user()->email }}'); // Set the user ID using signed-in user_id.
    @endif

    @yield('content_grouping')
    </script>
@endif
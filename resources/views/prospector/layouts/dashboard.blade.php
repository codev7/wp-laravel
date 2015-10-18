<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CMV Prospector</title>


    <link href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic" rel="stylesheet">

    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
    {!!  Flash::renderMainFlash() !!}
    <div class="container">
        <div class="row">
            <div class="col-sm-3 sidebar">
                <nav class="sidebar-nav">
                    <div class="sidebar-header">
                        <button class="nav-toggler nav-toggler-sm sidebar-toggler" type="button" data-toggle="collapse" data-target="#nav-toggleable-sm">
                            <span class="sr-only">Toggle nav</span>
                        </button>
                        <a class="sidebar-brand img-responsive" href="/">
                            <img src="https://codemyviews.com/images/code-my-views-square-mark.png" style="height: 50px" alt="Code My Views Inc." />
                        </a>
                    </div>

                    <div class="collapse nav-toggleable-sm" id="nav-toggleable-sm">
                    <form class="sidebar-form" style="display: none">
                            <input class="form-control" type="text" placeholder="Search...">
                            <button type="submit" class="btn-link">
                                <span class="icon icon-magnifying-glass"></span>
                            </button>
                        </form>
                        <ul class="nav nav-pills nav-stacked">
                            <li class="nav-header">Pages</li>
                            <li class="{{ set_active('dashboard') }}">
                                <a href="/dashboard/">Dashboard</a>
                            </li>
                            <li  class="{{ set_active('companies') }}">
                                <a href="{{ route('companies',['filter' => 'all']) }}">Companies</a>
                            </li>
                            <li  class="{{ set_active('contacts') }}">
                                <a href="/contacts/">Contacts</a>
                            </li>

                            @if(Auth::check())
                            <li>
                                <a href="/auth/logout">Logout</a>
                            </li>
                            @endif
                        </ul>
                        <hr class="visible-xs m-t">
                    </div>
                </nav>
            </div>
            
            <div class="col-sm-9 content">
                
                @yield('content')

            </div>
            

        </div>
   


<script src="{{ asset('js/theme.js') }}"></script>
</body>
</html>

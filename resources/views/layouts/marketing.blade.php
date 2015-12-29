<!DOCTYPE html>
<html lang="en">
    
    <head>
        
        @if(isProduction())
    

            <link rel="stylesheet" media="all" href="{{ elixir('css/codemyviews.css') }}">


        @else

            <link rel="stylesheet" href="{{ asset('css/codemyviews.css') }}" media="screen">

        @endif  
        @include('common/head')

    <head>
    @yield('body','<body class="inner">')

    <div id="wrapper">
        <header id="header">
            <div class="container">
                <nav class="navbar">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a data-pjax class="navbar-brand" href="/"><span class="sr-only">Code My Views</span></a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            @foreach(getMarketingHeaderNavigation() as $navigationItem)
                            
                                 @if(isset($navigationItem['children']))
                                    <li class="{{ set_active_from_route_name( $navigationItem['route-name'] ) }} dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ $navigationItem['text'] }} <span class="fa fa-angle-down"></span></a>
                                        <div class="dropdown-menu">
                                            <div class="container">
                                                <ul class="nav nav-pills">
                                                    @foreach($navigationItem['children'] as $label => $route)
                                                        <li><a data-pjax href="{{ $route }}">{{ $label }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </div><!--container-->
                                        </div><!--dropdown-menu-->
                                    </li>
                                @else
                                    <li class="{{ set_active_from_route_name( $navigationItem['route-name'] ) }}">
                                        <a data-pjax href="{{ route( $navigationItem['route-name'] ) }}">{{ $navigationItem['text'] }}</a>
                                    </li>
                                @endif
                            
                            @endforeach
                        </ul>

                        @if(Auth::check())
                        <a href="{{ getHomeLink() }}" class="btn btn-success">My Account</a>
                        @else
                        <a href="{{ route('quote') }}" class="btn btn-success">Get A Free Quote</a>
                        @endif
                        
                   
                    </div>
                </nav>
            </div>
        </header><!-- /header -->

        <div id="pjax-container">
            {!! setBodyClassIfPjax(['inner']) !!}

            @yield('content')
        </div>

        <footer id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-5">
                        <div class="holder clearfix">
                            <strong class="logo"><a data-pjax href="/"><span class="sr-only">{{ config('app.company_name') }}</span></a></strong>
                            <span class="copyright">&copy; <strong>{{ date('Y') }}</strong></span>
                        </div>
                        <ul class="nav nav-pills add-nav">
                            <li><a data-pjax href="{{ route('legal') }}">NDA</a></li>
                            <li><a data-pjax href="{{ route('legal') }}">Terms of Service</a></li>
                            <li><a data-pjax href="{{ route('legal') }}">Privacy Policy</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-8 col-md-7">
                        <div class="row">
                            <div class="col-lg-5 col-lg-offset-1 col-sm-7">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h4>About Us</h4>
                                        <ul class="list-unstyled nav-list">
                                            <li data-controller="cmv-jobs"><a href="#" class="jobs" v-on:click="step1($event)">Jobs</a></li>
                                            <li><a data-pjax href="{{ route('about-us') }}">About Us</a></li>
                                            <li><a data-pjax href="{{ route('methods') }}">Methodology</a></li>
                                            <li><a data-pjax href="{{ route('our-code') }}">Our Code</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4>Developer Daily</h4>
                                        <ul class="list-unstyled nav-list">
                                            <li><a data-pjax href="{{ route('blog') }}">Blog Index</a></li>
                                            <li><a data-pjax href="{{ route('blog.category',['category' => 'ui-ux']) }}">UI/UX</a></li>
                                            <li><a data-pjax href="{{ route('blog.category', ['category' => 'front-end']) }}">Front End</a></li>
                                            <li><a data-pjax href="{{ route('blog.category', ['category' => 'branding']) }}">Branding</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-5">
                                <h4>Live Chat <span id="chat-status" class="state online"></span></h4>
                                <div class="chat-block">
                                    <p>Talk to one of our developer specialists today for any assistance or information.</p>
                                    <a href="javascript:void(0);" onclick="toggleChat()" class="btn btn-primary btn-chat">START LIVE CHAT</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- container-->
        </footer><!-- /footer -->
</div><!-- /wrapper -->
    
@if(isProduction())
    <script src="{{ elixir('js/vendor.js') }}"></script>
    <script src="{{ elixir('js/cmv-js.js') }}"></script>
@else
    <script src="{{ asset('js/vendor.js') }}"></script>
    <script src="{{ asset('js/cmv-js.js') }}"></script>
@endif
@include('common/footer')

<div id="cmv-spinner"><span></span></div>
</body>
</html>
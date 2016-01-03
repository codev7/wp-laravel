@extends('layouts/marketing')

@section('meta')

@stop

@section('title')
<title>404 Error - Page Not Found</title>
@endsection

@section('content')
    <div class="container">
        <div class="twocolumns">
            <div class="row">
                <div class="col-lg-8 col-md-9">


	                <div class="post-preview">
	                    <header>

	                        <span class="label label-warning category-label">404</span>
	                        <h2>Page not found.</h2>
	                        <div class="meta">
	                            <p>Sorry, we could not find what you were looking for.</p>
	                        </div>
	                    </header>
	 




	                    <a href="{{ route('blog') }}" class="btn btn-primary-outline">Go back to the home page</a>
	                </div>
                    
                   
                </div>
                <div class="col-lg-3 col-lg-offset-1 col-md-3">
                    <div class="cell-item">
                        <h3>Learn</h3>
                        <ul class="list-unstyled category-list">
                            <li><a data-pjax href="{{ route('blog.category',['category' => 'ui-ux']) }}" class="ico-01">UI/UX design</a></li>
                            <li><a data-pjax href="{{ route('blog.category',['category' => 'front-end']) }}" class="ico-02">front end</a></li>
                            <li><a data-pjax href="{{ route('blog.category',['category' => 'branding']) }}" class="ico-03">branding</a></li>
                        </ul>
                    </div>
                    <div class="cell-item">
                        <h3>Our Writers</h3>
                        <ul class="media-list writers-list">
                            <li class="media">
                                <div class="media-left">
                                    <img src="{{ asset('images/connor-h.png') }}" alt="image description" class="media-object img-circle" >
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading text-primary">Connor Hood</h4>
                                    <h5 class="role">FOUNDER, CEO</h5>
                                </div>
                            </li>
                            <li class="media">
                                <div class="media-left">
                                    <img src="{{ asset('images/courtney-b.png') }}" alt="image description" class="media-object img-circle" >
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading text-primary">Courtney Booth</h4>
                                    <h5 class="role">COMMUNITY</h5>
                                </div>
                            </li>
                            <li class="media">
                                <div class="media-left">
                                    <img src="{{ asset('images/fred-j.png') }}" alt="image description" class="media-object img-circle" >
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading text-primary">Frederick Jones</h4>
                                    <h5 class="role">QA Specialist</h5>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="cell-item" style="display: none">
                        <h3>Subscribe</h3>
                        <p>Get the latest news and updates from the best client team around.</p>
                        <form class="subscribe-form">
                            <div class="form-group">
                                <label class="sr-only" for="lbl-01">Email address</label>
                                <input type="email" class="form-control" id="lbl-01" placeholder="Email Address">
                            </div>
                            <button type="submit" class="btn btn-default">sign up</button>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /twocolumns -->
    </div><!-- /container -->

    @include('partials/call-to-action')

    @include('partials/contact-info')
@endsection
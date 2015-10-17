@extends('layouts.master')


@section('meta')

<meta name="description" content="We are team of distributed developers who have expert knowledge of all things web. Whether you need PSD to HTML fast or a full-time developer or designer for a month, Code My Views Inc. is the best way to have your web development needs done professionally and efficiently." />

<link rel="canonical" href="{{  route('home') }}" />

@stop

@section('title')
<title>You do design.  We'll do the coding. - PSD to HTML by Code My Views</title>
@endsection

@section('content')
	<section class="visual">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-7">
					<div class="descr animated bounceInLeft">
						<h1>You do design.  We'll do the coding.</h1>
						<h2 class="text-primary"></h2>
						<p>Stop writing code, Code My Views does it for you.</p>
						<a href="{{ route('quote') }}" class="btn btn-default btn-project animated bounceIn" style="animation-delay: .8s;">Submit a Project! <span class="caret"></span></a>
					</div>
				</div>
				<div class="col-lg-4 col-md-5 hidden-xs">
					@include('partials/home-graphic-1')
				</div>
			</div>
		</div>
		<a href="#" class="btn-to-next"><span class="glyphicon glyphicon-menu-down"></span><span class="sr-only">next</span></a>
	</section><!-- /visual -->
	<section class="gallery-area">
		<div class="container">
			<header class="heading text-center">
				<h3 class="sub-ttl">Focus on the Design</h3>
				<h2 class="ttl text-primary">Coding is Easy</h2>
			</header>
			<div class="gallery">
				<figure class="slide">
					<img class="img-responsive" src="{{ asset('images/img-01.png') }}" alt="image description" >
					<figcaption>
						<h5 class="text-primary">Step 1</h5>
						<h4>Discovery & Quote</h4>
						<p>You give us as much detail as possible about what you need, either over the phone, in live chat, or via email. Our team of expert developers and designers will quickly review it and get back to you.</p>
					</figcaption>
				</figure>
				<figure class="slide">
					<img class="img-responsive" src="{{ asset('images/approve-quote.png') }}" alt="image description" >
					<figcaption>
						<h5 class="text-primary">Step 2</h5>
						<h4>Project Brief Approval</h4>
						<p>After we understand the full scope of your project, you will receive a development brief in your client portal, along with an invoice and guaranteed delivery date. To kick off your project, all you have to do is approve the developer brief!</p>
					</figcaption>
				</figure>
				<figure class="slide">
					<img class="img-responsive" src="{{ asset('images/production.png') }}" alt="image description" >
					<figcaption>
						<h5 class="text-primary">Step 3</h5>
						<h4>Coding</h4>
						<p>This is where the real work happens. Our team of expert developers and designers work according to the development brief we outlined in the previous step.</p>
					</figcaption>
				</figure>
				<figure class="slide">
					<img class="img-responsive" src="{{ asset('images/qa.png') }}" alt="image description" >
					<figcaption>
						<h5 class="text-primary">Step 4</h5>
						<h4>QA & Testing</h4>
						<p>Our developers hand off the the first version of the project to our Quality Assurance engineers who ensure that the code is pixel perfect, and that no details were missed from the development brief.</p>
					</figcaption>
				</figure>

				<figure class="slide">
					<img class="img-responsive" src="{{ asset('images/receive-file-illustration.png') }}" alt="image description" >
					<figcaption>
						<h5 class="text-primary">Step 5</h5>
						<h4>Client Review & Revisions</h4>
						<p>You will get a notification when your project is ready for you to review. Each project includes 1 free round of revisions, so if you forgot something, don't worry, just let us know in the revision round.</p>
					</figcaption>
				</figure>

				<figure class="slide">
					<img class="img-responsive" src="{{ asset('images/review.png') }}" alt="image description" >
					<figcaption>
						<h5 class="text-primary">Step 6</h5>
						<h4>Final Project Assets Delivered</h4>
						<p>All of your finalized project assets will be delivered through your client dashboard.</p>
					</figcaption>
				</figure>

				<ul class="gallery-nav">
					<li class="active"><a href="#">Quote</a></li>
					<li><a href="#">Dev Brief</a></li>
					<li><a href="#">Coding</a></li>
					<li><a href="#">QA</a></li>
					<li><a href="#">Revisions</a></li>
					<li><a href="#">Production</a></li>
				</ul>
			</div>
		</div>
		<div class="decor"></div>
		<a href="#" class="btn-to-next type2"><span class="glyphicon glyphicon-menu-down"></span><span class="sr-only">next</span></a>
	</section><!-- /gallery-area -->
	<section class="team-info">
		<div class="container">
			
			<?php /*@include('partials/team')*/ ?>

			<div class="services">
				<header class="heading text-center">
					<h3 class="sub-ttl">What We Offer</h3>
					<h2 class="ttl text-primary">Our services</h2>
				</header>
				<div class="row">
					<div class="col-md-5">
						<figure class="service-item">
							<img class="img-responsive" src="{{ asset('images/img-09.png') }}" alt="image description" >
							<figcaption>
								<h4 class="text-success text-center">PSD to HTML</h4>
								<p>We will take your <strong><a href="{{ route('service', ['slug' => 'psd-to-html']) }}" class="text-success">design files</a></strong> and give them back to you in whatever front end you want, also fully responsive, and with any interactions (animations/JS) you want built out.</p>
							</figcaption>
						</figure>
					</div>
					<div class="col-md-5 col-md-offset-2">
						<figure class="service-item service-item-2">
							<img class="img-responsive" src="{{ asset('images/img-10.png') }}" alt="image description" >
							<figcaption>
								<h4 class="text-primary text-center">Wordpress Development</h4>
								<p>We will take your static HTML (or the HTML that we build for you from our PSD to HTML service), and then build out a fully custom <strong><a href="{{ route('service', ['slug' => 'wordpress-development']) }}" class="text-primary">Wordpress theme</a></strong> that allows you to control all contents of the site - you don't need to touch code.  The WordPress theme is completely self contained, everything very easily editable through the wp-admin interface.</p>
							</figcaption>
						</figure>
					</div>
				</div>
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<figure class="service-item">
							<img class="img-responsive" src="{{ asset('images/img-11.png') }}" alt="image description" >
							<figcaption>
								<h4 class="text-primary text-center">Custom Web Applications</h4>
								<p>We will build your MVP in <strong>30 days or less</strong>.  Talk to us about our <a href="{{ route('service', ['slug' => 'web-application-development']) }}">custom web application</a> services.</p>
							</figcaption>
						</figure>
					</div>
				</div>
			</div><!-- /services -->
		</div>
		<a class="btn-to-next" href="#"><span class="glyphicon glyphicon-menu-down"></span></a>
	</section><!-- /team-info -->
	
	@include('partials/testimonials')
	@include('partials/call-to-action')
	@include('partials/contact-info')


@endsection
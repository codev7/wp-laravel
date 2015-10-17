@extends('layouts.master')


@section('meta')

<meta name="description" content="Stop writing code, Code My Views does it for you.  Learn the methods to our madness below." />

<link rel="canonical" href="{{  route('methods') }}" />

@stop


@section('title')
<title>Your Designs Brought to Life - PSD to HTML by Code My Views</title>
@endsection

@section('content')
	<header class="page-header page-heading">
		<div class="container">
			<h2 class="sub-ttl">Tried and true</h2>
			<h1 class="ttl text-success">METHODS</h1>
			<div class="row">
				<div class="col-md-7">
					<p>Stop writing code, Code My Views does it for you.<br />Learn the methods to our madness below. </p>
				</div>
			</div>
		</div>
	</header><!-- /page-heading -->
	<section class="methods-info">
		<div class="container">
			<ul class="method-list media-list">
				<li class="media">
					<div class="media-left">
						<img src="{{ asset('images/img-33.svg') }}" alt="image description" width="95" class="media-object" >
					</div>
					<div class="media-body">
						<h3 class="media-heading">Discovery &amp; Quote</h3>
						<p>You give us as much detail as possible about what you need, either over the phone, in live chat, or via email. Our team of expert developers and designers will quickly review it and get back to you.</p>
					</div>
				</li>
				<li class="media item-right">
					<div class="media-left">
						<img src="{{ asset('images/img-34.svg') }}" alt="image description" width="116" class="media-object" >
					</div>
					<div class="media-body">
						<h3 class="media-heading">Project Brief Approval</h3>
						<p>After we understand the full scope of your project, we package it into one of our many development briefs. Each one of our services has a specific development brief that outlines the scope of the project. You will receive a development brief in your client portal, along with an invoice and guaranteed delivery date. To kick off your project, all you have to do is approve the developer brief!</p>
					</div>
				</li>
				<li class="media">
					<div class="media-left">
						<img src="{{ asset('images/img-35.svg') }}" alt="image description" width="94" class="media-object" >
					</div>
					<div class="media-body">
						<h3 class="media-heading">Coding</h3>
						<p>This is where the real work happens. Our team of expert developers and designers work according to the development brief we outlined in the previous step.</p>
					</div>
				</li>
				<li class="media item-right">
					<div class="media-left">
						<img src="{{ asset('images/img-36.svg') }}" alt="image description" width="102" class="media-object" >
					</div>
					<div class="media-body">
						<h3 class="media-heading">QA &amp; Testing</h3>
						<p>Our developers hand off the the first version of the project to our Quality Assurance engineers who ensure that the code is pixel perfect, and that no details were missed from the development brief.</p>
					</div>
				</li>
				<li class="media">
					<div class="media-left">
						<img src="{{ asset('images/img-37.svg') }}" alt="image description" width="107" class="media-object" >
					</div>
					<div class="media-body">
						<h3 class="media-heading">Client Review &amp; Revisions</h3>
						<p>You will get a notification when your project is ready for you to review. Each project includes 1 free round of revisions, so if you forgot something, don't worry, just let us know in the revision round.</p>
					</div>
				</li>
				<li class="media item-center">
					<div class="media-left">
						<img src="{{ asset('images/img-38.svg') }}" alt="image description" width="81" class="media-object" >
					</div>
					<div class="media-body">
						<h3 class="media-heading">Final Project Assets Delivered </h3>
						<p>All of your finalized project assets will be delivered through your client dashboard.</p>
					</div>
				</li>
			</ul>
		</div>
	</section><!-- /methods-info -->
	@include('partials/call-to-action')

	@include('partials/contact-info')
@endsection
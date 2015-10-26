@extends('layouts/marketing')
@section('content')
	<header class="page-header page-heading">
		<div class="container">
			<h1 class="ttl text-success">About</h1>
			<div class="row">
				<div class="col-md-7">
					<p>We are team of distributed developers who have expert knowledge of all things web. Whether you need PSD to HTML fast or a full-time developer or designer for a month, Code My Views Inc. is the best way to have your web development needs done professionally and efficiently.  Our Austin, Texas based team keeps your projects running smoothly and delivered on time with expert level code and quality that will integrate smoothly into your existing workflow.</p>
				</div>
			</div>
		</div>
	</header><!-- /page-heading -->
	<section class="methods-info">
		<div class="container">
			<ul class="method-list media-list">
				<li class="media item-center">
					<div class="media-left">
						<img src="{{ asset('images/img-33.svg') }}" alt="image description" width="95" class="media-object" >
					</div>
					<div class="media-body">
						<h3 class="media-heading">Always Available</h3>
						<p>Our support staff is available 8-6PM (Austin, TX time), and with project managers also available in San Francisco, CA, you can know we will be available whenever you are working. </p>

						<p>Read about the methodology we use on all of our projects that allows us to deliver every project on time, pixel perfect, and bug free.</p>

						<br />

						<p><a href="{{ route('methods') }}" class="btn btn-lg btn-success">Read the Methodology</a></p>

					</div>
				</li>
			</ul>
		</div>
	</section><!-- /methods-info -->

	@include('partials/contact-info')
@endsection
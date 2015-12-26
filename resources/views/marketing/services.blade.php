@extends('layouts/marketing')

@section('body')
<body class="services-page">
@endsection

@section('title')
<title>{{ get_field('title_tag') }}</title>
@stop

@section('meta')

<meta name="description" content="{{ get_field('meta_description') }}" />

<link rel="canonical" href="{{ get_permalink() }}" />

@stop

@section('content')
    {!! setBodyClassIfPjax(['services-page']) !!}
	<section class="visual3 repeatable">
		<div class="container">
			<img src="{{ asset('images/dark-blue.jpg') }}" alt="{{ get_the_title() }} Tiled Image" class="bg-img tiled" >
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<header class="text-center">
						<h1>{!! get_field('h1_title') !!}</h1>
						<h2>{!! get_field('h2_title') !!}</h2>
					</header>
					{!! get_field('intro_paragraph') !!}
				</div>
			</div>
		</div>
	</section><!-- /visual3 -->
	<section class="service-overview">
		<div class="container">
			<div class="tab-content">	
				<?php $count = 0; ?>

                @foreach(get_field('tabs') as $tab)
                    <?php $count++; ?>
                    <div id="tab-{{ $count }}" class="tab-pane <?php echo $count == 1 ? 'active' : null ?>">
                		<div class="row">
                			<div class="col-lg-6 wysiwyg" id="content-area-services">

                				<h3>{{ $tab['tab_text'] }}</h3>
                				{!! $tab['content'] !!}
                                
                			</div><!--col-->
                			<div class="col-lg-5 col-lg-offset-1">
							<div class="images-block">
								<div class="img img-1">
									<img src="{{ asset('images/img-43.png') }}" alt="image description" >
								</div>
								<div class="img img-2">
									<img src="{{ asset('images/img-44.jpg') }}" alt="image description" >
								</div>
								<div class="img img-3">
									<img src="{{ asset('images/img-45.jpg') }}" alt="image description" >
								</div>
							</div>
						</div>
                		</div><!--row-->
                    </div>
                 @endforeach
			</div>

			<ul class="nav nav-tabs nav-justified tabset">
				<?php $count = 0; ?>
                @foreach(get_field('tabs') as $tab)
                    <?php $count++; ?>
                    <li <?php echo $count == 1 ? 'class="active"' : null ?>><a data-toggle="tab" href="#tab-{{ $count }}"><span><i class="fa fa-2x {{ $tab['icon'] }}"></i><br />{{ $tab['tab_text'] }}</span></a></li>
                @endforeach
			</ul>
		</div>
	</section><!-- /service-overview -->

	@include('partials/call-to-action',[ 'header_1' => get_field('bottom_call_to_action_header'), 'header_2' => get_field('bottom_call_to_action_secondary_text') ]);

    @include('partials/contact-info')

@endsection
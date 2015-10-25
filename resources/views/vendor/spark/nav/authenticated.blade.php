<nav class="navbar navbar-inverse navbar-fixed-top app-navbar">
	<div class="container">
		<div class="navbar-header">

			<!-- Collapsed Hamburger -->
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<!-- Branding Image -->
			<a class="navbar-brand" href="{{ route('home') }}">
				<img src="{{ asset('images/cmv-logo-application.png') }}" alt="brand">
			</a>
		</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<!-- Left Side Of Navbar -->
			<ul class="nav navbar-nav hidden-xs">

				@if(isRouteNameSpace('home') || isRouteNameSpace('settings'))
					<li class="{{ set_active_from_route_name('app.home') }}"><a href="{{ route('app.home') }}">Dashboard</a></li>
				@endif

				@if(hasRole('sales-rep') && (isRouteNameSpace('home') || isRouteNameSpace('settings')))
					<li><a href="{{ route('prospector.dashboard') }}">Prospector Dashboard</a></li>
				@endif

				@if(hasRole('mastermind') && (isRouteNameSpace('home') || isRouteNameSpace('settings')))
					<li><a href="{{ route('mastermind.dashboard') }}">Mastermind</a></li>
				@endif

				@if(isRouteNameSpace('project') && isset($project))
				<li><a href="{{ route('app.home') }}"><small><i class="fa fa-arrow-left"></i> back</small></a></li>
				<li class="disabled">
                    <a href="#"><strong>{{ $project->name }}</strong></a>
                </li>

                <li class="{{ set_active_from_route_name('project.single') }}">
                    <a href="{{ route('project.single', ['slug' => $project->slug]) }}">Project Dashboard</a>
                </li>

                <li class="{{ set_active_from_route_name('prospector.companies') }}">
                    <a href="#">Files</a>
                </li>

                <li class="{{ set_active_from_route_name('prospector.contacts') }}">
                    <a href="#">Invoices</a>
                </li>

                <li class="{{ set_active_from_route_name('prospector.contacts') }}">
                    <a href="#">To Do's <span class="badge">15</span></a>
                </li>
				@endif

				@if(isRouteNameSpace('concierge-site') && isset($site))
				<li><a href="{{ route('app.home') }}"><small><i class="fa fa-arrow-left"></i> back</small></a></li>
				<li class="disabled">
                    <a href="#"><strong>{{ $site->name }}</strong></a>
                </li>

                <li class="{{ set_active_from_route_name('concierge.single') }}">
                    <a href="{{ route('concierge.single', ['slug' => $site->slug]) }}">Concierge Dashboard</a>
                </li>

                <li class="{{ set_active_from_route_name('prospector.contacts') }}">
                    <a href="#">To Do's <span class="badge">15</span></a>
                </li>

                <li class="{{ set_active_from_route_name('prospector.companies') }}">
                    <a href="#">Files</a>
                </li>

                
				@endif

				@if(isRouteNameSpace('mastermind'))
					<li><a href="{{ route('app.home') }}"><small><i class="fa fa-arrow-left"></i> back</small></a></li>

					<li class="disabled">
	                    <a href="#"><strong>Mastermind</strong></a>
	                </li>

	                <li class="{{ set_active_from_route_name('mastermind.dashboard') }}">
	                    <a href="{{ route('mastermind.dashboard') }}">Dashboard</a>
	                </li>
	                
                @endif

				@if(isRouteNameSpace('prospector'))
					<li><a href="{{ route('app.home') }}"><small><i class="fa fa-arrow-left"></i> back</small></a></li>

					<li class="disabled">
	                    <a href="#"><strong>Prospector</strong></a>
	                </li>

	                <li class="{{ set_active_from_route_name('prospector.dashboard') }}">
	                    <a href="{{ route('prospector.dashboard') }}">Dashboard</a>
	                </li>

	                <li class="{{ set_active_from_route_name('prospector.companies') }}">
	                    <a href="{{ route('prospector.companies') }}">All Companies</a>
	                </li>

	                <li class="{{ set_active_from_route_name('prospector.contacts') }}">
	                    <a href="{{ route('prospector.contacts') }}">All Contacts</a>
	                </li>
                @endif

				@if ( ! Spark::isDisplayingSettingsScreen())
					

					<!-- Additional User Defined Navbar Items -->
					<!-- Best To Leave Left Side Nav Empty On Settings To Avoid Vue.js Conflicts -->


				@endif
			</ul>

			<!-- Right Side Of Navbar -->
			<ul class="nav navbar-nav navbar-right m-r-0 hidden-xs">
				<!-- Settings Dropdown -->
				@if (Spark::isDisplayingSettingsScreen())
					{{-- This Dropdown Is For Spark Settings Sreens - Vue Based --}}
					{{-- Vue Based Dropdown Provides Better UX Experience On Settings Screens --}}
					@include('spark::nav.spark.dropdown')
				@else
					{{-- This Dropdown Is For Other User Constructed App Screens - Blade Based --}}
					@include('spark::nav.app.dropdown')
				@endif
			</ul>
		</div>
	</div>
</nav>

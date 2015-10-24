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

				@if(isRouteNameSpace('home'))
					<li class="{{ set_active_from_route_name('app.home') }}"><a href="{{ route('app.home') }}">Home</a></li>
				@endif

				@if(hasRole('sales-rep') && isRouteNameSpace('home'))
					<li><a href="{{ route('prospector.dashboard') }}">Prospector Dashboard</a></li>
				@endif

				@if(isRouteNameSpace('prospector'))
					<li><a href="{{ route('home') }}"><small><i class="fa fa-arrow-left"></i> back to home</small></a></li>

					<li class="disabled">
	                    <a href="#"><strong>Prospector:</strong></a>
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

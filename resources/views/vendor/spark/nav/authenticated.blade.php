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
				<li class="{{ set_active('dashboard') }}">
                    <a href="/prospects/dashboard">Sales Dashboard</a>
                </li>
                <li  class="{{ set_active('companies') }}">
                    <a href="{{ route('companies',['filter' => 'all']) }}">Companies</a>
                </li>
                <li  class="{{ set_active('contacts') }}">
                    <a href="/contacts/">Contacts</a>
                </li>
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

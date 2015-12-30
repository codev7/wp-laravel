<nav class="navbar navbar-inverse navbar-fixed-top app-navbar">
	<div class="container">
		<div class="navbar-header">

			<!-- Collapsed Hamburger -->
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-main">
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

		<div class="collapse navbar-collapse" id="navbar-collapse-main">
			<!-- Left Side Of Navbar -->
			<ul class="nav navbar-nav hidden-xs">
                <li class="{{ set_active_from_route_name('project.new') }}"><a href="{{ route('project.new') }}">Get a Project Quote</a></li>
				<li><a href="{{ route('wp-concierge') }}">Get WordPress Concierge</a></li>
			</ul>

			<!-- Right Side Of Navbar -->
			<ul class="nav navbar-nav navbar-right m-r-0">
				<!-- Login / Registration Links -->
				<li><a href="/login">Login</a></li>
			</ul>



		</div>
	</div>
</nav>

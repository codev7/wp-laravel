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
                <li><a href="{{ route('quote') }}">Get a Project Quote</a></li>
				<li><a href="/register">WordPress Concierge</a></li>
			</ul>

			<!-- Right Side Of Navbar -->
			<ul class="nav navbar-nav navbar-right m-r-0 hidden-xs">
				<!-- Login / Registration Links -->
				<li><a href="/login">Login</a></li>
				<li><a href="/register">Register</a></li>
			</ul>

			<ul class="nav navbar-nav hidden-sm hidden-md hidden-lg">
          <li><a href="index.html">Home</a></li>
          <li><a href="profile/index.html">Profile</a></li>
          <li><a href="notifications/index.html">Notifications</a></li>
          <li><a data-toggle="modal" href="#msgModal">Messages</a></li>
          <li><a href="docs/index.html">Docs</a></li>
          <li><a href="#" data-action="growl">Growl</a></li>
          <li><a href="login/index.html">Logout</a></li>
        </ul>

        <ul class="nav navbar-nav hidden">
          <li><a href="#" data-action="growl">Growl</a></li>
          <li><a href="login/index.html">Logout</a></li>
        </ul>
		</div>
	</div>
</nav>

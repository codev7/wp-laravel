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
			<ul class="nav navbar-nav">

                <?php $show_global_links = isRouteNameSpace('/home') || isRouteNameSpace('/settings') || isRoute('project.new'); ?>

				@if($show_global_links)
					<li class="{{ set_active_from_route_name('app.home') }}"><a href="{{ route('app.home') }}">Dashboard</a></li>
				@endif

				@if(hasRole('sales-rep') && $show_global_links)
					<li><a href="{{ route('prospector.dashboard') }}">Prospector Dashboard</a></li>
				@endif

				@if(hasRole('mastermind') && $show_global_links)
					<li><a href="{{ route('mastermind.dashboard') }}">Mastermind</a></li>
				@endif

				@if(isRouteNameSpace('project') && isset($project))
				<li><a href="{{ getHomeLink() }}"><small><i class="fa fa-arrow-left"></i> back</small></a></li>
				<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"><strong>{{ $project->name }} <span class="caret"></span></strong></a>

                    <ul class="dropdown-menu" role="menu">

                        <li class="dropdown-header">{{ Auth::user()->currentTeam->name }} Projects</li>

                        @foreach (Auth::user()->projects as $p)
                        <li>
                            <a href="/project/{{ $p->slug }}">
                                <i class="fa fa-btn {{ $p->slug === $project->slug ? 'fa-fw fa-check text-success' : 'fa fa-btn fa-fw'  }}"></i>{{ $p->name }}
                            </a>
                        </li>
                        @endforeach

                        @if (Access::check(new CMV\Models\PM\Project, 'create'))
                        <li class="divider"></li>

                        <li>
                            <a href="{{ route('project.new') }}">
                                <i class="fa fa-btn fa-fw fa-plus"></i>Create New Project
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>

                @if (! isDev())
                <li class="{{ set_active_from_route_name('project.single') }}">
                    <a data-pjax href="{{ route('project.single', ['slug' => $project->slug]) }}">Dashboard</a>
                </li>
                @endif

                <li class="{{ set_active_from_route_name('project.briefs') }}">
                    <a data-pjax href="{{ route('project.briefs', ['slug' => $project->slug]) }}">Briefs</a>
                </li>

                <li class="{{ set_active_from_route_name('project.files') }}">
                    <a data-pjax href="{{ route('project.files', ['slug' => $project->slug]) }}">Files</a>
                </li>

                @if (! isDev())
                <li class="{{ set_active_from_route_name('project.invoices') }}">
                    <a data-pjax href="{{ route('project.invoices', ['slug' => $project->slug]) }}">Invoices</a>
                </li>
                @endif

                <li class="{{ set_active_from_route_name('project.todos') }}">
                    <a data-pjax href="{{ route('project.todos', ['slug' => $project->slug]) }}">To Do's</a>
                </li>
                @endif

				@if(isRouteNameSpace('concierge-site') && isset($project))
				<li><a href="{{ getHomeLink() }}"><small><i class="fa fa-arrow-left"></i> back</small></a></li>
				<li class="disabled">
                    <a href="#"><strong>{{ $project->name }}</strong></a>
                </li>

                @if (! isDev())
                <li class="{{ set_active_from_route_name('concierge.single') }}">
                    <a href="{{ route('concierge.single', ['slug' => $project->slug]) }}">Concierge Dashboard</a>
                </li>
                @endif

                <li class="{{ set_active_from_route_name('concierge.todos') }}">
                    <a href="{{ route('concierge.todos', ['slug' => $project->slug]) }}">To Do's
                        {{--<span class="badge">15</span>--}}
                    </a>
                </li>

                <li class="{{ set_active_from_route_name('concierge.files') }}">
                    <a href="{{ route('concierge.files', ['slug' => $project->slug]) }}">Files
                        {{--<span class="badge">15</span>--}}
                    </a>
                </li>
				@endif

				@if(isRouteNameSpace('mastermind') && hasRole('mastermind'))
					<li><a href="{{ getHomeLink() }}"><small><i class="fa fa-arrow-left"></i> back</small></a></li>

					<li class="disabled">
	                    <a href="#"><strong>Mastermind</strong></a>
	                </li>

	                <li class="{{ set_active_from_route_name('mastermind.dashboard') }}">
	                    <a href="{{ route('mastermind.dashboard') }}">Dashboard</a>
	                </li>
	                
                    <li>
                        <a href="{{ route('mastermind.logs') }}">Error Logs</a>
                    </li>
                @endif

				@if(isRouteNameSpace('prospector'))
					<li><a href="{{ getHomeLink() }}"><small><i class="fa fa-arrow-left"></i> back</small></a></li>

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
			<ul class="nav navbar-nav navbar-right m-r-0">
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

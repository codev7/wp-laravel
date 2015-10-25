@extends('spark::layouts.spark-no-container')

@section('content')
<div class="profile-header text-center home-background-tiled">
<div class="container">
    <div class="container-inner">
        <img class="img-circle media-object" src="{{ Auth::user()->getGravatarImage() }}">
        <h3 class="profile-header-user">{{ Auth::user()->name }}</h3>
        <p class="profile-header-bio">
        {{ Auth::user()->currentTeam()->name }}
        </p>
    </div>
</div>

<nav class="profile-header-nav">
    <ul class="nav nav-tabs">
        <li @if(!Input::has('tab')) class="active" @endif>
            <a href="/home">Projects</a>
        </li>
        <li @if(Input::get('tab') == 'concierge') class="active" @endif>
            <a href="/home?tab=concierge">Concierge Sites</a>
        </li>
        <li>
            <a href="/settings/teams/{{ Auth::user()->currentTeam()->id }}">Team Settings</a>
        </li>
    </ul>
</nav>
</div>

<div class="p-y-md">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">


                @if(!Input::has('tab'))
                    @if(Auth::user()->currentTeam()->projects()->count() > 0)
                    <div class="pull-right">
                        <a class="btn btn-primary-outline" href="{{ route('project.new') }}">
                            <i class="fa fa-btn fa-plus with-text"></i> Create Project
                        </a>
                    </div>
                    <div class="panel panel-flush">
                        <div class="panel-body">

                            <table class="table table-relaxed table-middle">

                                <thead>

                                    <tr>

                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Last Updated</th>
                                        <th>&nbsp;</th>
                                    </tr>

                                </thead>


                                <tbody>

                                    @foreach(Auth::user()->currentTeam()->projects as $project)
                                    <tr>

                                        <td>{{ $project->name }}</td>
                                        <td>{{ $project->type->name }}</td>
                                        <td>{{ $project->updated_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('project.single', ['slug' => $project->slug]) }}" class="btn btn-default-outline" data-toggle="tooltip" title="View Project">
                                                <i class="fa fa-arrow-right"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        
                        </div>
                    </div>

                    @else
                    <div class="text-center">
                        <h3 class="m-b-lg">{{ Auth::user()->currentTeam()->name }} has no projects.</h3>

                        <a href="{{ route('project.new') }}" class="btn btn-primary-outline btn-lg"><i class="fa fa-plus"></i> Create a Project</a>
                    </div>
                    @endif
                @elseif(Input::get('tab') == 'concierge')

                    @if(Auth::user()->currentTeam()->conciergeSites()->count() > 0)
                    <div class="pull-right">
                        <a class="btn btn-primary-outline" data-toggle="modal" href="#add-concierge-site">
                            <i class="fa fa-btn fa-plus with-text"></i> Add Concierge Site
                        </a>
                    </div>
                    <div class="panel panel-flush">
                        <div class="panel-body">

                            <table class="table table-relaxed table-middle">

                                <thead>

                                    <tr>

                                        <th>Name</th>
                                        <th>Last Updated</th>
                                        <th>Open Tasks</th>
                                        <th>&nbsp;</th>
                                    </tr>

                                </thead>


                                <tbody>

                                    @foreach(Auth::user()->currentTeam()->conciergeSites as $site)
                                    <tr>

                                        <td>{{ $site->name }}<br /><small class="text-muted">{{ $site->url }}</small></td>
                                        <td>{{ $site->updated_at->diffForHumans() }}</td>
                                        <td>{{ $site->toDos()->count() }}</td>
                                        <td>
                                            <a href="{{ route('concierge.single', ['slug' => $site->slug]) }}" class="btn btn-default-outline" data-toggle="tooltip" title="View Project">
                                                <i class="fa fa-arrow-right"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        
                        </div>
                    </div>

                    @else
                    <div class="text-center">
                        <h3 class="">{{ Auth::user()->currentTeam()->name }} has no concierge sites.</h3>

                        @if(Auth::user()->currentTeam()->owner->subscribed())


                        <a href="#add-concierge-site" data-toggle="modal" class="btn btn-lg btn-primary-outline"><i class="fa fa-plus"></i> Add Concierge Site</a>

                        @else
                        <p class="m-b-lg">Before you can add a concierge site, the team owner needs <a href="/settings?tab=subscription">choose a plan</a>.</p>

                        <div class="well well-small m-x-lg">
                            <h4 class="p-x">Our WordPress VIP concierge service gives you the ability to stop worrying about updates and small changes to your WordPress site.</h4>

                            <p class="m-t-md"><a href="{{ route('wp-concierge') }}" class="btn btn-lg btn-primary-outline"><i class="fa fa-wordpress"></i> Learn More About WP VIP Concierge</a></p>

                            
                        </div><!--well-->
                        @endif

                        
                    </div>
                    @endif

                @endif
            </div><!--col-->
        </div><!--row-->
    </div>
</div><!--home-background-tiled-->

@include('modals/add-concierge-site')

@endsection
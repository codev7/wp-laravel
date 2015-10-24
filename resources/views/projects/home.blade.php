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
        <li class="active">
            <a href="#">Projects</a>
        </li>
        <li>
            <a href="#">Concierge Sites</a>
        </li>
        <li>
            <a href="#">Team Settings</a>
        </li>
    </ul>
</nav>
</div>

<div class="p-y-md">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">


                @if(Auth::user()->currentTeam()->projects()->count() > 0)
                <div class="pull-right">
                    <button class="btn btn-primary-outline" ng-click="showAddProjectModal()" ng-if="user.subscribed">
                        <i class="fa fa-btn fa-plus with-text"></i> Add Project
                    </button>
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
                                <tr>

                                    <td>Project Name</td>
                                    <td>PSD to WordPress</td>
                                    <td>5 minutes ago</td>
                                    <td>
                                        <a href="#" class="btn btn-default-outline" data-toggle="tooltip" title="View Project">
                                            <i class="fa fa-arrow-right"></i>
                                        </a>
                                    </td>
                                </tr>
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
            </div><!--col-->
        </div><!--row-->
    </div>
</div><!--home-background-tiled-->

@endsection
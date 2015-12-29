@extends('spark::layouts.spark-no-container')

@section('content')
    <div class="profile-header text-center home-background-tiled">
        <div class="container">
            <div class="container-inner">
                <img class="img-circle media-object" src="{{ Auth::user()->gravatar }}">
                <h3 class="profile-header-user">{{ Auth::user()->name }}</h3>
            </div>
        </div>
    </div>

    <div class="p-y-md">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @if(Auth::user()->devProjects()->count() > 0)
                        @if(Access::check((new CMV\Models\PM\Project), 'create'))
                            <div class="pull-right">
                                <a class="btn btn-primary-outline" href="{{ route('project.new') }}">
                                    <i class="fa fa-btn fa-plus with-text"></i> Create Project
                                </a>
                            </div>
                        @endif

                        <div class="panel panel-flush">
                            <div class="panel-body">

                                <table class="table table-relaxed table-middle">

                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Open Tasks</th>
                                        <th>Last Updated</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    </thead>


                                    <tbody>

                                    @foreach(Auth::user()->devProjects() as $project)
                                        @if ($project->project_type != 'project')
                                            @continue
                                        @endif
                                        <tr>
                                            <td>{{ $project->name }}</td>
                                            <td>{{ $project->project_type }} @if($project->type) / {{$project->type->name}} @endif</td>
                                            <td>{{ $project->toDos()->where('status', '!=', 'accepted')->count() }}</td>
                                            <td>{{ $project->updated_at->diffForHumans() }}</td>
                                            <td>
                                                @if ($project->project_type == 'project')
                                                <a href="{{ route('project.todos', ['slug' => $project->slug]) }}" class="btn btn-default-outline" data-toggle="tooltip" title="View Project">
                                                    <i class="fa fa-arrow-right"></i>
                                                </a>
                                                @else
                                                <a href="{{ route('concierge.todos', ['slug' => $project->slug]) }}" class="btn btn-default-outline" data-toggle="tooltip" title="View Project">
                                                    <i class="fa fa-arrow-right"></i>
                                                </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    @else
                        <div class="text-center">
                            <h3 class="m-b-lg">You have no assigned projects yet.</h3>
                        </div>
                    @endif
                </div><!--col-->
            </div><!--row-->
        </div>
    </div><!--home-background-tiled-->
@endsection
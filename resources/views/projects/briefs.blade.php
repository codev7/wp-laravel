@extends('spark::layouts.spark')



<!-- Main Content -->
@section('content')
<div class="row">

    @include('projects/partials/sidebar')

    <div class="col-md-9" data-controller="project/briefs">
    
        <ul class="list-group media-list media-list-stream">
            <li class="media list-group-item p-a">
                <div class="media-body">
                    <table class="table table-condensed table-middle m-b-0">
                        <thead>
                            <tr>
                                <th>Brief Type</th>
                                <th class="text-center">Date Created</th>
                                <th class="text-center">Created By</th>
                                <th class="text-center">Approved On</th>
                                <th class="text-center">Approved By</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr>
                                <td><a data-pjax href="{{ route('project.brief', ['slug' => $project->slug, 'brief_id' => 123]) }}">Front End Brief</a> <span data-placement="right" class="tooltipper" title="A front end brief covers all details about the HTML/CSS/JavaScript of this project."><i class="fa fa-question-circle"></i></span></td>
                                <td class="text-center">5 days ago</td>
                                <td class="text-center">Dave Gamache</td>
                                <td class="text-center">5 minutes ago</td>
                                <td class="text-center">John Doe</td>
                                <td>
                                    <a data-pjax href="{{ route('project.brief', ['slug' => $project->slug, 'brief_id' => 123]) }}" class="btn btn-primary-outline btn-xs">View Brief</a>
                                </td>
                            </tr>

                            <tr>
                                <td><a data-pjax href="{{ route('project.brief', ['slug' => $project->slug, 'brief_id' => 456]) }}">WordPress Brief</a> <span data-placement="right" class="tooltipper" title="A WordPress brief covers all details about the WordPress CMS implementation."><i class="fa fa-question-circle"></i></span></td>
                                <td class="text-center">5 days ago</td>
                                <td class="text-center">Dave Gamache</td>
                                <td class="text-center">5 minutes ago</td>
                                <td class="text-center"><em class="text-muted">Not yet approved</em></td>
                                <td>
                                    <a data-pjax href="{{ route('project.brief', ['slug' => $project->slug, 'brief_id' => 456]) }}" class="btn btn-primary-outline btn-xs">View Brief</a>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </li>         
        </ul>
    </div>
@endsection
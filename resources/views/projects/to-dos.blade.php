@extends('spark::layouts.spark')

@section('content')
<div class="row">

    

    <div class="col-md-9 col-md-push-3" data-controller="project/todos" v-cloak state="{{ json_encode(['reference_id' => $project->id, 'reference_type' => 'project']) }}">

        <h3 class="m-a-0 p-a-0 pull-left">@{{ inProgress.length }} To Do @{{ inProgress.length == 1 ? 'Item' : 'Items' }}</h3>
        @if (!isDev())
        <a href="#" class="btn btn-primary btn-sm pull-right m-b"
           v-on:click.prevent="openCreateModal">
            <i class="fa fa-plus"></i> Add New To Do
        </a>
        @endif

        <div class="clearfix"></div>

        <ul class="list-group media-list media-list-stream">
            <li class="media list-group-item p-a media-group-header">
                <div class="media-body">
                    <div class="row">
                        <div class="col-sm-1 text-center">
                            Type
                        </div><!--col-->

                        <div class="col-sm-8">
                            To-do Details
                        </div><!--col-->

                        <div class="col-sm-3 text-right">
                            Action
                        </div>
                    </div><!--row-->
                </div>
            </li>
            <li v-if="accepted.length" class="media list-group-item p-a-0 toggle-accepted text-center">

                <div>
                    <a href="#" v-on:click.prevent="toggleAcceptedStories()" class="text-success">
                        <small v-if="!showAcceptedTodos">Show @{{ accepted.length }} Accepted To Dos <i class="fa fa-angle-down"></i></small>
                        <small v-if="showAcceptedTodos">Hide @{{ accepted.length }} Accepted To Dos <i class="fa fa-angle-up"></i></small>
                    </a>
                </div>
            </li>

            <li v-if="accepted.length && showAcceptedTodos" class="media list-group-item p-a to-do-list-item accepted-task-item"
                v-bind:class="{'opened': opened.indexOf(todo.id) != -1}"
                {{--v-on:click="toggleDescription(todo.id)"--}}
                v-for="todo in accepted">
                <div class="media-body">
                    <div class="row">
                        <div class="col-sm-1 text-center  toggle-description">
                            <a data-pjax href="/{{ $project->pType() }}/{{ $project->slug }}/to-dos/@{{ todo.id }}"><i class="fa fa-2x m-t text-success fa-check"></i></a>
                        </div><!--col-->

                        <div class="col-sm-8  toggle-description">
                            <a data-pjax href="/{{ $project->pType() }}/{{ $project->slug }}/to-dos/@{{ todo.id }}">
                                <p class=" text-primary" style="margin-bottom: 4px;"><span class="label label-default">@{{ meta[todo.category] }}</span></p>
                            <p class="m-a-0">@{{ todo.title }}</p>

                            <p class="text-muted m-a-0"><small>Submitted @{{ todo.created_at | ago }} ago by @{{ todo.created_by.name }}</small></p></a>
                        </div><!--col-->

                        <div class="col-sm-3 text-right">
                            <div class="btn-group m-t">
                                <a href="javascript:;" class="btn btn-sm btn-success" disabled>Accepted on @{{ todo.accepted_at | date2 }}</a>
                            </div>
                        </div>
                    </div><!--row-->
                </div>
            </li>

            <li class="media list-group-item to-do-list-item p-a"
                v-bind:class="{'opened': opened.indexOf(todo.id) != -1}"
                v-for="todo in inProgress">

                <div class="media-body">
                    <div class="row">
                        <div class="col-sm-1 text-center  toggle-description">
                            <a data-pjax href="/{{ $project->pType() }}/{{ $project->slug }}/to-dos/@{{ todo.id }}"><i class="fa fa-2x m-t"
                               v-bind:class="{'text-danger': todo.type == 'bug', 'fa-exclamation-circle': todo.type == 'bug', 'text-warning': todo.type == 'feature', 'fa-star': todo.type == 'feature' }">
                            </i></a>
                        </div><!--col-->

                        <div class="col-sm-8  toggle-description">
                            <a data-pjax href="/{{ $project->pType() }}/{{ $project->slug }}/to-dos/@{{ todo.id }}"><p class=" text-primary" style="margin-bottom: 4px;"><span class="label label-default">@{{ meta[todo.category] }}</span></p>
                            <p class="m-a-0">@{{ todo.title }}</p>

                            <p class="text-muted m-a-0"><small>Submitted @{{ todo.created_at | ago }} ago by @{{ todo.created_by.name }}</small></p></a>
                        </div><!--col-->

                        <div class="col-sm-3 text-right">
                            <div class="btn-group m-t">
                                @include('projects.partials.todo-status-btn', ['btnClass' => 'btn-sm'])
                            </div>
                        </div>
                    </div><!--row-->
                </div>
               
            </li>

            <li class="media list-group-item to-do-list-item p-a text-center"
                v-if="inProgress.length == 0">
                This project has no open to do items. <br /><br />
                @if (! isDev())
                <a href="#" class="btn btn-primary-outline btn-sm "
                   v-on:click.prevent="openCreateModal">
                    <i class="fa fa-plus"></i> Create First To Do
                </a>
                @endif
            </li>
        </ul>

        @if (! isDev())
            @include('modals/create-to-do')
        @endif
    </div>

    @include('projects/partials/sidebar', ['pull' => 'col-md-pull-9'])
    
@endsection
@extends('spark::layouts.spark')

@section('content')
<div class="row">

    @include('projects/partials/sidebar')

    <div class="col-md-9" data-controller="project/todos" v-cloak state="{{ json_encode(['reference_id' => $project->id, 'reference_type' => 'project']) }}">

        <h3 class="m-a-0 p-a-0 pull-left">4 To-Do Items</h3>
        <a href="#" class="btn btn-primary btn-sm pull-right m-b"
           v-on:click.prevent="openCreateModal">
            <i class="fa fa-plus"></i> Add New To-Do
        </a>

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
                        <small v-if="!showAcceptedTodos">Show @{{ accepted.length }} Accepted Stories <i class="fa fa-angle-down"></i></small>
                        <small v-if="showAcceptedTodos">Hide @{{ accepted.length }} Accepted Stories <i class="fa fa-angle-up"></i></small>
                    </a>
                </div>
            </li>

            <li v-if="accepted.length && showAcceptedTodos" class="media list-group-item p-a to-do-list-item accepted-task-item"
                v-bind:class="{'opened': opened.indexOf(todo.id) != -1}"
                v-on:click="toggleDescription(todo.id)"
                v-for="todo in accepted">
                <div class="media-body">
                    <div class="row">
                        <div class="col-sm-1 text-center  toggle-description">
                            <i class="fa fa-2x m-t text-success fa-check"></i>
                        </div><!--col-->

                        <div class="col-sm-8  toggle-description">
                            <p class=" text-primary" style="margin-bottom: 4px;"><span class="label label-default">@{{ meta[todo.type] }}</span></p>
                            <p class="m-a-0">@{{ todo.title }}</p>

                            <p class="text-muted m-a-0"><small>Submitted @{{ todo.created_at | ago }} ago by @{{ todo.created_by.name }}</small></p>
                        </div><!--col-->

                        <div class="col-sm-3 text-right">
                            <div class="btn-group m-t">
                                <a href="#" class="btn btn-sm btn-success" disabled>Accepted on @{{ todo.accepted_at | date2 }}</a>
                            </div>
                        </div>
                    </div><!--row-->
                    <div class="row" v-if="opened.indexOf(todo.id) != -1">
                        <div class="col-sm-11 col-sm-offset-1"> 
                            <h6 class="m-t">To-Do Description</h6>
                            <div class="trix-markup">
                                @{{{ todo.content }}}
                            </div>
                        </div>
                    </div>
                </div>
            </li>

            <li class="media list-group-item to-do-list-item p-a"
                v-bind:class="{'opened': opened.indexOf(todo.id) != -1}"
                v-on:click="toggleDescription(todo.id)"
                v-for="todo in inProgress">
                <div class="media-body">
                    <div class="row">
                        <div class="col-sm-1 text-center  toggle-description">
                            <i class="fa fa-2x m-t fa-exclamation-circle text-danger"></i>
                        </div><!--col-->

                        <div class="col-sm-8  toggle-description">
                            <p class=" text-primary" style="margin-bottom: 4px;"><span class="label label-default">@{{ meta[todo.type] }}</span></p>
                            <p class="m-a-0">@{{ todo.title }}</p>

                            <p class="text-muted m-a-0"><small>Submitted @{{ todo.created_at | ago }} ago by @{{ todo.created_by.name }}</small></p>
                        </div><!--col-->

                        <div class="col-sm-3 text-right">
                            <div class="btn-group m-t">
                                <div v-if="isDeveloper">
                                    <button v-if="todo.status == '{{ \CMV\Models\PM\ToDo::STATUS_NEW }}'"
                                            v-on:click.stop="setStatus(todo, '{{ \CMV\Models\PM\ToDo::STATUS_IN_WORK }}')"
                                            class="btn btn-sm btn-default-outline">Start Task</button>

                                    <button v-if="todo.status == '{{ \CMV\Models\PM\ToDo::STATUS_IN_WORK }}'"
                                            v-on:click.stop="setStatus(todo, '{{ \CMV\Models\PM\ToDo::STATUS_DELIVERED }}')"
                                            class="btn btn-sm btn-primary">Deliver Task</button>

                                    <button v-if="todo.status == '{{ \CMV\Models\PM\ToDo::STATUS_DELIVERED }}'"
                                            v-on:click.stop="setStatus(todo, '{{ \CMV\Models\PM\ToDo::STATUS_IN_WORK }}')"
                                            class="btn btn-sm btn-warning">unDeliver</button>

                                    <button v-if="todo.status == '{{ \CMV\Models\PM\ToDo::STATUS_REJECTED }}'"
                                            v-on:click.stop="setStatus(todo, '{{ \CMV\Models\PM\ToDo::STATUS_IN_WORK }}')"
                                            class="btn btn-sm btn-warning">Restart</button>
                                </div>

                                <div v-if="!isDeveloper">
                                    <button v-if="todo.status == '{{ \CMV\Models\PM\ToDo::STATUS_NEW }}'"
                                            class="btn btn-sm btn-default-outline" disabled>Unstarted</button>

                                    <button v-if="todo.status == '{{ \CMV\Models\PM\ToDo::STATUS_IN_WORK }}'"
                                            class="btn btn-sm btn-default-outline" disabled>In Work</button>

                                    <button v-if="todo.status == '{{ \CMV\Models\PM\ToDo::STATUS_DELIVERED }}'"
                                            v-on:click.stop="setStatus(todo, '{{ \CMV\Models\PM\ToDo::STATUS_ACCEPTED }}')"
                                            class="btn btn-sm btn-success">Accept</button>

                                    <button v-if="todo.status == '{{ \CMV\Models\PM\ToDo::STATUS_DELIVERED }}'"
                                            v-on:click.stop="setStatus(todo, '{{ \CMV\Models\PM\ToDo::STATUS_REJECTED }}')"
                                            class="btn btn-sm btn-danger">Reject</button>

                                    <button v-if="todo.status == '{{ \CMV\Models\PM\ToDo::STATUS_REJECTED }}'"
                                            class="btn btn-sm btn-default-outline" disabled>Rejected</button>
                                </div>
                            </div>
                        </div>
                    </div><!--row-->

                    <div class="row" v-if="opened.indexOf(todo.id) != -1">
                        <div class="col-sm-11 col-sm-offset-1"> 
                            <h6 class="m-t">To-Do Description</h6>
                            <div class="trix-markup">
                                @{{{ todo.content }}}
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            
        </ul>

        @include('modals/create-to-do')
    </div>

@endsection
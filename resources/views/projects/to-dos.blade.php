@extends('spark::layouts.spark')

@section('content')
<div class="row">

    @include('projects/partials/sidebar')

    <div class="col-md-9" data-controller="project/todos">

        <h3 class="m-a-0 p-a-0 pull-left">4 To-Do Items</h3>
        <a href="#create-to-do" data-toggle="modal" class="btn btn-primary btn-sm pull-right m-b"><i class="fa fa-plus"></i> Add New To-Do</a>

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
            <li class="media list-group-item p-a-0 toggle-accepted text-center">

                <div v-if="showAcceptedTodos">
                    <a href="#" v-on:click="toggleAcceptedStories($event)" class="text-success"><small>Hide 2 Accepted Stories <i class="fa fa-angle-up"></i></small></a>
                </div>

                <div v-if="!showAcceptedTodos">
                    <a href="#" v-on:click="toggleAcceptedStories($event)" class="text-success"><small>Show 2 Accepted Stories <i class="fa fa-angle-down"></i></small></a>
                </div>
            </li>
            <li class="media list-group-item p-a to-do-list-item accepted-task-item">
                <div class="media-body">
                    <div class="row">
                        <div class="col-sm-1 text-center  toggle-description">
                            <i class="fa fa-2x m-t text-success fa-check"></i>
                        </div><!--col-->

                        <div class="col-sm-8  toggle-description">
                            <p class=" text-primary" style="margin-bottom: 4px;"><span class="label label-default">Front End</span></p>
                            <p class="m-a-0">This is another new feature task.</p>

                            <p class="text-muted m-a-0"><small>Submitted 5 minutes ago by John Doe</small></p>
                        </div><!--col-->

                        <div class="col-sm-3 text-right">
                            <div class="btn-group m-t">
                                <a href="#" class="btn btn-sm btn-success" disabled>Accepted on 5/12/2015</a>
                            </div>
                        </div>
                    </div><!--row-->
                    <div class="row description-row">
                        <div class="col-sm-11 col-sm-offset-1"> 
                            <h6 class="m-t">To-Do Description</h6>
                            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
                        </div>
                    </div>
                </div>
            </li>
            <li class="media list-group-item p-a to-do-list-item accepted-task-item">
                <div class="media-body">
                    <div class="row">
                        <div class="col-sm-1 text-center toggle-description">
                            <i class="fa fa-2x m-t text-success fa-check"></i>
                        </div><!--col-->

                        <div class="col-sm-8 toggle-description">
                            <p class=" text-primary" style="margin-bottom: 4px;"><span class="label label-default">Front End</span></p>
                            <p class="m-a-0">This is another new feature task.</p>

                            <p class="text-muted m-a-0"><small>Submitted 5 minutes ago by John Doe</small></p>
                        </div><!--col-->

                        <div class="col-sm-3 text-right">
                            <div class="btn-group m-t">
                                <a href="#" class="btn btn-sm btn-success" disabled>Accepted on 5/12/2015</a>
                            </div>
                        </div>
                    </div><!--row-->

                    <div class="row description-row">
                        <div class="col-sm-11 col-sm-offset-1"> 
                            <h6 class="m-t">To-Do Description</h6>
                            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
                        </div>
                    </div>
                </div>
            </li>
            <li class="media list-group-item to-do-list-item p-a">
                <div class="media-body">
                    <div class="row">
                        <div class="col-sm-1 text-center  toggle-description">
                            <i class="fa fa-2x m-t fa-exclamation-circle text-danger"></i>
                        </div><!--col-->

                        <div class="col-sm-8  toggle-description">
                            <p class=" text-primary" style="margin-bottom: 4px;"><span class="label label-default">WordPress</span></p>
                            <p class="m-a-0">CASE STUDIES: potential realized content block should have arrow on right side of title (see mockup)</p>

                            <p class="text-muted m-a-0"><small>Submitted 5 minutes ago by John Doe</small></p>
                        </div><!--col-->

                        <div class="col-sm-3 text-right">
                            <div class="btn-group m-t">
                                <a href="#" class="btn btn-sm btn-default-outline">Start Task</a>
                            </div>
                        </div>
                    </div><!--row-->
                    <div class="row description-row">
                        <div class="col-sm-11 col-sm-offset-1"> 
                            <h6 class="m-t">To-Do Description</h6>
                            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
                        </div>
                    </div>
                </div>
            </li>

            <li class="media list-group-item to-do-list-item p-a">
                <div class="media-body">
                    <div class="row">
                        <div class="col-sm-1 text-center  toggle-description">
                            <i class="fa fa-2x m-t fa-exclamation-circle text-danger"></i>
                        </div><!--col-->

                        <div class="col-sm-8  toggle-description">
                            <p class=" text-primary" style="margin-bottom: 4px;"><span class="label label-default">WordPress</span></p>
                            <p class="m-a-0">CASE STUDIES: potential realized content block should have arrow on right side of title (see mockup)</p>

                            <p class="text-muted m-a-0"><small>Submitted 5 minutes ago by John Doe</small></p>
                        </div><!--col-->

                        <div class="col-sm-3 text-right">
                            <div class="btn-group m-t">
                                <a href="#" class="btn btn-sm btn-primary">Deliver Task</a>
                            </div>
                        </div>
                    </div><!--row-->
                    <div class="row description-row">
                        <div class="col-sm-11 col-sm-offset-1"> 
                            <h6 class="m-t">To-Do Description</h6>
                            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
                        </div>
                    </div>
                </div>
            </li>

            <li class="media list-group-item to-do-list-item p-a">
                <div class="media-body">
                    <div class="row">
                        <div class="col-sm-1 text-center  toggle-description">
                            <i class="fa fa-2x m-t fa-star text-warning"></i>
                        </div><!--col-->

                        <div class="col-sm-8  toggle-description">
                            <p class=" text-primary" style="margin-bottom: 4px;"><span class="label label-default">Front End</span></p>
                            <p class="m-a-0">This is a new feature task.</p>

                            <p class="text-muted m-a-0"><small>Submitted 5 minutes ago by John Doe</small></p>
                        </div><!--col-->

                        <div class="col-sm-3 text-right">
                            <div class="btn-group m-t">
                                <a href="#" class="btn btn-sm btn-primary">Deliver Task</a>
                            </div>
                        </div>
                    </div><!--row-->
                    <div class="row description-row">
                        <div class="col-sm-11 col-sm-offset-1"> 
                            <h6 class="m-t">To-Do Description</h6>
                            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
                        </div>
                    </div>
                </div>
            </li>

            <li class="media list-group-item to-do-list-item p-a">
                <div class="media-body">
                    <div class="row">
                        <div class="col-sm-1 text-center  toggle-description">
                            <i class="fa fa-2x m-t fa-star text-warning"></i>
                        </div><!--col-->

                        <div class="col-sm-8  toggle-description">
                            <p class=" text-primary" style="margin-bottom: 4px;"><span class="label label-default">Front End</span></p>
                            <p class="m-a-0">This is another new feature task.</p>

                            <p class="text-muted m-a-0"><small>Submitted 5 minutes ago by John Doe</small></p>
                        </div><!--col-->

                        <div class="col-sm-3 text-right">
                            <div class="btn-group m-t">
                                <a href="#" class="btn btn-sm btn-success">Accept</a>
                                <a href="#" class="btn btn-sm btn-danger">Reject</a>
                            </div>
                        </div>
                    </div><!--row-->
                    <div class="row description-row">
                        <div class="col-sm-11 col-sm-offset-1"> 
                            <h6 class="m-t">To-Do Description</h6>
                            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
                        </div>
                    </div>
                </div>
            </li>

            
        </ul>
    </div>

    @include('modals/create-to-do')
@endsection
@extends('spark::layouts.spark')



<!-- Main Content -->
@section('content')
<div class="row">

    @include('projects/partials/sidebar')

    <div class="col-md-9" data-controller="project/todos">
        <ul class="list-group media-list media-list-stream">

            <li class="media list-group-item p-a">
       
                <div class="media-body">
                    
                    <p>To-do interface coming soon.  This will be a basic interface that:</p>

                    <ul class="m-b">
                        <li>gives the customer the ability to add/remove to-do items</li>
                        <li>all to-do items are synced up with bitbucket so that dev team can handle them</li>
                        <li>should utilize bitbucket webhooks to keep in sync real time with bitbucket status</li>
                    </ul>

                    <p>Front end coming soon</p>



                </div>
            </li>


         
        </ul>
    </div>
@endsection
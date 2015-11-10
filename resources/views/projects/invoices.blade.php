@extends('spark::layouts.spark')



<!-- Main Content -->
@section('content')
<div class="row">

    @include('projects/partials/sidebar')

    <div class="col-md-9" data-controller="project/invoices">
        <ul class="list-group media-list media-list-stream">

            <li class="media list-group-item p-a">
       
                <div class="media-body">
                    
                    table of invoices. front end to come soon.

                                      

                </div>
            </li>


         
        </ul>
    </div>
@endsection
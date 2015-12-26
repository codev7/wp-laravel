@extends('spark::layouts.spark')



<!-- Main Content -->
@section('content')
<div class="row">


    <div class="col-md-12" data-controller="project/brief-view" v-cloak state="{{ json_encode(['brief' => $brief->toArray()]) }}">
        
        <div class="panel panel-default panel-profile brief-panel">

            <div class="panel-body">
                
                <div><a data-pjax href="{{ route('project.briefs', ['slug' => $project->slug]) }}" class="text-muted"><i class="fa fa-arrow-left"></i> Back to all briefs</a></div>

                <div class="pull-right w-sm">
                    <button class="m-t-md btn btn-lg btn-block btn-success"
                            v-bind:disabled="brief.approved_by_customer_id">
                        <i class="fa fa-thumbs-o-up"></i> Approve Brief
                    </button>

                    <p class="m-t text-center">
                        <a href="#" class="btn btn-xs btn-danger-outline"
                           v-on:click.prevent="openRequestChangesModal()">Request Changes</a>
                    </p>

                    <p class="m-t text-center" v-if="brief.approved_by_customer_id">
                        <small>Brief was approved on <br/> @{{ brief.approved_by_customer_at | date }}</small>
                    </p>
                </div>

                @include('projects/partials/brief-view')

            </div>

        </div><!--panel-->
        
        
    </div>

    @include('modals/request-brief-changes')
</div>
@endsection
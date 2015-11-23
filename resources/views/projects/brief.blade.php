@extends('spark::layouts.spark')



<!-- Main Content -->
@section('content')
<div class="row">

    @include('projects/partials/sidebar')

    <div class="col-md-9" data-controller="project/briefs">
        
        <div class="panel panel-default panel-profile brief-panel">

            <div class="panel-body">
                
                <div><a data-pjax href="{{ route('project.briefs', ['slug' => $project->slug]) }}" class="text-muted"><i class="fa fa-arrow-left"></i> Back to all briefs</a></div>


                <div class="pull-right w-sm">
                    <a href="#" class="m-t-md btn btn-lg btn-block btn-success"><i class="fa fa-thumbs-o-up"></i> Approve Brief</a>

                    <p class="m-t text-center"><a href="#" class="btn btn-xs btn-danger-outline">Request Changes</a></p>
                </div>

                @if($brief_id == 'sample-front-end-brief')
                    
                @include('projects/partials/front-end-brief')

                @endif

                @if($brief_id == 'sample-wordpress-brief')
                    
                @include('projects/partials/wordpress-brief')

                @endif
            </div>

        </div><!--panel-->
        
        
    </div>
@endsection
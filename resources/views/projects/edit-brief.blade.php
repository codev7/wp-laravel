@extends('spark::layouts.spark')



<!-- Main Content -->
@section('content')
<div class="row">


    <div class="col-md-12" data-controller="project/brief-edit" state="{{ json_encode(['project_id' => $project->id, 'brief_id' => isset($brief) ? $brief->id : false]) }}" v-cloak>
        
        <div class="panel panel-default panel-profile brief-panel">

            <div class="panel-body">
                
                <div><a data-pjax href="{{ route('project.briefs', ['slug' => $project->slug]) }}" class="text-muted"><i class="fa fa-arrow-left"></i> Back to all briefs</a></div>

                <br />

                <div class="row">
                    
                    <div class="col-sm-12">

                        

                        <div class="clearfix"></div>

                        @if(isset($brief))
                            @include('projects.partials.brief-edit')
                        @else

                            @include('projects.partials.brief-tab-global', ['project' => $project])

                            <button class="btn btn-block"
                                    v-on:click.prevent="createBrief"
                                    v-submit="creatingBrief">Create Brief</button>
                        @endif
                    </div>

                    
                </div><!--row-->
         

            </div>

        </div><!--panel-->
        
        
    </div>
@endsection
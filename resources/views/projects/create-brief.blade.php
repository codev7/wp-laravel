@extends('spark::layouts.spark')



<!-- Main Content -->
@section('content')
<div class="row">

    @include('projects/partials/sidebar')

    <div class="col-md-9" data-controller="project/brief" state="{{ json_encode(['project_id' => $project->id]) }}" v-cloak>
        
        <div class="panel panel-default panel-profile brief-panel">

            <div class="panel-body">
                
                <div><a data-pjax href="{{ route('project.briefs', ['slug' => $project->slug]) }}" class="text-muted"><i class="fa fa-arrow-left"></i> Back to all briefs</a></div>

                <br />

                <div class="row">
                    <div class="col-sm-9">

                        <div class="form-group">
                            <label>Brief Type</label>

                            <select class="custom-select form-control"
                                    v-model="brief.brief_type"
                                    v-on:change="handleBriefTypeChange">
                                <option v-for="option in templates.blanks.select.brief_types" v-bind:value="option.value">
                                    @{{ option.text }}
                                </option>
                            </select>
                        </div>
@{{ brief | json }}
                        <div class="form-group" v-if="brief.brief_type == 'frontend'">
                            <label>Layout Type</label>
                            <p class="text-danger">
                            <select class="custom-select form-control"
                                    v-model="brief.layout_type">
                                <option v-for="option in templates.blanks.select.layout_types" v-bind:value="option.value">
                                    @{{ option.text }}
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Related to Other briefs?</label>

                            <select multiple class="form-control">
                                <option>WordPress Brief - 2 days ago</option>
                                <option>Front End Brief - 30 minutes ago</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Quick Overview</label>
                            <textarea class="form-control" rows="2" cols="4" placeholder="Project Summary - Less than 300 characters"
                                      maxlength="300"
                                      v-model="brief.summary">
                            </textarea>

                            <p class="m-a-0 pull-right text-muted">@{{ 300 - brief.summary.length }} characters remaining</p>
                        </div>

                        <div class="clearfix"></div>

                        @include('projects.partials.brief-create')

                    </div>

                    <div class="col-sm-3">
                        <div class="well well-small">

                            <a href="#" class="m-a-0 btn btn-lg btn-block btn-success"><i class="fa fa-paper-plane"></i> Send Brief</a>

                            <p class="m-t m-b-0 text-center"><a href="#" class="btn btn-sm btn-primary-outline"><i class="fa fa-save"></i> Save as Draft</a></p>
                        </div>
                    </div>
                </div><!--row-->
         

            </div>

        </div><!--panel-->
        
        
    </div>
@endsection
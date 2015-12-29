@extends('spark::layouts.spark')

@section('content')
    <div class="row">

        @include('projects/partials/sidebar')

        <div class="col-md-9" data-controller="project/todo" v-cloak state="{{ json_encode(['todo' => $todo->toArray() ]) }}">
            
            

            <div class="panel panel-default panel-profile brief-panel">
                

                <div class="panel-body">

                <div><a data-pjax href="{{ route('project.todos', ['slug' => $project->slug]) }}" class="text-muted"><i class="fa fa-arrow-left"></i> Back to all to dos</a></div>

                    <i class="fa m-t-lg fa-3x pull-right {{ $todo->type == 'bug' ? 'fa-exclamation-circle text-danger' : 'fa-star text-warning' }}"></i> 

                    <h1>{{ $todo->title }}<br />
                        <small class="text-muted">Created {{ $todo->created_at->diffForHumans() }} by {{ $todo->createdBy->name }}</small>
                    </h1>

                    <hr />
                    
                    <div class="row">
                        <div class="col-sm-8">
                            <ul class="list-group media-list media-list-stream">


                                <li class="media list-group-item no-bdforder p-a">
                                    <a class="media-left" href="#">
                                        <img class="media-object img-circle" src="{{ asset('images/avatar-dhg.png') }}">
                                    </a>
                                    <div class="media-body">
                                        <div class="media-heading">
                                            <small class="pull-right text-muted">4 min</small>
                                            <h5>Dave Gamache</h5>
                                        </div>

                                        {!! $todo->content !!}


                                        <br />

                                        <ul class="media-list m-b">
                                            <li class="media">
                                                <a class="media-left" href="#">
                                                  <img
                                                    class="media-object img-circle"
                                                    src="{{ asset('images/avatar-fat.jpg') }}">
                                                </a>
                                                <div class="media-body">
                                                  <strong>Jacon Thornton: </strong>
                                                  Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Donec ullamcorper nulla non metus auctor fringilla. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Sed posuere consectetur est at lobortis.
                                                </div>
                                            </li>

                                            <li class="media">
                                                <a class="media-left" href="#">
                                                  <img
                                                    class="media-object img-circle"
                                                    src="{{ asset('images/avatar-fat.jpg') }}">
                                                </a>
                                                <div class="media-body">
                                                  <strong>Jacon Thornton: </strong>
                                                  Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Donec ullamcorper nulla non metus auctor fringilla. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Sed posuere consectetur est at lobortis.
                                                </div>
                                            </li>

                                            <li class="media">
                                                <a class="media-left" href="#">
                                                  <img
                                                    class="media-object img-circle"
                                                    src="{{ asset('images/avatar-fat.jpg') }}">
                                                </a>
                                                <div class="media-body">
                                                  <strong>Jacon Thornton: </strong>
                                                  Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Donec ullamcorper nulla non metus auctor fringilla. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Sed posuere consectetur est at lobortis.
                                                </div>
                                            </li>
                                        
                                        </ul>
                                    </div>
                                    <textarea name="reply"  class="reply-to-a-thread m-b" placeholder="Type here to start replying to James Jiggins">
                                    </textarea>
                                    <button type="button" style="absolute; bottom: 0; display: none; right: 0;" href="#" class="pos-a btn btn-xs pull-right btn-primary-outline btn-reply-to-thread"
                                        class=""
                                    <i class="fa fa-reply"></i> Submit Reply
                                    </button>
                                </li>
                            </ul>
                        </div><!--col-->

                        <div class="col-sm-4">

                            <div class="hr-divider">
                                <h3 class="hr-divider-content hr-divider-heading">To Do Files</h3>
                            </div>

                            <table class="table table-condensed table-middle m-b-0">
                                <thead>
                                    <tr>
                                        <th>File Name</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>File.png</td>
                                        <td class="text-right"><a href="#" target="_blank" class="btn btn-primary-outline btn-xs">Download</a></td>
                                    </tr>
                                </tbody>

                  

                            </table>

                            <hr />

                            <a href="#" class="btn btn-success btn-xs pull-right"><i class="fa fa-plus"></i> Upload Files</a>

                            <div class="clearfix"></div>
                            <hr />

                            <a href="#" class="btn btn-lg btn-block btn-primary">Deliver Task</a>
                        </div>
                    </div><!--row-->
                </div>
            </div>
        </div>

@endsection
@extends('spark::layouts.spark')



<!-- Main Content -->
@section('content')
<div class="row">

    @include('projects/partials/sidebar')

    <div class="col-md-6" v-cloak data-controller="project/dashboard" state='{{json_encode(['reference_type' => 'project', 'reference_id' => $project->id])}}'>
        <div class="list-group media-list media-list-stream">

            <div class="media list-group-item p-a">
                <div class="form-group">
                    <textarea class="form-control hidden" rows="4" placeholder="Message"
                              v-model="message"
                              v-trix
                    ></textarea>
                </div>

                <button class="btn btn-block btn-default-outline"
                        v-on:click="postMessage($event)"
                        v-submit="posting">Submit New Message</button>
            </div>
        </div>

        <div v-for="thread in data" class="m-t pos-r" v-show="thread.messages.length">
            <div class="media list-group-item p-a" >
                <a href="#" class="delete-thread text-danger"
                   {{--v-if="thread.canDelete"--}}
                   v-on:click.prevent="deleteThreadConfirm(thread)">
                    <i class="fa fa-trash"></i>
                </a>

                <span class="media-left">
                    <img class="media-object panel-profile-img m-t-0" v-bind:src="thread.messages[0].user.gravatar">
                </span>

                <div class="media-body">
                    <div class="media-heading">
                        <small class="pull-right text-muted"
                               v-text="thread.messages[0].created_at | ago" ></small>
                        <h5>@{{thread.messages[0].user.name}}</h5>
                    </div>

                    @{{{thread.messages[0].content}}}

                    <ul class="media-list m-b">
                        <li class="media" v-for="(index, message) in thread.messages" v-show="index > 0">

                            <span class="media-left">
                                <img class="media-object img-circle"
                                     v-bind:src="message.user.gravatar">
                            </span>
                            <div class="media-body">
                                <strong>@{{ message.user.name }}: </strong>
                                @{{{ message.content }}}
                            </div>
                        </li>
                    </ul>

                </div>

                
            </div>
            <textarea class="reply-to-a-thread m-b" placeholder="Type here to start replying to @{{thread.messages[0].user.name}}"></textarea>

            <button type="button" style="absolute; bottom: 0; display: none; right: 0; background: white;" href="#" class="pos-a btn btn-xs pull-right btn-primary-outline btn-reply-to-thread"><i class="fa fa-reply"></i> Submit Reply</button>
        </div>
    </div>

    <div class="col-md-3">
        <div class="alert alert-dark alert-dismissible hidden-xs" role="alert">
            Hang tight! We are preparing a project estimate for you.
        </div>

        <div class="panel panel-default m-b-md hidden-xs">
            <div class="panel-body">
                <button type="button" style="top: -10px; right: -10px" class="close pos-r" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="m-t-0">Concierge Service</h5>
                <a href="{{ route('wp-concierge') }}"><img class="img-thumbnail" src="{{ asset('images/img-10.png') }}"></a>
                <p class="m-t"><strong>Looking for ongoing support?</strong> Check out our VIP Concierge service.</p>
                <a href="{{ route('wp-concierge') }}" class="btn btn-primary-outline btn-sm">Learn More</a>
            </div>
        </div>

        @include('projects/partials/team')
    </div>
@endsection
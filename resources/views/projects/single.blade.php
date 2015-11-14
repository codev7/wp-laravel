@extends('spark::layouts.spark')



<!-- Main Content -->
@section('content')
<div class="row">

    @include('projects/partials/sidebar')

    <div class="col-md-6" data-controller="project/dashboard" state='{{json_encode(['reference_type' => 'project', 'reference_id' => $project->id])}}'>
        <ul class="list-group media-list media-list-stream">

            <li class="media list-group-item p-a">
                <div class="form-group">
                    <textarea class="form-control hidden" rows="4" placeholder="Message"
                              v-model="message"
                              v-trix
                    ></textarea>
                </div>

                <button class="btn btn-block btn-default-outline"
                        v-on:click="postMessage($event)">Submit Message</button>
            </li>

            <div v-if="data.length">
                <li class="media list-group-item p-a" v-for="thread in data" v-show="thread.messages.length">

                    <a class="media-left" href="#">
                        <img class="media-object img-circle" v-bind:src="thread.messages[0].user.gravatar">
                    </a>

                    <div class="media-body">
                        <div class="media-heading">
                            <small class="pull-right text-muted">4 min</small>
                            <h5>@{{thread.messages[0].user.name}}</h5>
                        </div>

                        <p>
                            @{{{thread.messages[0].content}}}
                        </p>

                        {{--
                        <div class="media-body-inline-grid" data-grid="images">
                            <div style="display: none">
                                <img data-action="zoom" data-width="1050" data-height="700" src="{{ asset('images/unsplash_1.jpg') }}">
                            </div>

                            <div style="display: none">
                                <img data-action="zoom" data-width="640" data-height="640" src="{{ asset('images/instagram_1.jpg') }}">
                            </div>

                            <div style="display: none">
                                <img data-action="zoom" data-width="640" data-height="640" src="{{ asset('images/instagram_13.jpg') }}">
                            </div>

                            <div style="display: none">
                                <img data-action="zoom" data-width="1048" data-height="700" src="{{ asset('images/unsplash_2.jpg') }}">
                            </div>
                        </div>
                        --}}

                        <ul class="media-list m-b">
                            <li class="media" v-for="(index, message) in thread.messages" v-show="index > 0">
                                <a class="media-left" href="#">
                                    <img
                                    class="media-object img-circle"
                                    v-bind:src="message.user.gravatar">
                                </a>
                                <div class="media-body">
                                    <strong>@{{ message.user.name }}: </strong>
                                    @{{{ message.content }}}
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
            </div>
        </ul>
    </div>

    <div class="col-md-3">
        <div class="alert alert-dark alert-dismissible hidden-xs" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            Hang tight! We are preparing a project estimate for you.
        </div>

        <div class="panel panel-default m-b-md hidden-xs">
            <div class="panel-body">
                <h5 class="m-t-0">Concierge Service</h5>
                <img class="img-thumbnail" data-width="640" data-height="640" data-action="zoom" src="{{ asset('images/img-10.png') }}">
                <p class="m-t"><strong>Looking for ongoing support?</strong> Check out our VIP Concierge service.</p>
                <a href="{{ route('wp-concierge') }}" class="btn btn-primary-outline btn-sm">Learn More</a>
            </div>
        </div>

        @include('projects/partials/team')
    </div>
@endsection
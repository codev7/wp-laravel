@extends('spark::layouts.spark')



<!-- Main Content -->
@section('content')
<div class="row">

    @include('projects/partials/sidebar')

    <div class="col-md-9" v-cloak data-controller="project/briefs" state="{{ json_encode(['project_id' => $project->id]) }}">

        <ul class="list-group media-list media-list-stream">
            <li class="media list-group-item p-a">
                <div class="media-body">
                    @if (hasRole('admin'))
                    <a data-pjax class="btn btn-sm btn-primary pull-right" href="{{ route('project.create_brief', ['slug' => $project->slug]) }}"><i class="fa fa-plus"></i> Create Brief</a>
                    @endif

                    <table class="table table-condensed table-middle m-b-0">
                        <thead>
                            <tr>
                                <th>Brief Type</th>
                                <th class="text-center">Date Created</th>
                                <th class="text-center">Created By</th>
                                <th class="text-center">Approved On</th>
                                <th class="text-center">Approved By</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="brief in briefs">
                                <td>
                                    <a data-pjax href="briefs/@{{ brief.id }}">@{{ meta[brief.text.brief_type].name }}</a>
                                    <span data-placement="right" data-toggle="tooltip" class="tooltipper" v-tooltip title="@{{ meta[brief.text.brief_type].description }}">
                                        <i class="fa fa-question-circle"></i>
                                    </span>
                                </td>
                                <td class="text-center">@{{ brief.created_at | ago }}</td>
                                <td class="text-center">@{{ brief.created_by_user.name }}</td>
                                <td class="text-center">
                                    <span v-if="brief.approved_by_customer_id">@{{ brief.approved_by_customer_at | ago }}</span>
                                    <span v-if="!brief.approved_by_customer_id">Not Yet Approved</span>
                                </td>
                                <td class="text-center">
                                    <span v-if="brief.approved_by_customer_id">@{{ brief.approved_by_user.name }}</span>
                                    <span v-if="!brief.approved_by_customer_id"></span>
                                </td>
                                <td>
                                    <a data-pjax href="/project/{{ $project->slug }}/briefs/@{{ brief.id }}" class="btn btn-primary-outline btn-xs">View Brief</a>
                                </td>
                            </tr>
                        </tbody>

                        <tbody v-if="!briefs.length && briefsFetched">
                            <tr>
                                <td colspan="6" class="text-center">No briefs are created yet</td>
                            </tr>
                        </tbody>

                        <tbody v-if="!briefsFetched">
                            <tr>
                                <td class="text-center" colspan="6">
                                    <i class="fa fa-refresh fa-spin"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </li>         
        </ul>
    </div>
@endsection
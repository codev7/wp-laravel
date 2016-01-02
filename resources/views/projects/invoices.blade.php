@extends('spark::layouts.spark')



<!-- Main Content -->
@section('content')
<div class="row">

    @include('projects/partials/sidebar')

    <div class="col-md-9" data-controller="project/invoices" state="{{ json_encode(['project' => $project->toArray()]) }}" v-cloak>
       <ul class="list-group media-list media-list-stream">
            <li class="media list-group-item p-a">
                <div class="media-body">
                    @if (hasRole('admin') || hasRole('mastermind'))
                    <a data-pjax class="btn btn-sm btn-primary pull-right" href="{{ route('project.create_invoice', ['slug' => $project->slug]) }}"><i class="fa fa-plus"></i> Create Invoice</a>
                    @endif

                    <table class="table table-condensed table-middle m-b-0">
                        <thead>
                            <tr>
                                <th>Related to Brief</th>
                                <th class="text-center">Date Created</th>
                                <th class="text-center">Created By</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Status</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="invoice in invoices">
                                <td>
                                    <span v-if="!invoice.brief.id">No associated brief</span>
                                    <a v-if="invoice.brief.id && invoice.brief.approved_by_admin_id" href="/project/{{ $project->slug }}/briefs/@{{ invoice.brief.id }}" target="_blank">
                                        @{{ invoice.brief.text.brief_type }}
                                    </a>
                                </td>
                                <td class="text-center">@{{ invoice.created_at | ago }}</td>
                                <td class="text-center">@{{ invoice.created_by.name }}</td>
                                <td class="text-center">$@{{ invoice.grandTotal }}.00</td>
                                <td class="text-center">@{{ invoice.status }}</td>
                                <td>
                                    <a href="/project/{{ $project->slug }}/invoices/@{{ invoice.id }}" class="btn btn-primary-outline btn-xs">View Invoice</a>
                                    @if (isAdmin())
                                    <a href="/project/{{ $project->slug }}/invoices/@{{ invoice.id }}/edit" style="margin-left: 3px" class="btn btn-warning-outline btn-xs">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                        </tbody>

                        <tbody v-if="!invoices.length && invoicesFetched">
                            <tr>
                                <td colspan="6" class="text-center">No invoices are created yet</td>
                            </tr>
                        </tbody>

                        <tbody v-if="!invoicesFetched">
                            <tr>
                                <td class="text-center" colspan="6">
                                    <i class="fa fa-spinner fa-spin"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </li>         
        </ul>
    </div>
@endsection
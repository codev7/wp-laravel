@extends('spark::layouts.spark')



<!-- Main Content -->
@section('content')
<div class="row">


    <div class="col-md-9 col-md-push-3" data-controller="project/invoices" state="{{ json_encode(['project' => $project->toArray()]) }}" v-cloak>
       <ul class="list-group media-list media-list-stream">
            <li class="media list-group-item p-a">
                <div class="media-body">
                    @if (hasRole('admin') || hasRole('mastermind'))
                    <a data-pjax class="btn btn-sm btn-primary pull-right" href="{{ route('project.create_invoice', ['slug' => $project->slug]) }}"><i class="fa fa-plus"></i> Create Invoice</a>
                    @endif

                    <table class="table table-condensed table-middle m-b-0">
                        <thead>
                            <tr>
                                <th class="text-left">Date Created</th>
                                <th class="text-left">Created By</th>
                                <th class="text-left">Amount</th>
                                <th class="text-left">Status</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="invoice in invoices">
                                <td class="text-left">@{{ invoice.created_at | mdYtoMDoY }}</td>
                                <td class="text-left">@{{ invoice.created_by.name }}</td>
                                <td class="text-left">$@{{ invoice.grandTotal }}.00</td>
                                <td class="text-left">@{{ invoice.status }}</td>
                                <td class="text-right">

                                    <div class="btn-group btn-group-xs">
                                    <a data-pjax href="/project/{{ $project->slug }}/invoices/@{{ invoice.id }}" class="btn btn-primary btn-xs">View</a>
                                    @if (isAdmin())
                                    <a data-pjax href="/project/{{ $project->slug }}/invoices/@{{ invoice.id }}/edit" class="btn btn-warning btn-xs">Edit</i>
                                    </a>

                                    @endif
                                    </div>
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

    @include('projects/partials/sidebar', ['pull' => 'col-md-pull-9'])
@endsection
@extends('spark::layouts.spark')



<!-- Main Content -->
@section('content')
<div class="row">

    @include('projects/partials/sidebar')

    <div class="col-md-9" data-controller="project/invoices">
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
                            <tr>
                                <td><a href="#">Name of brief invoice is related to</a></td>
                                <td class="text-center">5 minutes ago</td>
                                <td class="text-center">Connor Hood</td>
                                <td class="text-center">$400.00</td>
                                <td class="text-center">Sent</td>
                                <td><a href="#" class="btn btn-primary-outline btn-xs">View Invoice <a href="#" style="margin-left: 3px" class="btn btn-warning-outline btn-xs"><i class="fa fa-edit"></i></a></a>
                            </tr>
                        </tbody>

                        <tbody v-if="!briefs.length && briefsFetched" style="display: none">
                            <tr>
                                <td colspan="6" class="text-center">No briefs are created yet</td>
                            </tr>
                        </tbody>

                        <tbody v-if="!invoicesFetched" style="display: none">
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
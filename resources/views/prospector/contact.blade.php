@extends('spark::layouts.spark')

@section('content')
<div class="hr-divider m-t-md m-b">
    <h3 class="hr-divider-content hr-divider-heading">Contact Info</h3>
</div>
<ol class="breadcrumb">
    <li><a href="{{ route('prospector.dashboard') }}">Dashboard</a></li>
    <li><a href="{{ route('prospector.companies') }}">Companies</a></li>
    <li ><a href="{{ route('prospector.company', ['id' => $contact->company_id]) }}">{{ $company->name }}</a></li>
    <li class="active" style="color: black">{{ $contact->email }}</li>
</ol>

<div class="row">
    <div class="col-sm-12">

        @if(!$company->salesRep)
        <div class="alert alert-danger">
            This contact is not assigned to a sales rep.
        </div>        
        @endif
        <div class="row">
            <div class="col-sm-9">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#prospects">Activity Log</a></li>
                    <li><a data-toggle="tab" href="#meta">Contact Meta</a></li>
                </ul>


                <div class="tab-content m-t">
                    <div class="tab-pane active" id="prospects">

                        @if($activities->count() > 0)

                        @foreach($activities as $activity)

                        <div class="well well-small">

                            <h5 class="text-muted m-a-0 pull-right">Completed by {{ $activity->salesRep()->first()->name }}</h5>
                            <h4 class="m-a-0"><strong>{{ $activity->created_at->diffForHumans() }}</strong></h4>

                            <hr />
                            {!! nl2br($activity->content) !!}
                        </div><!--well-->

                        @endforeach

                        @else
                        <div class="alert">This contact has no activities logged.</div>
                        @endif


                    </div><!--prospects-->

                    <div class="tab-pane" id="meta">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Key</th>
                                    <th>Value</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($contact->meta as $meta)
                                <tr>
                                    <td>{{ $meta->key }}</td>
                                    <td>{{ $meta->value }}</td>
                                    <td><a href="#" class="btn btn-xs btn-danger-outline"><span class="icon icon-circle-with-cross"></span></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!--prospects-->
                </div><!--tab-content-->
            </div><!--col-->

            @include('partials/company')
            
        </div>
    </div><!--row--> 

</div><!--col-->
</div><!--row-->

@endsection
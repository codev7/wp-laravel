@extends('spark::layouts.spark')

@section('content')
<div class="hr-divider m-t-md m-b">
    <h3 class="hr-divider-content hr-divider-heading">Company Info</h3>
</div>
<ol class="breadcrumb">
    <li><a href="{{ route('prospector.dashboard') }}">Dashboard</a></li>
    <li><a href="{{ route('prospector.companies') }}">Companies</a></li>
    <li class="active" style="color: black">{{ $company->name }}</li>
</ol>

<div class="row">
    <div class="col-sm-12">

        @if(!$company->salesRep)
        <div class="alert alert-danger">
            This company is not assigned to a sales rep.
        </div>        
        @endif
        <div class="row">
            <div class="col-sm-9">


                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#prospects">Prospects</a></li>
                    <li><a data-toggle="tab" href="#meta">Company Meta</a></li>
                </ul>

                <br />

                <div class="tab-content">
                    <div class="tab-pane active" id="prospects">
                        <div class="table-full">
                            <div class="table-responsive">
                                <table class="table table-middle">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Last Contacted</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if($company->contacts()->count() > 0)

                                        @foreach($company->contacts as $prospect)
                                        <tr>
                                            <td><a href="{{ route('prospector.contact', ['id' => $prospect->company_id, 'person_id' => $prospect->id]) }}">{{ $prospect->first_name. ' '.$prospect->last_name }}</a></td>
                                            <td>{{ $prospect->email }}</td>
                                            <td>{!! $prospect->getTimeOfLastActivity() !!}</td>
                                            <td><a href="{{ route('prospector.contact', ['id' => $prospect->company_id, 'person_id' => $prospect->id]) }}" class="btn btn-warning"><i class="icon icon-edit"></i></a></td>
                                        </tr>
                                        @endforeach


                                        @else
                                        <tr>
                                        <td colspan"4">No prospects.</td>

                                        </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
                                    @foreach($company->meta as $meta)
                                    <tr>
                                        <td>{{ $meta->key }}</td>
                                        <td>{{ $meta->value }}</td>
                                        <td><a href="#" class="btn btn-xs btn-danger"><span class="icon icon-circle-with-cross"></span></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div><!--prospects-->
                    </div><!--tab-content-->
                </div><!--col-->

                @include('partials/company')
      
            </div><!--row-->

        </div><!--col-->
    </div><!--row-->

@endsection
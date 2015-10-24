@extends('spark::layouts.spark')

@section('content')


<div class="hr-divider m-t-md m-b">

    <h3 class="hr-divider-content hr-divider-heading">{{ Input::get('search') ? 'Search Results: ' . Input::get('search') : 'All Companies' }}</h3>
</div>

<form action="{{ route('prospector.companies', ['rep' => null, 'filter' => 'all']) }}" method="get">
    <div class="flextable table-actions">
        <div class="flextable-item flextable-primary">
            <div class="btn-toolbar-item input-with-icon">

                <input type="text" name="search" class="form-control input-block" placeholder="Search companies">
                <span class="icon icon-magnifying-glass"></span>

            </div>
            <div class="btn-group btn-toolbar-item btn-group-thirds">
                <a href="{{ route('prospector.companies', ['rep' => null, 'filter' => $filter]) }}" class="btn {{ $rep === null ? 'active' : null }} btn-primary-outline">All Reps</a>
                <a href="{{ route('prospector.companies', ['rep' => 'joe', 'filter' => $filter]) }}" class="btn {{ $rep == 'joe' ? 'active' : null }} btn-primary-outline">Joe</a>
                <a href="{{ route('prospector.companies', ['rep' => 'nate', 'filter' => $filter]) }}" class="btn {{ $rep == 'nate' ? 'active' : null }} btn-primary-outline">Nate</a>
                <a href="{{ route('prospector.companies', ['rep' => 'connor', 'filter' => $filter]) }}" class="btn {{ $rep == 'connor' ? 'active' : null }} btn-primary-outline">Connor</a>
            </div>

            <div class="btn-group btn-toolbar-item btn-group-thirds">
                <a href="{{ route('prospector.companies', ['rep' => $rep, 'filter' => 'all']) }}" class="btn {{ $filter == 'all' ? 'active' : null }} btn-primary-outline">All Companies</a>
                <a href="{{ route('prospector.companies', ['rep' => $rep, 'filter' => 'agency']) }}" class="btn {{ $filter == 'agency' ? 'active' : null }} btn-primary-outline">Agencies</a>
                <a href="{{ route('prospector.companies', ['rep' => $rep, 'filter' => 'brand']) }}" class="btn {{ $filter == 'brand' ? 'active' : null }} btn-primary-outline">Brands</a>
                <a href="{{ route('prospector.companies', ['rep' => $rep, 'filter' => 'na']) }}" class="btn {{ $filter == 'na' ? 'active' : null }} btn-primary-outline">NA</a>
            </div>
        </div>

    </div>
</form>

<div class="row">
    <div class="col-md-12">


        <div class="table-full">
            <div class="table-responsive">
                <table class="table table-middle">
                    <thead>
                        <tr>
                            <th>Company Name</th>
                            <th class="text-center">Sales Rep</th>
                            <th class="text-center"># Contacts</th>
                            <th class="text-center">Status @if(Input::get('status'))
                                <small><a class="text-danger" href="{{ route('prospector.companies',['filter' => $filter, 'rep' => $rep]) }}">Remove Filter</a></small>
                                @endif</th>
                                <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if($companies->count() > 0)

                        @foreach($companies as $company)
                        <tr>
                            <td><h4 class="m-a-0"><a href="{{ route('prospector.company', ['id' => $company->id]) }}">{{ $company->name }}</a></h4></td>
                            <td class="text-center">{!! $company->salesRep ? $company->salesRep->first_name : '<small class="text-muted">N/A</small>' !!}</td>
                            <td class="text-center">{{ $company->contacts->count() }}</td>
                            <td class="text-center">{!! $company->status ? '<a href="'. route('prospector.companies', ['filter' => $filter, 'rep' => $rep, 'status' => $company->status]) .'">'.$company->status.'</a>' : '<small class="text-muted">no status</small>' !!}</td>
                            <td  class="text-right"><a href="{{ route('prospector.company', ['id' => $company->id]) }}" class="btn btn-warning"><i class="icon icon-edit"></i></a></td>
                        </tr>
                        @endforeach


                        @else
                        <tr>
                            <td colspan"5">No companies.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>

                <div class="text-center">
                    {!! $companies->render() !!}
                </div><!-- text-center -->
            </div>
        </div>
    </div>
</div>

@endsection
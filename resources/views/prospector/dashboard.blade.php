@extends('spark::layouts.spark')

@section('content')


<div class="hr-divider m-t-md m-b">
    <h3 class="hr-divider-content hr-divider-heading">Sales Rep Stats</h3>
</div>

<div class="row">
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
        @foreach($reps as $count => $rep)
        <li @if($reps[0]->id == $rep->id) class="active" @endif><a data-toggle="tab" href="#tab-{{ $count }}">{{ $rep->name }}</a></li>
        @endforeach
        </ul>

        <div class="tab-content m-t">

            @foreach($reps as $count => $rep)
                <div class="tab-pane @if($reps[0]->id == $rep->id) active @endif" id="tab-{{ $count }}}">

                    @include('partials/rep',['rep' => $rep])

                </div><!--tab-pane-->
            @endforeach
        </div><!--tab-content-->
    </div>
</div>

<hr class="m-t">

<div class="row">
    <div class="col-md-12">
        <div class="list-group">
            <h4 class="list-group-header">
                <strong>{{ $unassigned->total() }} Unassigned Companies</strong>
            </h4>

            <div class="table-full">
                <div class="table-responsive">
                    <table class="table"> 
                        @if($unassigned->count() > 0)

                        @foreach($unassigned as $company)
                        <tr>
                            <td style="vertical-align: middle"><a href="{{ route('prospector.company', ['id' => $company->id]) }}">{{ $company->name }}</a><br /><small class="text-muted">{{ $company->contacts->count() }} contacts</small></td>
                            <td style="width: 50%">
                                Assign to: 
                                <form action="{{ route('prospector.update-company', ['id' => $company->id]) }}" method="post">
                                    <div class="flextable">
                                        <div class="flextable-item flextable-primary">
                                            <select name="sales_rep_id" class="custom-select custom-select-sm form-control">@foreach($reps as $rep)<option value="{{ $rep->id }}">{{ $rep->email }}</option>@endforeach</select>
                                        </div>
                                        <div class="flextable-item">
                                            <div class="btn-group">
                                                <button type="submit" class="btn btn-primary-outline">
                                                    Assign
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @else

                        @endif
                    </table>

                    <div class="text-center">
                        {!! $unassigned->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('modals/explainers')

@endsection
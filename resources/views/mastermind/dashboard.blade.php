@extends('spark::layouts.spark')

@section('content')


<div class="hr-divider m-t-md m-b">

    <h3 class="hr-divider-content hr-divider-heading">All Projects</h3>
</div>

<div class="row">
    <div class="col-md-12">


        <div class="table-full">
            <div class="table-responsive">
                <table class="table table-middle">
                    <thead>
                        <tr>
                            <th>Project Name</th>
                            <th class="text-center">Created At</th>
                            <th class="text-center">Last Message</th>
                            <th class="text-center">Status @if(Input::get('status'))
                                <small><a class="text-danger" href="{{ route('prospector.companies',['filter' => null, 'rep' => null]) }}">Remove Filter</a></small>
                                @endif</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if($projects->count() > 0)

                        @foreach($projects as $project)
                        <tr>
                            <td><h4 class="m-a-0"><a href="{{ route('project.single', ['slug' => $project->slug]) }}">{{ $project->name }}</a><br /><small class="text-muted">{{ $project->team->name }}</small></h4></td>
                            <td class="text-center">{{ $project->created_at->diffForHumans() }}</td>
                            <td class="text-center">na</td>
                            <td class="text-center">{{ $project->status }}</td>
                            <td  class="text-right"><a href="{{ route('project.single', ['slug' => $project->slug]) }}" class="btn btn-primary-outline"><i class="fa fa-arrow-right"></i></a></td>
                        </tr>
                        @endforeach


                        @else
                        <tr>
                            <td colspan="5">No companies.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>

                <div class="text-center">
                    {!! $projects->render() !!}
                </div><!-- text-center -->
            </div>
        </div>
    </div>
</div>

@endsection
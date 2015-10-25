@extends('spark::layouts.spark')

@section('content')


<div class="hr-divider m-t-md m-b">
    <h3 class="hr-divider-content hr-divider-heading">Welcome back, {{ Auth::user()->getFirstName() }}</h3>
</div>

<div class="row">
    <div class="col-sm-12">
        
        <p class="text-center">Mastermind only functionality here.  Coming soon...</p>

    </div>
</div>

@endsection
@extends('spark::layouts.spark')

@section('content')
<div id="spark-register-screen" class="container spark-screen">
    <div class="row spark-subscription-inspiration-single">
        Welcome to Code My Views!
    </div>

    <div class="col-md-8 col-md-offset-2">

        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Pending Invitation From {{ $invitation->team->owner->name }}</div>

                <div class="panel-body bg-success">
                    <div>
                        We found your invitation to the <strong>{{ $invitation->team->name }}</strong> team!
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" id="subscription-basics-form">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Your Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Email</label>
                            <div class="col-md-6">
                                <input type="text" value="{{ $invitation->email }}" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-6 col-sm-offset-3">
                            <button type="submit" class="btn btn-primary">
                                <span>
                                    <i class="fa fa-btn fa-check-circle"></i>
                                    <span>
                                        Register
                                    </span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@extends('spark::layouts.spark-no-container')


@section('additional_js')
<style>
body {
    background: white !important;
}
</style>
<script type="text/javascript">
    window.onload = function(){
        var trixToolbar = $('trix-toolbar');
        trixToolbar.find('button').attr('tabindex','-1');
    }
</script>
@stop

@section('content')

<section class="quote-area">
    <div class="container" id="quote-form" data-controller="project/new"
         v-cloak
         state="{{json_encode($state)}}"
    >
        <div class="row">
            <div class="col-md-6">

                @if(Auth::check())
                <header class="head-block">
                    <h1 class="sub-ttl">Hey there, {{ Auth::user()->getFirstName() }}.</h1>
                    <h2 class="ttl text-primary">Create a Project <i class="fa fa-long-arrow-right"></i></h2>
                </header>
                @else
                <header class="head-block">
                    <h1 class="sub-ttl">Get a Guaranteed Price Quote</h1>
                    <h2 class="ttl text-primary">for Your Project</h2>
                </header>
                @endif

                <div class="how-work clearfix">
                    <img src="{{ asset('images/img-46.svg') }}" alt="image description" class="pull-left how-img" >
                    <h3 class="text-primary">HOW we WORK</h3>
                    <ol class="how-list">
                        <li>You tell us about what you need and when you need it.</li>
                        <li>We review it and get back to you in an hour with any questions and an estimate.</li>
                        <li>A finalized quote and project outline with a guaranteed delivery date is sent.</li>
                        <li>All of our estimates are good for 1 year.  Come back whenever you are ready.</li>
                    </ol>
                </div>
            </div>
            <div class="col-md-6">
                <div class="quote-form clearfix">

                    @if(Auth::guest())
                        <div class="hr-divider">
                            <ul class="nav nav-pills nav-pills-warning hr-divider-content hr-divider-nav">
                                <li class="active">
                                    <a href="#step-1" data-toggle="tab">Step 1: Project Details</a>
                                </li>
                                <li>
                                    <a href="#step-2" data-toggle="tab">Step 2: Contact Info</a>
                                </li>
                            </ul>
                        </div>
                    @endif
                    
                    <form method="post" class="tab-content" v-on:submit="createProject($event)">
                        <div class="tab-pane active" id="step-1">

                            <div class="form-group">
                                <label for="project_name" class="control-label m-t-lg">
                                   What is the name of your project?
                                </label>
                                <input type="text" name="project_name" id="project_name" class="form-control required input-lg"
                                       v-model="form.project_name">
                            </div>

                            <label for="project_type" class="">What type of project do you have?</label>
                            <div class="sel-hold m-b-0">
                                <select name="project_type" id="project_type" class="form-control input-lg"
                                        v-model="form.project_type">
                                <option value="">Select a Project Type</option>
                                @foreach(quoteFieldsProjectFields() as $option)
                                    <option value="{{ $option }}">{{ $option }}</option>
                                @endforeach
                            </select>
                            </div>

                            <label for="lead_deadline">When is your deadline?</label>
                            <div class="sel-hold m-b-0">
                                <select name="lead_deadline" id="lead_deadline" class="form-control input-lg"
                                        v-model="form.requested_deadline">
                                    <option value="">Select a Deadline</option>
                                    @foreach(leadDeadlineOptions() as $option)
                                        <option value="{{ $option }}">{{ $option }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <label for="lbl-12">What should we know about your project?</label>
                            <textarea name="project_brief" id="project_brief" class="hidden form-control input-lg m-b-0" cols="30" rows="10" placeholder="Enter your project info here..."
                                      v-model="form.message"
                                      v-trix></textarea>

                            <p class="text-muted m-t-0 m-b-lg">You will be able to upload files to your project later.</p>

                            <input class="hidden" v-model="form.agreed_to_nda" type="checkbox" />

                            @if(Auth::guest())
                                <button class="btn btn-success btn-submit pull-right" v-on:click="openStep2($event)"">NEXT STEP</button>
                            @else
                                <button type="submit" class="btn btn-lg btn-success btn-block"
                                        v-submit="posting">Create Project</button>
                            @endif
                        </div>

                        @if (Auth::guest())
                        <div class="tab-pane" id="step-2">

                            <div class="form-group">
                                <label for="name" class="control-label m-t-lg">5) What is your name?</label>
                                <input type="text" name="name" id="name" class="form-control required input-lg"
                                       v-model="form.user_name">
                            </div>

                            <div class="form-group">
                                <label for="company_name" class="control-label">6) What is your company name (or team name)?</label>
                                <input type="text" name="company_name" id="company_nams" class="form-control required input-lg"
                                       v-model="form.company_name">
                            </div>

                            <div class="form-group">
           
                                <label for="email" class="control-label">7) What is your email?</label>
                                <input type="text" name="email" id="email" class="form-control input-lg form-control required"
                                       v-model="form.email">
                            </div>
                            
                            <div class="form-group">
                                <label for="password" class="control-label">Optional: Set Account Password</label>
                                <input type="password" name="password" id="password" class="form-control input-lg form-control"
                                       v-model="form.password">
                            </div>

                            <button type="submit" class="btn btn-lg btn-success btn-block"
                                    v-submit="posting">Get Free Quote</button>
                        </div><!--step-->
                        @endif
                    </form>
                </div>
            </div>
        </div>

        @include('modals/nda')
    </div>

</section><!-- / quote-area -->

@endsection
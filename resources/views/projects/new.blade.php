@extends('spark::layouts.spark-no-container')


@section('additional_js')
<script type="text/javascript" src="{{ asset('//api.filepicker.io/v1/filepicker.js') }}"></script>
@stop

@section('content')

<section class="quote-area">
    <div class="container" id="quote-form">
        <div class="row">
            <div class="col-md-6">
                <header class="head-block">
                    <h1 class="sub-ttl">Get a Guaranteed Price Quote</h1>
                    <h2 class="ttl text-primary">for Your Project</h2>
                </header>
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
                    <form method="post"
                    v-on="submit: onSubmitForm"
                    id="form-quote">


                        <div v-if="step == 1">
                            <label for="project_type">What type of project do you have?</label>
                            <div class="sel-hold">
                                <select
                                name="project_type"
                                id="project_type"
                                class="form-control input-lg"
                                v-model="newQuote.project_type">
                                <option value="">Select a Project Type</option>
                                @foreach(quoteFieldsProjectFields() as $option)
                                    

                                    <option value="{{ $option }}">{{ $option }}</option>

                                @endforeach
                            </select>
                            </div>
                            <label for="lead_deadline">When is your deadline?</label>
                            <div class="sel-hold">
                                <select
                                name="lead_deadline"
                                id="lead_deadline"
                                class="form-control input-lg"
                                v-model="newQuote.lead_deadline">
                                <option value="">Select a Deadline</option>
                                @foreach(leadDeadlineOptions() as $option)
                                    <option value="{{ $option }}">{{ $option }}</option>
                                @endforeach
                            </select>
                            </div>
                            <label for="lbl-12">What should we know about your project?</label>
                            <textarea type="text"
                                name="project_brief"
                                id="project_brief"
                                class="form-control input-lg"
                                v-model="newQuote.project_brief"
                                cols="30"
                                rows="10"
                                placeholder="Enter your project info here..."></textarea>
                            <div class="upload-box" id="file-upload"
                                    class="btn btn-primary"
                                    v-on="click: launchFilePicker">
                                <div class="upload-hold">
                                    <input type="file">
                                </div>
                                <h4>Do you have any files to upload?</h4>
                                <p>Upload as many files as you want by clicking the upload icon to the left.  You can add more files later.</p>
                                <br />
                                <h4 class="text-success" v-if="fileCount > 0">You uploaded @{{ fileCount }} file<span v-if="fileCount > 1">s</span>.</h4>
                            </div>
                            <button v-on="click: gotoStep(2, $event)" class="btn btn-success btn-submit pull-right" type="submit">NEXT STEP</button>
                        </div>

                        <div v-if="step == 2">

                            <p><a href="" v-on="click: gotoStep(1, $event)" class="btn btn-sm"><small><i class="fa fa-arrow-left"></i> back to step 1</small></a></p>

                            <div
                            v-class="
                                form-group : true,
                                has-error : hasError('name')
                            ">
                                <label
                                    for="name"
                                    class="control-label">
                                   5) What is your name?
                                </label>
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    class="form-control required input-lg"
                                    v-model="newQuote.name">
                            </div>

                            <div 
                            v-class="
                                form-group : true,
                                has-error : hasError('email')
                            ">
                                <label
                                    for="email"
                                    class="control-label">
                                    6) What is your email?
                                </label>
                                <input type="text" name="email" id="email" class="form-control input-lg form-control required" v-model="newQuote.email">
                            </div>
                            
                            <div 
                            v-class="
                                form-group : true
                            ">
                                <label
                                    for="phone"
                                    class="control-label">
                                    Optional: What is your phone number?
                                </label>
                                <input type="text" name="phone" id="phone" class="form-control input-lg form-control" v-model="newQuote.phone">
                            </div>

                            <button 
                            v-on="click: onSubmitForm"
                            v-if="!submitted"
                            class="btn btn-lg btn-success btn-block">Get Free Quote</button>

                            <button 
                            v-if="submitted"
                            disabled="!disabled"
                            class="btn btn-lg btn-success btn-disabled btn-block"><i class="fa fa-spin fa-spinner"></i> Sending...</button>

                        </div><!--step-->


                        <div
                        v-if="step == 3" class="success-message">
                            <p>We have received your information and one of our expert developers or designers will be in touch within a hour.</p>

                            <p>If we received this after hours, we will respond first thing in the morning.</p>

                            <p>We are excited about the opportunity we have to work with you.  If you have any other questions in the meantime, you can find all of our contact information in the footer of the website.</p>

                            <p>Talk to you soon, <br />
                            The Code My Views Inc. Team</p>
                        </div>  
                    </form>
                </div>
            </div>
        </div>
    </div>
</section><!-- / quote-area -->

@endsection
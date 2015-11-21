@extends('spark::layouts.spark')



<!-- Main Content -->
@section('content')
<div class="row">

    @include('projects/partials/sidebar')

    <div class="col-md-9" data-controller="project/briefs">
        
        <div class="panel panel-default panel-profile brief-panel">

            <div class="panel-body">
                
                <div class="pull-right w-sm">
                    <a href="#" class="m-t-md btn btn-lg btn-block btn-success-outline"><i class="fa fa-thumbs-o-up"></i> Approve Brief</a>

                    <p class="m-a-0 text-center"><a href="#" class="text-danger">Request Changes</a></p>
                </div>

                <h1>Front End Brief
                    <small>
                        <span style="top: -5px" data-placement="right" class="pos-r tooltipper text-primary" title="A front end brief covers all details about the HTML/CSS/JavaScript of this project.">
                             <i class="fa fa-question-circle"></i>
                        </span>
                    </small>
                    <br />
                    <small class="text-muted">{{ $project->name }} - Prepared on November 21, 2015</small>
                </h1>

                <div class="hr-divider m-b m-t">
                  <h3 class="hr-divider-content hr-divider-heading">
                    Summary 
                  </h3>
                </div>  

                <div class="row">
                    <div class="col-sm-4">
                        <div class="statcard statcard-gray p-a-md m-b tooltipper" data-placement="bottom" data-title="These are the unique pages that we will turn into a pixel perfect front end.">
                          <h3 class="statcard-number">
                            4 Views
                          </h3>
                          <span class="statcard-desc"># of page templates <i class="fa fa-question-circle"></i></span>
                        </div>
                    </div><!--col-->

                    <div class="col-sm-4">
                        <div class="statcard statcard-gray p-a-md m-b tooltipper" data-placement="bottom" data-title="These are the modal windows that we will be included in the front end.">
                          <h3 class="statcard-number">
                            2 Modals
                          </h3>
                          <span class="statcard-desc"># of modal views <i class="fa fa-question-circle"></i></span>
                        </div>
                    </div><!--col-->

                    <div class="col-sm-4">
                        <div class="statcard statcard-gray p-a-md m-b tooltipper" data-html="true" data-placement="bottom" data-title="This is the layout type we will use.  A responsive layout will be fully responsive to the width of the browser / device. <br /><br />Other Options:</strong><br />Fixed / Mobile-only / Fluid">
                          <h3 class="statcard-number">
                            Responsive
                          </h3>
                          <span class="statcard-desc">layout type <i class="fa fa-question-circle"></i></span>
                        </div>
                    </div><!--col-->
                </div><!--row-->

                <div class="hr-divider">
                  <h3 class="hr-divider-content hr-divider-heading">
                    Details 
                  </h3>
                </div> 

                <div class="row m-t-md">
                    <div class="col-sm-3">
                        <div class="panel panel-default panel-profile brief-panel p-l-0">

                            <div class="panel-body p-l-0 p-r-0 p-t-0 p-b-0">
                                <ul class="nav nav-bordered nav-stacked m-t">
                                    <li class="nav-header">Global</li>
                                        
                                    <li class="active">
                                        <a href="#overview" data-toggle="tab">Overview</a>
                                    </li>

                                    <li><a href="#global-notes" data-toggle="tab">Global Notes</a></li>

                                    <li class="nav-header m-t">Views</li>

                                    <li><a href="#view-home" data-toggle="tab">Home</a></li>
                                    <li><a href="#view-about-us" data-toggle="tab">About Us</a></li>
                                    <li><a href="#view-products" data-toggle="tab">Products</a></li>
                                    <li><a href="#view-product-detail" data-toggle="tab">Product Detail</a></li>

                                    <li class="nav-header m-t">Modals</li>

                                    <li><a href="#modal-contact-us" data-toggle="tab">Contact Us</a></li>
                                    <li><a href="#modal-product-image-gallery" data-toggle="tab">Product Image Gallery</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-9">
                        <div class="tab-content m-t">
                            <div class="tab-pane active" id="overview">
                                <h2 class="m-t-0 p-t-0">Project Overview</h2>

                                <p>Here is a quick summary about the project.  This project summary will never have more than 300 characters and should serve as a brief overview of the project.  In addition, below this project summary will be some text is auto-generated based off of the details for each project.</p>

                            </div><!--overview-->

                            <div class="tab-pane" id="global-notes">
                                
                            </div>
                        </div><!--tab-content-->
                    </div><!--col-->
                </div>
                

            </div>

        </div><!--panel-->
        
        
    </div>
@endsection
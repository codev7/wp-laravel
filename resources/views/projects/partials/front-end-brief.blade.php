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

            <div class="panel-body p-l-0 p-r-0 p-t-0">
                <ul class="nav nav-bordered nav-stacked m-t">
                    <li class="nav-header">Global</li>
                        
                    <li class="active">
                        <a href="#overview" data-toggle="tab">Overview</a>
                    </li>

                    <li><a href="#global-notes" data-toggle="tab">Global Notes</a></li>

                    <li class="nav-header m-t">Views</li>

                    <li><a href="#view-home" data-toggle="tab">Home</a></li>
                    <li><a href="#view-other-pages" data-toggle="tab">About Us</a></li>
                    <li><a href="#view-other-pages" data-toggle="tab">Products</a></li>
                    <li><a href="#view-other-pages" data-toggle="tab">Product Detail</a></li>

                    <li class="nav-header m-t">Modals</li>

                    <li><a href="#view-other-pages" data-toggle="tab">Contact Us</a></li>
                    <li><a href="#view-other-pages" data-toggle="tab">Product Image Gallery</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-sm-9">
        <div class="tab-content">
            <div class="tab-pane active" id="overview">
                <h3 class="m-t-0 p-t-0">Project Overview</h3>

                <p>Here is a quick summary about the project.  This project summary will never have more than 300 characters and should serve as a brief overview of the project.</p>

                <div class="well well-small">
                    <p class="m-a-0 p-a-0"><strong>Note:</strong> This brief has another brief associated with it.  All delivery dates and cost estimates include the completion of all associated briefs:</p>

                    <ul class="m-a-0 m-t">
                        <li><a data-pjax href="{{ route('project.brief', ['slug' => $project->slug, 'brief_id' => 'sample-wordpress-brief']) }}">WordPress Brief</a></li>
                    </ul>
                </div>

                

                <h4>Quick Summary</h4>
                <table class="table table-middle m-b-0">

                    <tbody>
                        <tr>
                            <th class="text-center">
                                <h4 class="m-t-0"><i class="fa fa-calendar"></i><br /><small>Delivery Date</small></h4>
                            </th>
                            <td>
                                <p>This project can be completed in as soon as 3 business days - 10 business days, depending on which speed you pick on the invoice page.</p>

                                <p class="text-muted m-b-0"><strong>All of our projects come with a <a href="#">delivery date guarantee</a>.</strong></p>
                            </td>
                        </tr>

                        <tr>
                            <th class="text-center">
                                <h4><i class="fa fa-credit-card"></i><br /><small>Cost</small></h4>
                            </th>
                            <td>
                                
                                <p class="m-b-0">The guaranteed cost for this project is $1,000 - $3,000, depending on which delivery speed you pick on the invoice page.  <a href="#"><strong>View Invoice</strong></a>.</p>

                            </td>
                        </tr>

                        <tr>
                            <th class="text-center">
                                <h4><i class="fa fa-file-image-o"></i><br /><small>Files</small></h4>
                            </th>
                            <td>
                                
                                  <p class="m-b-0">There have been 4 files uploaded to this project.  <a href="#"><strong>View Files</strong></a>.</p>

                            </td>
                        </tr>
                    </tbody>

                </table>

                



            </div><!--overview-->

            <div class="tab-pane " id="global-notes">
                <h3 class="m-t-0 p-t-0">Global Front End Notes</h3>

                <p>Admin will have a WYSIWYG editor that will be outputted below.</p>
                <p><strong>Pellentesque habitant morbi tristique</strong> senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor <code>commodo vitae</code>.</p>
                           
                <ol>
                   <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
                   <li>Aliquam tincidunt mauris eu risus.</li>
                </ol>


                <h4>Checklist Items <i  data-title="The check list items will be used globally across all views.  These items are used during the QA process to verify project success." class="tooltipper fa fa-question-circle"></i></h4>
            

                <div class="checkbox custom-control custom-checkbox">
                  <label class="w-full">
                    <input type="checkbox" checked>
                    <span class="custom-control-indicator"></span>
                    Use Twitter Bootstrap
                  </label>
                </div>
                <div class="checkbox custom-control custom-checkbox">
                  <label  class="w-full">
                    <input type="checkbox" checked>
                    <span class="custom-control-indicator"></span>
                    Header should be fixed as the user scrolls down the page
                  </label>
                </div>
                <div class="checkbox custom-control custom-checkbox">
                  <label  class="w-full">
                    <input type="checkbox" checked>
                    <span class="custom-control-indicator"></span>
                    Dropdown menu should have fade in animation: <a href="#">http://srcnsht.my/SCjk2ct</a>
                  </label>
                </div>
            </div>

            <div class="tab-pane" id="view-home">

                <h3 class="m-t-0 p-t-0">Home View</h3>

                <p>Less than 140 character summary of the home view.</p>

                <h4>Checklist Items</h4>

                <ul class="nav nav-pills">
                    <li class="active"><a href="#design-home" data-toggle="tab">Design</a></li>
                    <li><a href="#html-css-home" data-toggle="tab">HTML/CSS</a></li>
                    <li><a href="#javascript-home" data-toggle="tab">JavaScript</a></li>
                    <li><a href="#animations-home" data-toggle="tab">Animations</a></li>
                </ul>

                <div class="tab-content m-t">

                    <div class="tab-pane active" id="design-home">

                        <div class="checkbox custom-control custom-checkbox">
                          <label  class="w-full">
                            <input type="checkbox" checked>
                            <span class="custom-control-indicator"></span>
                            Desktop design file provided.
                          </label>
                        </div>

                        <div class="checkbox custom-control custom-checkbox">
                          <label  class="w-full">
                            <input type="checkbox" checked>
                            <span class="custom-control-indicator"></span>
                            Mobile design file provided.
                          </label>
                        </div>
                        <div class="checkbox custom-control custom-checkbox">
                          <label  class="w-full">
                            <input type="checkbox" checked>
                            <span class="custom-control-indicator"></span>
                            No other design files provided.  We will ensure that the site is fully responsive and bug free across all devices and viewport sizes.
                          </label>
                        </div>

                        <h4 class="m-t">Design Proof</h4>

                        <div class="row">
                            <div class="col-sm-3 text-center">
                                <a class="full-screen-screenshot" href="{{ asset('images/screenshots/home.png') }}"><img class="w-full" src="{{ asset('images/screenshot-icon.png') }}" alt="" /></a>

                                <small>Desktop</small>
                            </div>

                            <div class="col-sm-3 text-center">
                                <a class="full-screen-screenshot" href="{{ asset('images/screenshots/mobile-screenshot.png') }}"><img class="w-full" src="{{ asset('images/screenshot-icon.png') }}" alt="" /></a>

                                <small>Mobile</small>
                            </div>
                        </div>

                        <h4>Design File</h4>
                        <p>This design can be found in the <a href="#">All Files.psd</a> file in the project files section.</p>
                    </div>
                    <div class="tab-pane" id="html-css-home">
                        <div class="checkbox custom-control custom-checkbox">
                          <label class="w-full">
                            <input type="checkbox" checked>
                            <span class="custom-control-indicator"></span>
                            Logo should slide in front left on home page only
                          </label>
                        </div>
                    </div>

                    <div class="tab-pane" id="javascript-home">
                        <div class="checkbox custom-control custom-checkbox">
                          <label class="w-full">
                            <input type="checkbox" checked>
                            <span class="custom-control-indicator"></span>
                            Top section of page should be a slider
                          </label>
                        </div>

                        <div class="checkbox custom-control custom-checkbox">
                          <label class="w-full">
                            <input type="checkbox" checked>
                            <span class="custom-control-indicator"></span>
                            Testimonials at bottom of page should be a carousel slider
                          </label>
                        </div>
                    </div>

                    <div class="tab-pane" id="animations-home">
                        <div class="checkbox custom-control custom-checkbox">
                          <label class="w-full">
                            <input type="checkbox" checked>
                            <span class="custom-control-indicator"></span>
                            Each section has a fade in animation for all of the elements as you scroll down.
                          </label>
                        </div>

                        <div class="checkbox custom-control custom-checkbox">
                          <label class="w-full">
                            <input type="checkbox" checked>
                            <span class="custom-control-indicator"></span>
                            More detailed notes about animation specific stuff with ability to associate screenshots with each item <a href="#">http://scrensht.zy/dsj3jx</a>
                          </label>
                        </div>
                    </div>
                </div><!--tab-content-->

            </div>

            <div class="tab-pane" id="view-other-pages">

                <h3 class="m-t-0 p-t-0">[page_name] View</h3>

                <p>Less than 140 character summary of the [page_name] view.</p>

                <h4>Checklist Items</h4>

                <ul class="nav nav-pills">
                    <li class="active"><a href="#design-other-page" data-toggle="tab">Design</a></li>
                    <li><a href="#html-other-page" data-toggle="tab">HTML/CSS</a></li>
                    <li><a href="#javascript-other-page" data-toggle="tab">JavaScript</a></li>
                    <li><a href="#animations-other-page" data-toggle="tab">Animations</a></li>
                </ul>

                <div class="tab-content m-t">

                    <div class="tab-pane active" id="design-other-page">

                        <div class="checkbox custom-control custom-checkbox">
                          <label  class="w-full">
                            <input type="checkbox" checked>
                            <span class="custom-control-indicator"></span>
                            Desktop design file provided.
                          </label>
                        </div>

                        <div class="checkbox custom-control custom-checkbox">
                          <label  class="w-full">
                            <input type="checkbox" checked>
                            <span class="custom-control-indicator"></span>
                            Mobile design file provided.
                          </label>
                        </div>
                        <div class="checkbox custom-control custom-checkbox">
                          <label  class="w-full">
                            <input type="checkbox" checked>
                            <span class="custom-control-indicator"></span>
                            No other design files provided.  We will ensure that the site is fully responsive and bug free across all devices and viewport sizes.
                          </label>
                        </div>

                        <h4 class="m-t">Design Proof</h4>

                        <div class="row">
                            <div class="col-sm-3 text-center">
                                <a class="full-screen-screenshot" href="{{ asset('images/screenshots/home.png') }}"><img class="w-full" src="{{ asset('images/screenshot-icon.png') }}" alt="" /></a>

                                <small>Desktop</small>
                            </div>

                            <div class="col-sm-3 text-center">
                                <a class="full-screen-screenshot" href="{{ asset('images/screenshots/mobile-screenshot.png') }}"><img class="w-full" src="{{ asset('images/screenshot-icon.png') }}" alt="" /></a>

                                <small>Mobile</small>
                            </div>
                        </div>

                        <h4>Design File</h4>
                        <p>This design can be found in the <a href="#">All Files.psd</a> file in the project files section.</p>
                    </div>
                    <div class="tab-pane" id="html-other-page">
                        <div class="checkbox custom-control custom-checkbox">
                          <label class="w-full">
                            <input type="checkbox" checked>
                            <span class="custom-control-indicator"></span>
                            Logo should slide in front left on home page only
                          </label>
                        </div>
                    </div>

                    <div class="tab-pane" id="javascript-other-page">
                        <div class="checkbox custom-control custom-checkbox">
                          <label class="w-full">
                            <input type="checkbox" checked>
                            <span class="custom-control-indicator"></span>
                            Top section of page should be a slider
                          </label>
                        </div>

                        <div class="checkbox custom-control custom-checkbox">
                          <label class="w-full">
                            <input type="checkbox" checked>
                            <span class="custom-control-indicator"></span>
                            Testimonials at bottom of page should be a carousel slider
                          </label>
                        </div>
                    </div>

                    <div class="tab-pane" id="animations-home">
                        <div class="checkbox custom-control custom-checkbox">
                          <label class="w-full">
                            <input type="checkbox" checked>
                            <span class="custom-control-indicator"></span>
                            Each section has a fade in animation for all of the elements as you scroll down.
                          </label>
                        </div>

                        <div class="checkbox custom-control custom-checkbox">
                          <label class="w-full">
                            <input type="checkbox" checked>
                            <span class="custom-control-indicator"></span>
                            More detailed notes about animation specific stuff with ability to associate screenshots with each item <a href="#">http://scrensht.zy/dsj3jx</a>
                          </label>
                        </div>
                    </div>
                </div><!--tab-content-->

            </div>
        </div><!--tab-content-->
    </div><!--col-->
</div>
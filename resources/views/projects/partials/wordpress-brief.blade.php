<h1>WordPress Brief
    <small>
        <span style="top: -5px" data-placement="right" class="pos-r tooltipper text-primary" title="A WordPress brief covers all details about the WordPress implementation of this project.">
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
        <div class="statcard statcard-gray p-a-md m-b tooltipper" data-placement="bottom" data-title="These are page templates that will be re-usable in the WordPress CMS.">
          <h3 class="statcard-number">
            4 Templates
          </h3>
          <span class="statcard-desc"># of custom <br />page templates <i class="fa fa-question-circle"></i></span>
        </div>
    </div><!--col-->

    <div class="col-sm-4">
        <div class="statcard statcard-gray p-a-md m-b tooltipper" data-placement="bottom" data-title="These are the custom post types that will be coded in the theme.">
          <h3 class="statcard-number">
            2 Post Types
          </h3>
          <span class="statcard-desc"># of custom <br />post types <i class="fa fa-question-circle"></i></span>
        </div>
    </div><!--col-->

    <div class="col-sm-4">
        <div class="statcard statcard-gray p-a-md m-b tooltipper" data-html="true" data-placement="bottom" data-title="These are the number of forms or functionality endpoints that will be coded into the theme.">
          <h3 class="statcard-number">
            2 Endpoints
          </h3>
          <span class="statcard-desc"># of forms<br />or endpoints <i class="fa fa-question-circle"></i></span>
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
                        <a href="#wp-overview" data-toggle="tab">Overview</a>
                    </li>

                    <li><a href="#wp-global-notes" data-toggle="tab">Global Notes</a></li>
                    <li><a href="#wp-global-menus" data-toggle="tab">Theme Menus</a></li>

                    <li class="nav-header m-t">Templates</li>

                    <li ><a href="#wp-page-template" data-toggle="tab">Home</a></li>
                    <li><a href="#wp-page-template" data-toggle="tab">Post Index</a></li>
                    <li><a href="#wp-page-template" data-toggle="tab">Default Page</a></li>
                    <li><a href="#wp-page-template" data-toggle="tab">404</a></li>
                    <li><a href="#wp-page-template" data-toggle="tab">Testimonial Index</a></li>
                    <li><a href="#wp-page-template" data-toggle="tab">Contact</a></li>
                    
                    <li class="nav-header m-t">Post Types</li>

                    <li><a href="#view-cpt-post" data-toggle="tab">Posts</a></li>
                    <li><a href="#view-cpt-post" data-toggle="tab">Pages</a></li>
                    <li><a href="#view-cpt-post" data-toggle="tab">Testimonials</a></li>
                    <li><a href="#view-cpt-post" data-toggle="tab">Case Studies</a></li>

                    <li class="nav-header m-t">Forms & Endpoints</li>

                    <li><a href="#wp-endpoint" data-toggle="tab">Contact Form</a></li>
                    <li><a href="#wp-endpoint" data-toggle="tab">Search Form</a></li>
                    <li><a href="#wp-endpoint" data-toggle="tab">Testimonial Filter</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-sm-9">
        <div class="tab-content">
            <div class="tab-pane active" id="wp-overview">
                <h3 class="m-t-0 p-t-0">Project Overview</h3>

                <p>Here is a quick summary about the project.  This project summary will never have more than 300 characters and should serve as a brief overview of the project.</p>

                <div class="well well-small">
                    <p class="m-a-0 p-a-0"><strong>Note:</strong> This brief has another brief associated with it.  All delivery dates and cost estimates include the completion of all associated briefs:</p>

                    <ul class="m-a-0 m-t">
                        <li><a data-pjax href="{{ route('project.brief', ['slug' => $project->slug, 'brief_id' => 'sample-front-end-brief']) }}">Front End Brief</a></li>
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

            <div class="tab-pane" id="wp-global-notes">
                <h3 class="m-t-0 p-t-0">Global WordPress Notes</h3>

                <p>Admin will have a WYSIWYG editor that will be outputted below.</p>
                <p><strong>Pellentesque habitant morbi tristique</strong> senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor <code>commodo vitae</code>.</p>
                           
                <ol>
                   <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
                   <li>Aliquam tincidunt mauris eu risus.</li>
                </ol>


                <h4 >Checklist Items <i  data-title="The check list items will be used globally across all views.  These items are used during the QA process to verify project success." class="tooltipper fa fa-question-circle"></i></h4>
                

                <div class="checkbox custom-control custom-checkbox">
                  <label class="w-full">
                    <input type="checkbox" checked>
                    <span class="custom-control-indicator"></span>
                    Install WP SEO Plugin
                  </label>
                </div>
                <div class="checkbox custom-control custom-checkbox">
                  <label  class="w-full">
                    <input type="checkbox" checked>
                    <span class="custom-control-indicator"></span>
                    Configure Breadcrumbs
                  </label>
                </div>
            </div>


            <div class="tab-pane " id="wp-global-menus">
                <h3 class="m-t-0 p-t-0">WordPress Menus</h3>

                <p>The theme should have the following menus set up:</p>

                <ol>
                    <li><strong>Header Menu</strong> - the menu in the header of every page</li>
                    <li><strong>Footer Menu Bottom Left</strong> - the short menu in bottom left</li>
                    <li><strong>Footer Jumbo Menu</strong> - the large footer menu that is included on a few of the pages</li>
                </ol>
            </div>
            <div class="tab-pane" id="wp-page-template">

                <h3 class="m-t-0 p-t-0">[page_template_name] Page Template</h3>

                <p>Less than 140 character summary of the page template.</p>

                <h4>Checklist Items</h4>

                <ul class="nav nav-pills">
                    <li class="active"><a href="#front-end-page-template" data-toggle="tab">Front End</a></li>
                    <li><a href="#page-template-wp-implementation" data-toggle="tab">WP Implementation</a></li>
                </ul>

                <div class="tab-content m-t">

                    <div class="tab-pane active" id="front-end-page-template">

                        <div class="checkbox custom-control custom-checkbox">
                          <label  class="w-full">
                            <input type="checkbox" checked>
                            <span class="custom-control-indicator"></span>
                            Use Post view from front end brief
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
                    </div>
                    <div class="tab-pane" id="page-template-wp-implementation">
                        <div class="checkbox custom-control custom-checkbox">
                          <label class="w-full">
                            <input type="checkbox" checked>
                            <span class="custom-control-indicator"></span>
                            All content controlled by ACF fields
                          </label>
                        </div>

                        <div class="checkbox custom-control custom-checkbox">
                          <label class="w-full">
                            <input type="checkbox" checked>
                            <span class="custom-control-indicator"></span>
                            Bottom right testimonial feed is a WP_Query from Testimonials post type.
                          </label>
                        </div>

                    </div>

                </div><!--tab-content-->

            </div>



            <div class="tab-pane" id="view-cpt-post">

                <h3 class="m-t-0 p-t-0">Post <br /><small class="text-muted">custom post type</small></h3>

                <p>Less than 140 character summary of the [post_type] custom post type.</p>

                <h4>Post Type Summary</h4>

                <table class="table table-condensed table-striped table-responsive">
                    <tbody>
                        <tr>
                            <th>Has single post page?</th>
                            <td>Yes</td>
                        </tr>
                        <tr>
                            <th>View for single post page:</th>
                            <td>blog-post-single.html</td>
                        </tr>
                        <tr>
                            <th>Include in search results?</th>
                            <td>Yes</td>
                        </tr>
                        <tr>
                            <th>Has an archives page?</th>
                            <td>Yes</td>
                        </tr>
                        <tr>
                            <th>View for post archives page:</th>
                            <td>blog-index.html</td>
                        </tr>
                        <tr>
                            <th>Post Data</th>
                            <td>
                                <ul>
                                    <li>wp_title (text)</li>
                                    <li>content (wysiwyg)</li>
                                    <li>custom_author (text)</li>
                                    <li>featured_image (image)</li>
                                    <li>is_featured_post (boolean)</li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane " id="wp-endpoint">

                <h3 class="m-t-0 p-t-0">Contact Form and Endpoint</h3>

                <p>The contact form endpoint allows the user to submit their contact information which is then stored in the wp-admin area.</p>

                <h4>Form Inputs</h4>

                <ul>
                    <li>first name - required</li>
                    <li>last name - required</li>
                    <li>message</li>
                    <li>company</li>
                    <li>email - required</li>
                    <li>date submitted - hidden field</li>
                </ul>

                <h4>Expected Output / Action</h4>

                <p>On successful form submission, user should be seen a thank you message.  The form inputs should be submitted to an endpoint in the WP theme that will store the submission as a new form entry using the Gravity Forms plugin API.</p>
               
            </div>
            
        </div><!--tab-content-->
    </div><!--col-->
</div>
<h1>Other Generic Brief
    <small>
        <span style="top: -5px" data-placement="right" class="pos-r tooltipper text-primary" title="Brief covers all details about the implementation of this project.">
             <i class="fa fa-question-circle"></i>
        </span>
    </small>
    <br />
    <small class="text-muted">{{ $project->name }} - {{ $brief->getFinishedAtString() }}</small>
</h1>

@if (Auth::user()->is_admin)
<p class="m-a-0">
    <small>
        <a class="text-danger" href="/{{$project->slug}}/briefs/create">
            <i class="fa fa-edit"></i> Edit Brief
        </a>
    </small>
</p>
@endif

<div class="clearfix"></div>

<div class="hr-divider m-b m-t">
  <h3 class="hr-divider-content hr-divider-heading">
    Summary 
  </h3>
</div>  

<div class="row">
    <div class="col-sm-4">
        <div class="statcard statcard-gray p-a-md m-b tooltipper" data-placement="bottom" data-title="[box_tooltip]">
          <h3 class="statcard-number">
            [box_title]
          </h3>
          <span class="statcard-desc">[box_description] <i class="fa fa-question-circle"></i></span>
        </div>
    </div><!--col-->
    <div class="col-sm-4">
        <div class="statcard statcard-gray p-a-md m-b tooltipper" data-placement="bottom" data-title="[box_tooltip]">
          <h3 class="statcard-number">
            [box_title]
          </h3>
          <span class="statcard-desc">[box_description] <i class="fa fa-question-circle"></i></span>
        </div>
    </div><!--col-->
    <div class="col-sm-4">
        <div class="statcard statcard-gray p-a-md m-b tooltipper" data-placement="bottom" data-title="[box_tooltip]">
          <h3 class="statcard-number">
            [box_title]
          </h3>
          <span class="statcard-desc">[box_description] <i class="fa fa-question-circle"></i></span>
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
                        <a href="#brief-overview" data-toggle="tab">Overview</a>
                    </li>

                    <li><a href="#global-menu-item" data-toggle="tab">[global_menu_ item_name]</a></li>
                    <li><a href="#global-menu-item" data-toggle="tab">[global_menu_ item_name]</a></li>

                    <li class="nav-header m-t">[header_title]</li>

                    <li ><a href="#section-menu-item" data-toggle="tab">[section_menu_ item_name]</a></li>
                    <li ><a href="#section-menu-item" data-toggle="tab">[section_menu_ item_name]</a></li>
      
                    <li class="nav-header m-t">[header_title]</li>

                    <li ><a href="#section-menu-item" data-toggle="tab">[section_menu_ item_name]</a></li>
                    <li ><a href="#section-menu-item" data-toggle="tab">[section_menu_ item_name]</a></li>
                   
                </ul>
            </div>
        </div>
    </div>

    <div class="col-sm-9">
        <div class="tab-content">
            <div class="tab-pane active" id="brief-overview">
                <h3 class="m-t-0 p-t-0">Brief Overview</h3>

                <p>Here is a quick summary about the brief.  This summary will never have more than 300 characters and should serve as a brief overview of the project.</p>

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

            <div class="tab-pane " id="global-menu-item">
                <h3 class="m-t-0 p-t-0">[global_menu_item_name]</h3>

                <p>Admin will have a WYSIWYG editor that will be outputted below.</p>
                <p><strong>Pellentesque habitant morbi tristique</strong> senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor <code>commodo vitae</code>.</p>
                           
                <ol>
                   <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
                   <li>Aliquam tincidunt mauris eu risus.</li>
                </ol>


                <h4 >Checklist Items</h4>
                

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

            <div class="tab-pane " id="section-menu-item">
                <h3 class="m-t-0 p-t-0">[section_menu_item_name]</h3>

                <p>Admin will have a WYSIWYG editor that will be outputted below.</p>
                <p><strong>Pellentesque habitant morbi tristique</strong> senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor <code>commodo vitae</code>.</p>
                           
                <ol>
                   <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
                   <li>Aliquam tincidunt mauris eu risus.</li>
                </ol>


                <h4 >Checklist Items</h4>
                

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
     



            
        </div><!--tab-content-->
    </div><!--col-->
</div>
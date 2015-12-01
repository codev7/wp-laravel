<div class="hr-divider m-a">
    <ul class="nav nav-pills  hr-divider-content hr-divider-nav">
        <li class="active">
            <a href="#global-pane" data-toggle="tab">Global</a>
        </li>
        <li class="">
            <a href="#templates-pane" data-toggle="tab">Templates</a>
        </li>
        <li class="">
            <a href="#cpt-pane" data-toggle="tab">Post Types</a>
        </li>

        <li >
            <a href="#endpoints-pane" data-toggle="tab">Endpoints</a>
        </li>
    </ul>
</div>

<div class="tab-content">
    <div class="tab-pane active" id="global-pane">
        <div class="form-group">
            <label>Global Notes</label>
            <textarea class="form-control" rows="10" cols="4" placeholder="Type as much as you want here.  Markdown is supported."></textarea>

            <p class="m-a-0 pull-right text-muted">Markdown Supported</p>
        </div>

        <div class="form-group">
            <label>Check List Items</label>
            
            <table class="table table-bordered table-middle">
                <thead>
                    <tr>
                        <th style="width: 70%">Description</th>
                        <th style="width: 20%">Screenshots</th>
                        <th style="width: 10%">&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>
                            <textarea class="form-control m-a-0" rows="5" placeholder="Enter a description of the item."></textarea>
                        </td>
                        <td>
                            <ul class="m-a-0">
                                <li><a href="#">cmvfiles.co/23kzd</a></li>
                                <li><a href="#">cmvfiles.co/23kzd</a></li>
                                <li><a href="#">cmvfiles.co/23kzd</a></li>
                            </ul>

                            <a href="#" class="btn btn-block btn-xs m-t"><i class="fa fa-upload"></i> Add Screenshots</a>
                        </td>

                        <td>
                            <a href="#" class="btn btn-danger-outline"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>

            <a href="#" class="btn btn-xs btn-success pull-right"><i class="fa fa-plus"></i> Add Item</a>
        </div>
    </div>
    <div class="tab-pane" id="templates-pane">

        <div class="row">
            <div class="col-sm-3">
                <ul class="nav nav-pills nav-stacked">
                    <li data-toggle="tab" class="active"><a href="#">Home</a></li>
                    <li data-toggle="tab"><a href="#">Profile</a></li>
                    <li data-toggle="tab"><a href="#">Messages</a></li>
                </ul>

                <div class="text-center m-t">
                    <a href="#" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Add Template</a>
                </div>
            </div><!--col-->

            <div class="col-sm-9">

                <small class="pull-right"><a href="#" class="text-danger"><i class="fa fa-trash"></i> Delete Template</a></small>

                <div class="form-group">
                    <label>Template Name</label>
                    <input type="text" class="form-control" placeholder="the name of the template" />
                </div>
                <div class="form-group">
                    <label>Quick Template Summary</label>
                    <textarea class="form-control" rows="2" cols="4" placeholder="A description of the page."></textarea>

                </div>

                <div class="form-group">
                    <label>Associated with HTML View <i class="fa fa-question-circle tooltipper" data-title="Select the view from your front end brief that this template will use."></i></label>

                    <select class="custom-select form-control">
                        <option>name-of-view.html</option>
                        <option>name-of-view.html</option>
                        <option>name-of-view.html</option>
                        <option>name-of-file.psd</option>
                    </select>
                </div>

    

                <div class="clearfix"></div>
                <div class="form-group">
                    <label>Check List Items</label>
                    
                    <table class="table table-bordered table-middle">
                        <thead>
                            <tr>
                                <th style="width: 70%">Description</th>
                                <th style="width: 20%">Screenshots</th>
                                <th style="width: 10%">&nbsp;</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    <select class="form-control custom-select m-b">
                                        <option>Select a Category</option>
                                        <option>frontend</option>
                                        <option>wordpress</option>
                                    </select>
                                    <textarea class="form-control m-a-0" rows="5" placeholder="Enter a description of the item."></textarea>
                                </td>
                                <td>
                                    <ul class="m-a-0">
                                        <li><a href="#">cmvfiles.co/23kzd</a></li>
                                        <li><a href="#">cmvfiles.co/23kzd</a></li>
                                        <li><a href="#">cmvfiles.co/23kzd</a></li>
                                    </ul>

                                    <a href="#" class="btn btn-block btn-xs m-t"><i class="fa fa-upload"></i> Add Screenshots</a>
                                </td>

                                <td>
                                    <a href="#" class="btn btn-danger-outline"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <a href="#" class="btn btn-xs btn-success pull-right"><i class="fa fa-plus"></i> Add Item</a>
                </div>
            </div>
        </div>
        
    </div>
    <div class="tab-pane" id="cpt-pane">

        <div class="row">
            <div class="col-sm-3">
                <ul class="nav nav-pills nav-stacked">
                    <li data-toggle="tab" class="active"><a href="#">Testimonials</a></li>
                    <li data-toggle="tab"><a href="#">Case Studies</a></li>
                </ul>

                <div class="text-center m-t">
                    <a href="#" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Add Post Type</a>
                </div>
            </div><!--col-->

            <div class="col-sm-9">

                <small class="pull-right"><a href="#" class="text-danger"><i class="fa fa-trash"></i> Delete Post Type</a></small>

                <div class="form-group">
                    <label>Post Type Name</label>
                    <input type="text" class="form-control" placeholder="the name of the post type" />
                </div>
                <div class="form-group">
                    <label>Quick Post Type Summary</label>
                    <textarea class="form-control" rows="2" cols="4" placeholder="A description of the post type."></textarea>

                </div>

                <div class="form-group">
                    <label>Has Single Post Page? <i class="fa fa-question-circle tooltipper" data-title="Will each post in the database have a single page on the site?"></i></label>

                    <select class="custom-select form-control">
                        <option>Yes</option>
                        <option>No</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>View for single post page <i class="fa fa-question-circle tooltipper" data-title="Which HTML view should the post type single post page use?"></i></label>

                    <select class="custom-select form-control">
                        <option>name of page.html</option>
                        <option>name of page.html</option>
                    </select>
                </div>
    
                <div class="form-group">
                    <label>Include in site search results? <i class="fa fa-question-circle tooltipper" data-title="Should this post type appear in the sitewide search results?"></i></label>

                    <select class="custom-select form-control">
                        <option>Yes</option>
                        <option>No</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Has an archives page? <i class="fa fa-question-circle tooltipper" data-title="Does this post type have an archive page that displays all of the post types with pagination?"></i></label>

                    <select class="custom-select form-control">
                        <option>Yes</option>
                        <option>No</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>View for archive page <i class="fa fa-question-circle tooltipper" data-title="Which HTML view should the post type archive page use?"></i></label>

                    <select class="custom-select form-control">
                        <option>name of page.html</option>
                        <option>name of page.html</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Select Default Meta Data <i class="fa fa-question-circle tooltipper" data-title="Which default meta data should this post have?"></i></label>

                    <select multiple class="form-control">
                        <option>wp_title</option>
                        <option>author</option>
                        <option>content_wysiwyg</option>
                        <option>excerpt</option>
                        <option>menu_order</option>
                        <option>thumbnail</option>
                    </select>
                </div>

                <div class="clearfix"></div>
                <div class="form-group">
                    <label>Custom Meta Data</label>
                    
                    <table class="table table-bordered table-middle">
                        <thead>
                            <tr>
                                <th style="width: 45%">Name</th>
                                <th style="width: 45%">Field Type</th>
                                <th style="width: 10%">&nbsp;</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    
                                    <input class="form-control m-a-0" type="text" />
                                </td>
                                <td>
                                    <select class="form-control custom-select m-a-0">
                                        <option>Select a field type</option>
                                        <option>text</option>
                                        <option>textarea</option>
                                        <option>file</option>
                                        <option>image</option>
                                        <option>repeater</option>
                                    </select>
                                </td>

                                <td>
                                    <a href="#" class="btn btn-danger-outline"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <a href="#" class="btn btn-xs btn-success pull-right"><i class="fa fa-plus"></i> Add Item</a>
                </div>
            </div>
        </div>
        
    </div>

    <div class="tab-pane " id="endpoints-pane">

        <div class="row">
            <div class="col-sm-3">
                <ul class="nav nav-pills nav-stacked">
                    <li data-toggle="tab" class="active"><a href="#">Contact Form</a></li>
                    <li data-toggle="tab"><a href="#">Case Study Filter</a></li>
                </ul>

                <div class="text-center m-t">
                    <a href="#" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Add Endpoint</a>
                </div>
            </div><!--col-->

            <div class="col-sm-9">

                <small class="pull-right"><a href="#" class="text-danger"><i class="fa fa-trash"></i> Delete Endpoint</a></small>

                <div class="form-group">
                    <label>Endpoint Name</label>
                    <input type="text" class="form-control" placeholder="the name of the endpoint" />
                </div>
                <div class="form-group">
                    <label>Quick Endpoint Summary</label>
                    <textarea class="form-control" rows="2" cols="4" placeholder="A description of the endpoint functionality."></textarea>

                </div>

                <div class="form-group">
                    <label>Expected Inputs</label>
                    <textarea class="form-control" rows="5" cols="4" placeholder="A description of what will be submitted to the endpoint (the data)."></textarea>

                </div>

                <div class="form-group">
                    <label>Expected Output / Action</label>
                    <textarea class="form-control" rows="5" cols="4" placeholder="A description of the what happens after the endpoint is hit, or the form is submitted."></textarea>

                </div>


            </div>
        </div>
        
    </div>
</div>
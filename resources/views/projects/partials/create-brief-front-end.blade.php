<div class="hr-divider m-a">
    <ul class="nav nav-pills  hr-divider-content hr-divider-nav">
        <li class="active">
            <a href="#global-pane" data-toggle="tab">Global</a>
        </li>
        <li >
            <a href="#views-pane" data-toggle="tab">Views</a>
        </li>
        <li class="">
            <a href="#modal-pane" data-toggle="tab">Modals</a>
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
    <div class="tab-pane " id="views-pane">

        <div class="row">
            <div class="col-sm-3">
                <ul class="nav nav-pills nav-stacked">
                    <li data-toggle="tab" class="active"><a href="#">Home</a></li>
                    <li data-toggle="tab"><a href="#">Profile</a></li>
                    <li data-toggle="tab"><a href="#">Messages</a></li>
                </ul>

                <div class="text-center m-t">
                    <a href="#" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Add View</a>
                </div>
            </div><!--col-->

            <div class="col-sm-9">

                <small class="pull-right"><a href="#" class="text-danger"><i class="fa fa-trash"></i> Delete View</a></small>

                <div class="form-group">
                    <label>View Name</label>
                    <input type="text" class="form-control" placeholder="the unique name of the view" />
                </div>

                <div class="form-group">
                    <label>Design File</label>

                    <select class="custom-select form-control">
                        <option>name-of-file.psd</option>
                        <option>name-of-file.psd</option>
                        <option>name-of-file.psd</option>
                        <option>name-of-file.psd</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Quick View Summary</label>
                    <textarea class="form-control" rows="2" cols="4" placeholder="A description of the page."></textarea>

                </div>

                <div class="form-group">
                    <label>Design Proofs <i class="fa fa-question-circle tooltipper" data-title="Design proofs are screenshots/png files of the view.  For each design brief, the project engineer will need to take screenshots of the raw design file as these screenshots are used during the QA process."></i></label>
                    
                    <table class="table table-bordered table-middle">
                        <thead>
                            <tr>
                                <th style="width: 70%">Name</th>
                                <th style="width: 20%">Image</th>
                                <th style="width: 10%">&nbsp;</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" placeholder="the unique name of the design proof" />
                                </td>
                                <td>
                                    <a href="#">cmvfiles.co/23kzd</a>

                                    <a href="#" class="btn btn-block btn-xs"><i class="fa fa-upload"></i> Upload Image</a>
                                </td>

                                <td>
                                    <a href="#" class="btn btn-danger-outline"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <a href="#" class="btn btn-xs btn-success pull-right"><i class="fa fa-plus"></i> Add Design Proof</a>
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
                                        <option>html/css</option>
                                        <option>JavaScript</option>
                                        <option>design</option>
                                        <option>animations</option>
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
    <div class="tab-pane " id="modal-pane">

        <div class="row">
            <div class="col-sm-3">
                <ul class="nav nav-pills nav-stacked">
                    <li data-toggle="tab" class="active"><a href="#">Contact Form</a></li>
                </ul>

                <div class="text-center m-t">
                    <a href="#" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Add Modal</a>
                </div>
            </div><!--col-->

            <div class="col-sm-9">

                <small class="pull-right"><a href="#" class="text-danger"><i class="fa fa-trash"></i> Delete Modal</a></small>

                <div class="form-group">
                    <label>Modal Name</label>
                    <input type="text" class="form-control" placeholder="the unique name of the modal" />
                </div>

                <div class="form-group">
                    <label>Design File</label>

                    <select class="custom-select form-control">
                        <option>name-of-file.psd</option>
                        <option>name-of-file.psd</option>
                        <option>name-of-file.psd</option>
                        <option>name-of-file.psd</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Quick Modal Summary</label>
                    <textarea class="form-control" rows="2" cols="4" placeholder="A description of the modal."></textarea>

                </div>

                <div class="form-group">
                    <label>Design Proofs <i class="fa fa-question-circle tooltipper" data-title="Design proofs are screenshots/png files of the modal.  For each design brief, the project engineer will need to take screenshots of the raw design file as these screenshots are used during the QA process."></i></label>
                    
                    <table class="table table-bordered table-middle">
                        <thead>
                            <tr>
                                <th style="width: 70%">Name</th>
                                <th style="width: 20%">Image</th>
                                <th style="width: 10%">&nbsp;</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" placeholder="the unique name of the design proof" />
                                </td>
                                <td>
                                    <a href="#">cmvfiles.co/23kzd</a>

                                    <a href="#" class="btn btn-block btn-xs"><i class="fa fa-upload"></i> Upload Image</a>
                                </td>

                                <td>
                                    <a href="#" class="btn btn-danger-outline"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <a href="#" class="btn btn-xs btn-success pull-right"><i class="fa fa-plus"></i> Add Design Proof</a>
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
</div>
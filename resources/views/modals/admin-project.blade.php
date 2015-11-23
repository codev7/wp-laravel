<div class="modal fade" id="admin-project-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{{ $project->name }}</h4>
            </div>
            <div class="modal-body">
                
                <div class="row">
                    <div class="col-sm-8">
                        <h5>Edit <strong>"{{ $project->name }}"</strong> Project Details</h5>

                        <form>
                            <div class="form-group">
                                <label>Project Name</label>
                                <input type="text" class="form-control" value="{{ $project->name }}" />
                            </div>

                            <div class="form-group">
                                <label>Project Type</label>
                                <select class="form-control">
                                    <option>Project type name</option>
                                    <option>Project type name</option>
                                    <option>Project type name</option>
                                    <option>Project type name</option>
                                    <option>Project type name</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Assigned Developer</label>
                                <select class="form-control">
                                    <option>Not yet assigned</option>
                                    <option>Name of developer</option>
                                    <option>Name of developer</option>
                                    <option>Name of developer</option>
                                    <option>Name of developer</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Assigned Project Manager</label>
                                <select class="form-control">
                                    <option>Not yet assigned</option>
                                    <option>Name of PM</option>
                                    <option>Name of PM</option>
                                    <option>Name of PM</option>
                                    <option>Name of PM</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-lg btn-success btn-block">Save Project Details</button>
                        </form>
                    </div><!--col-->

                    <div class="col-sm-4">
                        <h5 class="m-t-0">Admin Tools</h5>
                        <a class="m-t-0 btn btn-block btn-primary-outline" href="#"><i class="fa fa-bitbucket"></i> Create Bitbucket Repository</a>
                        <a class="m-t btn btn-block btn-primary-outline" href="#"><i class="fa fa-link"></i> Create Staging Site</a>
                        <a class="m-t btn btn-block btn-primary-outline" href="#"><i class="fa fa-dollar"></i> Create Invoice</a>
                        <a class="m-t btn btn-block btn-primary-outline" href="#"><i class="fa fa-file-o"></i> Create Brief</a>
                        <a class="m-t btn btn-block btn-primary-outline" href="#"><i class="fa fa-envelope"></i> Resend Invoice Email</a>
    
                    </div><!--col-->
                </div><!--row-->
            </div><!--modal-->   
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
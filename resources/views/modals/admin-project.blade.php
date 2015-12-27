<div class="modal fade" id="admin-project-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">@{{ initialProject.name }}</h4>
            </div>
            <div class="modal-body">
                
                <div class="row">
                    <div class="col-sm-8">
                        <h5>Edit <strong>"@{{ initialProject.name }}"</strong> Project Details</h5>

                        <form v-on:submit.prevent="updateProject">
                            <div class="form-group">
                                <label>Project Name</label>
                                <input type="text" class="form-control" v-model="project.name" />
                            </div>

                            <div class="form-group">
                                <label>Subdomain</label>
                                <input type="text" class="form-control" v-model="project.subdomain" />
                            </div>

                            <div class="form-group">
                                <label>Project Type</label>
                                <select class="form-control" v-model="project.project_type_id">
                                    @foreach (\CMV\Models\PM\ProjectType::all() as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Project Status</label>
                                <select class="form-control" v-model="project.status">
                                    @foreach (\CMV\Models\PM\Project::$statuses as $status)
                                        <option value="{{ $status }}">{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Assigned Project Manager</label>
                                <select class="form-control" required v-model="project.project_manager_id">
                                    <option value="">Not yet assigned</option>
                                    @foreach (\CMV\User::projectManagers() as $pm)
                                        <option value="{{ $pm->id }}">{{ $pm->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Assigned Developer</label>
                                <select class="form-control" v-model="project.developer_id">
                                    <option value="">Not yet assigned</option>
                                    @foreach (\CMV\User::developers() as $dev)
                                        <option value="{{ $dev->id }}">{{ $dev->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-lg btn-success btn-block"
                                    v-submit="states.updatingProject">Save Project Details</button>
                        </form>
                    </div><!--col-->

                    <div class="col-sm-4">
                        <h5 class="m-t-0">Admin Tools</h5>
                        <button class="m-t-0 btn btn-block btn-primary-outline"
                                v-submit="states.creatingBBRepository"
                                v-on:click.prevent="createBBRepository()"><i class="fa fa-bitbucket"></i> Create Bitbucket Repository</button>
                        <button class="m-t btn btn-block btn-primary-outline disabled"
                                v-submit="states.creatingStagingSite"
                                v-on:click.prevent="createStagingSite()"><i class="fa fa-link"></i> Create Staging Site</button>
                        <a class="m-t btn btn-block btn-primary-outline" href="#"  disabled="disabled"><i class="fa fa-dollar"></i> Create Invoice</a>
                        <a class="m-t btn btn-block btn-primary-outline" href="{{ route('project.create_brief', ['slug' => $project->slug]) }}" data-pjax><i class="fa fa-file-o"></i> Create Brief</a>
                        <button class="m-t btn btn-block btn-primary-outline"
                                v-submit="states.resendingInvoice"
                                v-on:click.prevent="resendInvoice()"><i class="fa fa-envelope"></i> Resend Invoice Email</button>
                    </div><!--col-->
                </div><!--row-->
            </div><!--modal-->   
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="col-md-3">


    <div class="panel panel-default panel-profile m-b  m-t-lg">
        <div class="panel-body text-center">
            <a href="javascript:;">
                <img
                class="panel-profile-img"
                src="{{ asset('images/connor-h.png') }}">
            </a>

            <h5 class="panel-title">
                <small>Project Engineer</small><br />
                Dave Gamache
            </h5>

            <p class="m-b-0">Hey, I'm Dave.  I am your project engineer.</p>

        </div>
    </div>

    <div class="panel panel-default panel-profile m-b-md ">
        <div class="panel-body text-center">
            <h5 class="panel-title">
                <small>Developer</small><br />
                John Jiggins
            </h5>

            <p class="m-b-0">I am the coder on your project.</p>

        </div>
    </div>

    @if(hasRole('mastermind') || hasRole('admin'))

    <div class="panel panel-default visible-md-block visible-lg-block">
        <div class="panel-body">
            <h5 class="m-t-0">Admin Tools</h5>
            <a class="m-t-0 btn btn-block btn-primary-outline" href="#"><i class="fa fa-bitbucket"></i> Create Bitbucket Repository</a>
            <a class="m-t btn btn-block btn-primary-outline" href="#"><i class="fa fa-link"></i> Create Staging Site</a>
            <a class="m-t btn btn-block btn-primary-outline" href="#"><i class="fa fa-dollar"></i> Create Invoice</a>
            <a class="m-t btn btn-block btn-primary-outline" href="#"><i class="fa fa-code-fork"></i> Assign to Developer</a>
            <a class="m-t btn btn-block btn-primary-outline" href="#"><i class="fa fa-user"></i> Assign to PM</a>
            <a class="m-t btn btn-block btn-primary-outline" href="#"><i class="fa fa-flag-checkered"></i> Change Status</a>

        </div>
    </div>

    @endif

    <div class="panel panel-default visible-md-block visible-lg-block">
        <div class="panel-body">
            <h5 class="m-t-0">Details <small>· <a href="#">Edit</a></small></h5>

            <table class="table table-condensed table-middle table-striped m-b-0">
                <tbody>
                    <tr>
                        <th rowspan="2"><i class="text-muted fa-2x fa fa-calendar m-r"></i></th>
                        <td><small>Requested Delivery Date</small></td>
                    </tr>

                    <tr>
                        <td><strong>Next week</strong></td>
                    </tr>

                    <tr>
                        <th rowspan="2"><i class="text-muted fa-2x fa fa-anchor m-r"></i></th>
                        <td><small>Project Type</small></td>
                    </tr>

                    <tr>
                        <td><strong>{{ $project->type->name }}</strong></td>
                    </tr>

                    <tr>
                        <th rowspan="2"><i class="text-muted fa-2x fa fa-git m-r"></i></th>
                        <td><small>Git URL</small></td>
                    </tr>

                    <tr>
                        <td><input type="text" class="form-control" value="git@bitbucket.org:codemyviews/cmv-web-application.git"/></td>
                    </tr>

                    <tr>
                        <th rowspan="2"><i class="text-muted fa-2x fa fa-link m-r"></i></th>
                        <td><small>Staging Site</small></td>
                    </tr>

                    <tr>
                        <td><strong><a href="#">site.approvemyviews.com</a></strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    @if(!isRouteNameSpace('files'))
    <div class="panel panel-default visible-md-block visible-lg-block">
        <div class="panel-body text-center">
            <p class="m-b text-muted"><small>There are currently 5 files uploaded.</small></p>
            <a class="m-t-0 btn btn-block btn-lg btn-primary-outline" href="#"><i class="fa fa-upload"></i> Upload Files</a>

        </div>
    </div>
    @endif
</div>
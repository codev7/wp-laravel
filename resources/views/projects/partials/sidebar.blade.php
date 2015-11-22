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

    <a class="m-t m-b btn btn-block btn-primary-outline" href="#admin-project-modal" data-toggle="modal"><i class="fa fa-unlock-alt"></i> Admin Tools</a>
        
    @include('modals/admin-project')

    @endif

    <div class="panel panel-default visible-md-block visible-lg-block">
        <div class="panel-body">
            <h5 class="m-t-0">Details <small>· <a href="#">Edit</a></small></h5>

            <table class="table table-condensed table-middle table-striped m-b-0">
                <tbody>
                    <tr>
                        <td><strong><i class="text-muted fa fa-calendar"></i> Requested Delivery Date</strong></td>
                    </tr>

                    <tr>
                        <td>Next week</td>
                    </tr>
      

                    <tr>
                        <th><i class="text-muted fa fa-anchor"></i> <strong>Project Type</strong></th>
                    </tr>
                    <tr>
                        <td>{{ $project->type->name }}</td>
                    </tr>


                    <tr>
                        <th><i class="text-muted fa fa-link"></i> <strong>Staging URL</strong></th>
                    </tr>
                    <tr>
                        <td>site.approvemyviews.com</td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>

    @if(hasRole('developer') || hasRole('admin') || hasRole('mastermind'))
    <div class="panel panel-default visible-md-block visible-lg-block">
        <div class="panel-body">
            <h5 class="m-t-0">Developer Details <small>· @if(hasRole('admin'))<a href="#">Edit</a></small>@endif</h5>

            <table class="table table-condensed table-middle table-striped m-b-0">
                <tbody>
                    <tr>
                        <td><strong><i class="text-muted fa fa-git"></i> Git URL</strong></td>
                    </tr>

                    <tr>
                        <td><code>ssh://projecturl@bitbucket.org</code></td>
                    </tr>
      
                    
                </tbody>
            </table>
        </div>
    </div>
    @endif

    @if(!isRouteNameSpace('files'))
    <div class="panel panel-default visible-md-block visible-lg-block">
        <div class="panel-body text-center">
            <p class="m-b text-muted"><small>There are currently 5 files uploaded.</small></p>
            <a class="m-t-0 btn btn-block btn-lg btn-primary-outline" href="#"><i class="fa fa-upload"></i> Upload Files</a>

        </div>
    </div>
    @endif
</div>
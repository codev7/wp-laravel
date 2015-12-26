<div class="col-md-3">


    <div class="panel panel-default panel-profile m-b  m-t-lg">
        <div class="panel-body text-center">
            <a href="javascript:;">
                <img
                class="panel-profile-img"
                src="{{ $project->projectManager->gravatar }}">
            </a>

            <h5 class="panel-title">
                <small>Project Engineer</small><br />
                {{ $project->projectManager->name }}
            </h5>

            <p class="m-b-0">Hey, I'm {{ $project->projectManager->getFirstName() }}.  I am your project engineer.</p>

        </div>
    </div>

    <div class="panel panel-default panel-profile m-b-md ">
        <div class="panel-body text-center">
            <h5 class="panel-title">
                <small>Developer</small><br />
                @if ($project->developer)
                    {{ $project->developer->name }}
                @endif
            </h5>

            <p class="m-b-0">
                @if ($project->developer)
                I am the coder on your project.
                @else
                    Developer not yet assigned to this project.
                @endif
            </p>

        </div>
    </div>

    @if(hasRole('mastermind') || hasRole('admin'))

        <div data-controller="admin/project-modal" state="{{ json_encode($project->toArray()) }}">
            <a class="m-t m-b btn btn-block btn-primary-outline"
               v-on:click.prevent="openModal()">
                <i class="fa fa-unlock-alt"></i> Admin Tools
            </a>
            @include('modals/admin-project')
        </div>

    @endif

    <div class="panel panel-default visible-md-block visible-lg-block">
        <div class="panel-body">
            <h5 class="m-t-0">Details</h5>

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
            <h5 class="m-t-0">Developer Details</h5>

            <table class="table table-condensed table-middle table-striped m-b-0">
                <tbody>
                    <tr>
                        <td><strong>Git URL</strong></td>
                    </tr>

                    <tr>
                        <td><code>ssh://projecturl@bitbucket.org</code></td>
                    </tr>
        
                    <tr>
                        <td><strong>Pivotal Tracker</strong></td>
                    </tr>

                    <tr>
                        <td><code>http://pivotaltracker.com/test-12345</code></td>
                    </tr>

                    <tr>
                        <td><a href="#" class="btn btn-lg btn-block btn-success" disabled="disabled">Re-deploy Application</a></td>
                    </tr>
                </tbody>
            </table>
            
        </div>
    </div>
    @endif

    @if(!isRouteNameSpace('files'))
        <div class="panel panel-default visible-md-block visible-lg-block"
             data-controller="misc/uploadcare"
             state="{{ json_encode(['reference_type' => 'project', 'reference_id' => $project->id]) }}">
        </div>

    @endif
</div>
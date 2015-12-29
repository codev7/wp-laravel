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
                    @if ($project->project_type == $project::TYPE_CONCIERGE)
                    <tr>
                        <td><b>Site URL</b></td>
                    </tr>

                    <tr>
                        <td>{{ $project->url }}</td>
                    </tr>
                    @endif

                    @if ($project->project_type == $project::TYPE_PROJECT)
                    <tr>
                        <td><strong>Requested Delivery Date</strong></td>
                    </tr>

                    <tr>
                        <td>{{ $project->requested_deadline }}</td>
                    </tr>

                    <tr>
                        <th><strong>Project Type</strong></th>
                    </tr>

                    <tr>
                        <td>{{ $project->type->name }}</td>
                    </tr>

                    @endif

                    <tr>
                        <th><strong>Staging URL</strong></th>
                    </tr>
                    <tr>

                        @if($project->getStagingUrl())
                        <td><a target="_blank" href="{{ $project->getStagingUrl() }}">View Staging Site</a></span></td>
                        
                        @else
                        <td class="text-muted"><em>Staging site not yet created.</em></td>
                        @endif
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
                        <td><strong>Credentials</strong></td>
                    </tr>

                    <tr>
                        @if ($project->credentials)
                        <td>{{ array_get($project->credentials, 'username') }} / {{ array_get($project->credentials, 'password') }}</td>
                        @else
                        <td><em>Not Yet Received</em></td>
                        @endif
                    </tr>

                    <tr>
                        <td><strong>Bitbucket Clone Repo</strong></td>
                    </tr>

                    <tr>
                        @if($project->hasRepo())
                        <td><input type="text" class="form-control" value="git clone {{  $project->git_url }}"></td>
                        @else
                        <td class="text-muted"><em>Repository not yet created.</em></td>
                        @endif
                    </tr>
                    
                    @if($project->pivotal_id)
                    <tr>
                        <td><strong>Pivotal Tracker</strong></td>
                    </tr>

                    <tr>
                        <td><a href="https://www.pivotaltracker.com/n/projects/{{ $project->pivotal_id }}" target="_blank">View Tracker</a></td>
                    </tr>
                    @endif

                    <tr>
                        <td><a href="#" class="btn btn-lg btn-block btn-success" disabled="disabled">Re-deploy Application</a></td>
                    </tr>
                </tbody>
            </table>
            
        </div>
    </div>
    @endif

    @if(!isRouteNameSpace('files') && !isDev())
        <div class="panel panel-default visible-md-block visible-lg-block"
             data-controller="misc/uploadcare"
             state="{{ json_encode(['reference_type' => 'project', 'reference_id' => $project->id]) }}">
        </div>

    @endif
</div>
<div class="panel panel-default m-b-md" data-controller="project/team"
     state="{{ json_encode(['project_id' => $project->id, 'team_id' => $project->team_id]) }}"
     v-cloak>
    <div class="panel-body">
        <h5 class="m-t-0">Team Members</h5>

        <div class="text-center">
            <i v-if="!team.id" class="fa fa-spinner fa-spin"></i>
        </div>

        <ul class="media-list media-list-stream"
            v-if="team.id">
            <li class="media m-b"
                v-for="user in team.users">

                <a class="media-left" href="#">
                    <img class="media-object img-circle"
                         v-bind:src="user.gravatar">
                </a>

                <div class="media-body">
                    <strong>@{{ user.name }}</strong>
                    <p class="text-muted m-a-0">team @{{ user.pivot.role }}</p>
                    <div v-if="user.pivot.role != 'owner' && isOwner" class="media-body-actions">
                        <button class="btn btn-danger-outline btn-xs"
                                v-on:click.prevent="removeFromTeam(user)">
                        <i class="fa fa-times"></i> REMOVE</button>
                    </div>
                </div>
            </li>
            <li class="media m-b"
                v-for="invitation in team.invitations">

                <a class="media-left" href="#">
                    <img class="media-object img-circle"
                         v-bind:src="invitation.gravatar">
                </a>

                <div class="media-body">
                    <strong title="@{{ invitation.email }}">@{{ lodash.trunc(invitation.email, 15, '..') }}</strong>
                    <p class="text-muted m-a-0">invite sent</p>
                    <div class="media-body-actions">
                        <button class="btn btn-danger-outline btn-xs"
                                v-on:click.prevent="removeTeamInvitation(invitation)">
                            <i class="fa fa-times"></i> REMOVE</button>
                    </div>
                </div>
            </li>
        </ul>
    </div>
        {{--@include('modals.invite-to-team')--}}
    @if (Auth::user()->isCurrentTeamAdmin())
        <div class="panel-footer text-center">
            <a href="#"
               v-on:click.prevent="openInviteModal">
                <i class="fa fa-plus"></i> Add a Team Member
            </a>
        </div>
    @endif

    @include('modals/add-team-member')
</div>

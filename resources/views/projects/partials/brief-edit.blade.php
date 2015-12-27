<div class="hr-divider m-a">
    <ul class="nav nav-pills  hr-divider-content hr-divider-nav">
        <li class="active" v-show="brief.global">
            <a href="#global-tab" data-toggle="tab">Global</a>
        </li>
        <li v-show="brief.templates">
            <a href="#templates-tab" data-toggle="tab">Templates</a>
        </li>
        <li v-show="brief.post_types">
            <a href="#post-types-tab" data-toggle="tab">Post Types</a>
        </li>
        <li v-show="brief.endpoints">
            <a href="#endpoints-tab" data-toggle="tab">Endpoints</a>
        </li>
        <li v-show="brief.brief_boxes">
            <a href="#brief-boxes-tab" data-toggle="tab">Brief Boxes</a>
        </li>
        <li v-show="brief.sections">
            <a href="#sections-tab" data-toggle="tab">Sections</a>
        </li>
        <li v-show="brief.views">
            <a href="#views-tab" data-toggle="tab">Views</a>
        </li>
        <li v-show="brief.modals">
            <a href="#modals-tab" data-toggle="tab">Modals</a>
        </li>

        <li>
            <a href="#final-tab" data-toggle="tab">Finalize</a>
        </li>
    </ul>
</div>

<div class="tab-content">
    <div class="tab-pane active" id="global-tab" v-if="brief.global">
        @include('projects.partials.brief-tab-global', ['project' => $project])
    </div>

    <div class="tab-pane" id="templates-tab" v-if="brief.templates">
        @include('projects.partials.brief-tab-templates', ['project' => $project])
    </div>

    <div class="tab-pane" id="post-types-tab" v-if="brief.post_types">
        @include('projects.partials.brief-tab-post-types', ['project' => $project])
    </div>



    <div class="tab-pane" id="endpoints-tab" v-if="brief.endpoints">
        @include('projects.partials.brief-tab-endpoints', ['project' => $project])
    </div>

    <div class="tab-pane" id="views-tab" v-if="brief.views">
        @include('projects.partials.brief-tab-views', ['project' => $project])
    </div>

    <div class="tab-pane" id="modals-tab" v-if="brief.modals">
        @include('projects.partials.brief-tab-modals', ['project' => $project])
    </div>

    <div class="tab-pane" id="sections-tab" v-if="brief.sections">
        @include('projects.partials.brief-tab-sections', ['project' => $project])
    </div>

    <div class="tab-pane" id="brief-boxes-tab" v-if="brief.brief_boxes">
        @include('projects.partials.brief-tab-boxes', ['project' => $project])
    </div>

    <div class="tab-pane" id="final-tab">
        @if (isset($brief))
        <div class="col-sm-4 col-sm-offset-4">
            <div class="well well-small">

                <button class="m-a-0 btn btn-lg btn-block btn-success"
                        v-submit="sendingBrief"
                        v-bind:disabled="briefMeta.approved_by_admin_id"
                        v-on:click.prevent="sendBrief()">
                    Send Brief
                </button>

                <p class="m-t m-b-0 text-center">
                    <a data-pjax href="{{ route('project.brief', ['brief_id' => $brief->id, 'slug' => $project->slug]) }}" class="btn btn-lg btn-block btn-warning-outline"><i class="fa fa-search"></i> Preview Brief</a>
                </p>

                <p class="m-t m-b-0 text-center">
                    <a href="#" class="btn btn-lg btn-block btn-primary-outline"
                       v-submit="savingAsDraft"
                       v-on:click.prevent="saveAsDraft()"><i class="fa fa-save"></i> Save as Draft</a>
                </p>

                <p class="m-t text-center" v-if="briefMeta.approved_by_admin_id">
                    <small>Brief was approved on <br/> @{{ briefMeta.approved_by_admin_at | date }}</small>
                </p>
            </div>
        </div>
        @endif
    </div>
</div>
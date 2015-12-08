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
</div>
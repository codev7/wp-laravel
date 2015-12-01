<div class="hr-divider m-a">
    <ul class="nav nav-pills  hr-divider-content hr-divider-nav">
        <li class="active">
            <a href="#global-tab" data-toggle="tab">Global</a>
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
    <div class="tab-pane active" id="global-tab">
        @include('projects.partials.brief-tab-global', ['project' => $project])
    </div>

    <div class="tab-pane" id="post-types-tab">
        @include('projects.partials.brief-tab-post-types', ['project' => $project])
    </div>

    <div class="tab-pane" id="endpoints-tab">
        @include('projects.partials.brief-tab-endpoints', ['project' => $project])
    </div>

    <div class="tab-pane " id="views-tab">
        @include('projects.partials.brief-tab-views', ['project' => $project])
    </div>

    <div class="tab-pane" id="modals-tab">
        @include('projects.partials.brief-tab-modals', ['project' => $project])
    </div>

    <div class="tab-pane" id="sections-tab">
        @include('projects.partials.brief-tab-sections', ['project' => $project])
    </div>

    <div class="tab-pane" id="brief-boxes-tab">
        @include('projects.partials.brief-tab-boxes', ['project' => $project])
    </div>
</div>
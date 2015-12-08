<div class="row">
    <div class="col-sm-3">

        <ul class="nav nav-pills nav-stacked" role="tablist">
            <li role="presentation" v-for="(templateIndex, template) in brief.templates" >
                <a data-toggle="tab" role="tab" href="#template-tab-@{{ templateIndex }}">@{{ template.name }}</a>
            </li>
        </ul>

        <div class="text-center m-t">
            <a v-on:click.prevent="addListItem('brief.templates')" href="#" class="btn btn-xs btn-success">
                <i class="fa fa-plus"></i> Add Template
            </a>
        </div>
    </div><!--col-->

    <div class="tab-content">
        <div class="col-sm-9 tab-pane" role="tabpanel" id="template-tab-@{{ templateIndex }}"
             v-for="(templateIndex, template) in brief.templates">

            <small class="pull-right">
                <a v-on:click.prevent="removeListItem('brief.templates', templateIndex)" href="#" class="text-danger">
                    <i class="fa fa-trash"></i> Delete Template
                </a>
            </small>

            <div class="form-group">
                <label>@{{ template.name }}</label>
                <input type="text" class="form-control" placeholder="the name of the template"
                       v-model="template.name" />
            </div>
            <div class="form-group">
                <label>Quick Template Summary</label>
                <textarea class="form-control" rows="2" cols="4" placeholder="A description of the page."
                        v-model="template.summary">
                </textarea>
            </div>

            <div class="form-group" v-if="frontendViews.length">
                <label>Associated with HTML View
                    <i class="fa fa-question-circle tooltipper" data-title="Select the view from your front end brief that this template will use."
                       v-tooltip></i>
                </label>

                <select class="custom-select form-control" v-model="template.frontend_brief_view_id">
                    <option value="@{{ view.value }}"
                            v-for="view in frontendViews">@{{ view.text }}</option>
                </select>
            </div>

            <div class="clearfix"></div>

            <brief-checklist v-if="template.checklist"
                             :path="'brief.templates['+templateIndex+'].checklist'"
                             :checklist.sync="template.checklist"
                             :with-categories="false">
            </brief-checklist>

        </div>
    </div>
</div>